<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateparkingRequest;
use App\Http\Requests\UpdateparkingRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\parking;
use App\Repositories\parkingRepository;
use Illuminate\Http\Request;
use Flash;

class parkingController extends AppBaseController
{
    /** @var parkingRepository $parkingRepository*/
    private $parkingRepository;

    public function __construct(parkingRepository $parkingRepo)
    {
        $this->parkingRepository = $parkingRepo;
    }

    /**
     * Display a listing of the parking.
     */
    public function index(Request $request)
    {
        $parkings = $this->parkingRepository->paginate(2);
        //$parkings = parking::orderBy('longeur', 'asc')->simplePaginate(2);
        $simple_list = array(
            'longeur' => 'longeur',
            'largeur' => 'largeur'
        );

        return view('parkings.index')
            ->with(['parkings' => $parkings, 'simple_list' => $simple_list]);
    }

    public function trie(Request $request){
        $choix = request()->get('choix');
//        $parkings = parking::orderBy($choix, 'asc')->simplePaginate(2);
        $parkings = parking::orderBy($choix, 'asc')->paginate(2);
        $simple_list = array(
            'longeur' => 'longeur',
            'largeur' => 'largeur'
        );
        return view('parkings.index')
            ->with(['parkings' => $parkings, 'simple_list' => $simple_list]);
    }

    /**
     * Show the form for creating a new parking.
     */
    public function create()
    {
        return view('parkings.create');
    }

    /**
     * Store a newly created parking in storage.
     */
    public function store(CreateparkingRequest $request)
    {
        $input = $request->all();
        $input['id'] = Parking::getId();
        $parking = $this->parkingRepository->create($input);

        Flash::success('Parking saved successfully.');

        return redirect(route('parkings.index'));
    }

    /**
     * Display the specified parking.
     */
    public function show($id)
    {
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            Flash::error('Parking not found');

            return redirect(route('parkings.index'));
        }

        return view('parkings.show')->with('parking', $parking);
    }

    /**
     * Show the form for editing the specified parking.
     */
    public function edit($id)
    {
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            Flash::error('Parking not found');

            return redirect(route('parkings.index'));
        }

        return view('parkings.edit')->with('parking', $parking);
    }

    /**
     * Update the specified parking in storage.
     */
    public function update($id, UpdateparkingRequest $request)
    {
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            Flash::error('Parking not found');

            return redirect(route('parkings.index'));
        }

        $parking = $this->parkingRepository->update($request->all(), $id);

        Flash::success('Parking updated successfully.');

        return redirect(route('parkings.index'));
    }

    /**
     * Remove the specified parking from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            Flash::error('Parking not found');

            return redirect(route('parkings.index'));
        }

        $this->parkingRepository->delete($id);

        Flash::success('Parking deleted successfully.');

        return redirect(route('parkings.index'));
    }
}
