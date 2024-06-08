<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetarifRequest;
use App\Http\Requests\UpdatetarifRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\tarifRepository;
use Illuminate\Http\Request;
use Flash;

class tarifController extends AppBaseController
{
    /** @var tarifRepository $tarifRepository*/
    private $tarifRepository;

    public function __construct(tarifRepository $tarifRepo)
    {
        $this->tarifRepository = $tarifRepo;
    }

    /**
     * Display a listing of the tarif.
     */
    public function index(Request $request)
    {
        $tarifs = $this->tarifRepository->paginate(10);

        return view('tarifs.index')
            ->with('tarifs', $tarifs);
    }

    /**
     * Show the form for creating a new tarif.
     */
    public function create()
    {
        return view('tarifs.create');
    }

    /**
     * Store a newly created tarif in storage.
     */
    public function store(CreatetarifRequest $request)
    {
        $input = $request->all();
        //dd($input);

        $tarif = $this->tarifRepository->create($input);

        Flash::success('Tarif saved successfully.');

        return redirect(route('tarifs.index'));
    }

    /**
     * Display the specified tarif.
     */
    public function show($id)
    {
        $tarif = $this->tarifRepository->find($id);

        if (empty($tarif)) {
            Flash::error('Tarif not found');

            return redirect(route('tarifs.index'));
        }

        return view('tarifs.show')->with('tarif', $tarif);
    }

    /**
     * Show the form for editing the specified tarif.
     */
    public function edit($id)
    {
        $tarif = $this->tarifRepository->find($id);

        if (empty($tarif)) {
            Flash::error('Tarif not found');

            return redirect(route('tarifs.index'));
        }

        return view('tarifs.edit')->with('tarif', $tarif);
    }

    /**
     * Update the specified tarif in storage.
     */
    public function update($id, UpdatetarifRequest $request)
    {
        $tarif = $this->tarifRepository->find($id);

        if (empty($tarif)) {
            Flash::error('Tarif not found');

            return redirect(route('tarifs.index'));
        }

        $tarif = $this->tarifRepository->update($request->all(), $id);

        Flash::success('Tarif updated successfully.');

        return redirect(route('tarifs.index'));
    }

    /**
     * Remove the specified tarif from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tarif = $this->tarifRepository->find($id);

        if (empty($tarif)) {
            Flash::error('Tarif not found');

            return redirect(route('tarifs.index'));
        }

        $this->tarifRepository->delete($id);

        Flash::success('Tarif deleted successfully.');

        return redirect(route('tarifs.index'));
    }
}
