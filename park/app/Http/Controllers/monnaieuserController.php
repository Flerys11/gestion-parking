<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemonnaieuserRequest;
use App\Http\Requests\UpdatemonnaieuserRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\monnaieuser;
use App\Repositories\monnaieuserRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class monnaieuserController extends AppBaseController
{
    /** @var monnaieuserRepository $monnaieuserRepository*/
    private $monnaieuserRepository;

    public function __construct(monnaieuserRepository $monnaieuserRepo)
    {
        $this->monnaieuserRepository = $monnaieuserRepo;
    }

    /**
     * Display a listing of the monnaieuser.
     */
    public function index()
    {
        $monnaieusers = DB::select('select * from reste_monnaie where id_user = ?', [Auth::id()]);


        return view('monnaieusers.index')
            ->with('monnaieusers', $monnaieusers);
    }

    /**
     * Show the form for creating a new monnaieuser.
     */
    public function create()
    {
        return view('monnaieusers.create');
    }

    /**
     * Store a newly created monnaieuser in storage.
     */
    public function store(CreatemonnaieuserRequest $request)
    {
        $input = $request->all();
        $input['id_user'] = Auth::id();
        $monnaieuser = $this->monnaieuserRepository->create($input);

        Flash::success('Monnaieuser saved successfully.');

        return redirect(route('monnaieusers.index'));
    }

    /**
     * Display the specified monnaieuser.
     */
    public function show($id)
    {
        $monnaieuser = $this->monnaieuserRepository->find($id);

        if (empty($monnaieuser)) {
            Flash::error('Monnaieuser not found');

            return redirect(route('monnaieusers.index'));
        }

        return view('monnaieusers.show')->with('monnaieuser', $monnaieuser);
    }

    /**
     * Show the form for editing the specified monnaieuser.
     */
    public function edit($id)
    {
        $monnaieuser = $this->monnaieuserRepository->find($id);

        if (empty($monnaieuser)) {
            Flash::error('Monnaieuser not found');

            return redirect(route('monnaieusers.index'));
        }

        return view('monnaieusers.edit')->with('monnaieuser', $monnaieuser);
    }

    /**
     * Update the specified monnaieuser in storage.
     */
    public function update($id, UpdatemonnaieuserRequest $request)
    {
        $monnaieuser = $this->monnaieuserRepository->find($id);

        if (empty($monnaieuser)) {
            Flash::error('Monnaieuser not found');

            return redirect(route('monnaieusers.index'));
        }

        $monnaieuser = $this->monnaieuserRepository->update($request->all(), $id);

        Flash::success('Monnaieuser updated successfully.');

        return redirect(route('monnaieusers.index'));
    }

    /**
     * Remove the specified monnaieuser from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $monnaieuser = $this->monnaieuserRepository->find($id);

        if (empty($monnaieuser)) {
            Flash::error('Monnaieuser not found');

            return redirect(route('monnaieusers.index'));
        }

        $this->monnaieuserRepository->delete($id);

        Flash::success('Monnaieuser deleted successfully.');

        return redirect(route('monnaieusers.index'));
    }
}
