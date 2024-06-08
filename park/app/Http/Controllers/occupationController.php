<?php

namespace App\Http\Controllers;

use App\Models\amende;
use App\Models\histoSortie;
use App\Models\monnaieuser;
use App\Models\occupation;
use App\Models\parking;
use App\Models\tarif;
use App\Models\User;
use App\Models\vehicule;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use function Laravel\Prompts\select;

class occupationController extends Controller
{
    //

    public function index()
    {
        $parkings = Parking::leftJoin('occupation', 'parking.id', '=', 'occupation.idparking')
            ->select('parking.*', 'occupation.id as occupation_id', 'occupation.etat as occupation_etat');

        $dispo = DB::select('select * from vue_dispo_station');
        $occuper = DB::select('select * from vue_occuper_station');

       $format_dispo =  number_format($dispo[0]->disponible, 2);
       $format_occuper =  number_format($occuper[0]->occuper, 2);

        //$vehicule = occupation::where('id_user', Auth::user()->getAuthIdentifier())->get();
        $vehicule = DB::table('occupation')->where('id_user', Auth::user()->getAuthIdentifier())->get();
        return view('occup.index')
            ->with(['vehicule' => $vehicule, 'dispo' => $format_dispo, 'occuper' => $format_occuper]);
    }

    public function detail_station($id)
    {

        $result = DB::select('select * from get_list_p where id= ?', [$id]);
        return view('occup.voirDetail')->with('parkings', $result);

    }

    public function detail_occupation()
    {
        $resultsArray = DB::select('select * from get_list_parking');

        return response()->json($resultsArray);
    }

    public function addPark($id)
    {
        return view('occup.addPark', ['id_p' => $id]);
    }

    public function store(Request $request)
    {
        try {
            $date_debut = new DateTime($request->input('date_debut'));
            $date_fin = new DateTime($request->input('date_fin'));
            $interval = $date_debut->diff($date_fin);
            $hours = str_pad($interval->h, 2, '0', STR_PAD_LEFT);
            $minutes = str_pad($interval->i, 2, '0', STR_PAD_LEFT);
            $seconds = str_pad($interval->s, 2, '0', STR_PAD_LEFT);
            $interval_time = "$hours:$minutes:$seconds";
            $interval_time = "'$interval_time'";
            $tarif = "";
            if ($interval_time >= '01:00:00') {
                $tarif = DB::select("SELECT get_prix_recupere(?) AS prix", [$interval_time]);
            } else {
                $tari = DB::select("SELECT * from tarif where heure = ?", ['01:00:00']);
                $interval_hours = $interval->h;
                $tarif = $tari[0]->prix * $interval_hours;
            }

            $vehiculeExists = vehicule::where('id', $request->input('id'))->exists();
            if ($vehiculeExists == false) {
                vehicule::create([
                    'id' => $request->input('id'),
                    'marque' => $request->input('marque'),
                    'longeur' => $request->input('longeur'),
                    'largeur' => $request->input('largeur')
                ]);
            }

            $id_occup = DB::select("select occup_id()")[0]->occup_id;

            occupation::create([
                'id' => $id_occup,
                'id_user' => Auth::user()->getAuthIdentifier(),
                'idparking' => $request->get('idp'),
                'idvehicule' => $request->input('id'),
                'date_debut' => $request->input('date_debut'),
                'date_fin' => $request->input('date_fin'),
                'etat' => 10
            ]);

            return redirect()->route('liste.parkings');

        } catch (Exception $e) {
            $e->getMessage();
        }

    }

    private function jointure_data($vehicule)
    {
        return DB::table('occupation')
            ->join('vehicule', 'occupation.idvehicule', '=', 'vehicule.id')
            ->where('occupation.id', $vehicule)
            ->select(
                'occupation.id as occupation_id',
                'vehicule.id as vehicule_id',
                'vehicule.marque',
                'occupation.date_debut',
                'occupation.date_fin'
            )
            ->first();
    }


    public function sortie(Request $request)
    {

        try {
            $datas = $request->json()->all();
            $data = $this->jointure_data($datas['vehicule']);

            if (!$data) {
                return response()->json(['error' =>'Les données de véhicule ne sont pas disponibles.']);
            }
            $date_debut = new DateTime($data->date_debut);
            $date_fin = new DateTime($data->date_fin);
            $interval = $date_debut->diff($date_fin);
            $interval_hours = $interval->h + ($interval->days * 24);

            $tarif = null;
            if ($interval_hours <= 1) {
                $tarif = DB::select("SELECT get_prix_recupere(?) AS prix", [$interval->format('%H:%I:%S')]);
            } else {
                $tari = DB::table('tarif')->where('heure', '01:00:00')->first();
                if (!$tari) {
                    throw new Exception('Tarif pour une heure non trouvé.');
                }
                $tarif = $tari->prix * $interval_hours;
            }
            $dateHeureFormatees = Carbon::now('Indian/Antananarivo')->format('Y-m-d H:i:s');
            $date_sortie_format = "";
            $amende = "";
            if($date_fin > $dateHeureFormatees){
                $amende = amende::all();
                $d_sortie = new DateTime($dateHeureFormatees);
            }
            $total_tarif = $tarif[0]->prix;
            $total_amende = $amende->sum('prix');
            $total = $total_tarif + $total_amende;
            $donnee_fin = [
                'immatriculation' => $data->vehicule_id,
                'marque' => $data->marque,
                'prix_simple' => $total_tarif,
                'amende' => $total_amende,
                'date' => $dateHeureFormatees,
                'lieu' => 'Alasora',
                'total' => $total
            ];

            $argent = $this->getMonnaie();
            $reste = $argent[0]->reste;
            $sortie_argent = $total;
            //echo $reste;
            echo $total;

            if ($sortie_argent >= 0) {

                $this->insert_monnaie_sortie($sortie_argent);
                $this->change_stat($data->occupation_id);
                $this->insert_sortie($donnee_fin);
                $this->ticket($donnee_fin);
                //dd($sortie_argent);
            }else{
                return response()->json(['error' => 'L\'argent est insuffisant.']);
            }

            return response()->json(['message' => 'Sortie avec succès']);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    private function getMonnaie()
    {
        return DB::select('select * from reste_monnaie where id_user = ?', [Auth::id()]);
    }

    private function insert_monnaie_sortie($sortie)
    {
        monnaieuser::create([
            'id_user' => Auth::id(),
            'monnaie_sortie' =>$sortie
        ]);
    }

    private function insert_sortie($data)
    {
        histoSortie::create([
            'date_sortie' => $data['date'],
            'prix_simple' => $data['prix_simple'],
            'amende' => $data['amende']
        ]);
    }
    private  function change_stat($id)
    {
        occupation::where('id', $id)->update(['etat' => 0]);
    }
    private function ticket($data)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('occup.pdf', $data));
        $dompdf->setPaper('a4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('ticket_stationement.pdf');
    }


}
