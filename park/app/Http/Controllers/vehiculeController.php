<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatevehiculeRequest;
use App\Http\Requests\UpdatevehiculeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\vehiculeRepository;
use Illuminate\Http\Request;
use Flash;

class vehiculeController extends AppBaseController
{
    /** @var vehiculeRepository $vehiculeRepository*/
    private $vehiculeRepository;

    public function __construct(vehiculeRepository $vehiculeRepo)
    {
        $this->vehiculeRepository = $vehiculeRepo;
    }

    /**
     * Display a listing of the vehicule.
     */
    public function index(Request $request)
    {
        $vehicules = $this->vehiculeRepository->paginate(10);

        return view('vehicules.index')
            ->with('vehicules', $vehicules);
    }

    /**
     * Show the form for creating a new vehicule.
     */
    public function create()
    {
        return view('vehicules.create');
    }

    /**
     * Store a newly created vehicule in storage.
     */
    public function store(CreatevehiculeRequest $request)
    {
        $input = $request->all();

        $vehicule = $this->vehiculeRepository->create($input);

        Flash::success('Vehicule saved successfully.');

        return redirect(route('vehicules.index'));
    }

    /**
     * Display the specified vehicule.
     */
    public function show($id)
    {
        $vehicule = $this->vehiculeRepository->find($id);

        if (empty($vehicule)) {
            Flash::error('Vehicule not found');

            return redirect(route('vehicules.index'));
        }

        return view('vehicules.show')->with('vehicule', $vehicule);
    }

    /**
     * Show the form for editing the specified vehicule.
     */
    public function edit($id)
    {
        $vehicule = $this->vehiculeRepository->find($id);

        if (empty($vehicule)) {
            Flash::error('Vehicule not found');

            return redirect(route('vehicules.index'));
        }

        return view('vehicules.edit')->with('vehicule', $vehicule);
    }

    /**
     * Update the specified vehicule in storage.
     */
    public function update($id, UpdatevehiculeRequest $request)
    {
        $vehicule = $this->vehiculeRepository->find($id);

        if (empty($vehicule)) {
            Flash::error('Vehicule not found');

            return redirect(route('vehicules.index'));
        }

        $vehicule = $this->vehiculeRepository->update($request->all(), $id);

        Flash::success('Vehicule updated successfully.');

        return redirect(route('vehicules.index'));
    }

    /**
     * Remove the specified vehicule from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vehicule = $this->vehiculeRepository->find($id);

        if (empty($vehicule)) {
            Flash::error('Vehicule not found');

            return redirect(route('vehicules.index'));
        }

        $this->vehiculeRepository->delete($id);

        Flash::success('Vehicule deleted successfully.');

        return redirect(route('vehicules.index'));
    }
}
