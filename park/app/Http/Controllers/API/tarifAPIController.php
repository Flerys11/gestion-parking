<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetarifAPIRequest;
use App\Http\Requests\API\UpdatetarifAPIRequest;
use App\Models\tarif;
use App\Repositories\tarifRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class tarifAPIController
 */
class tarifAPIController extends AppBaseController
{
    private tarifRepository $tarifRepository;

    public function __construct(tarifRepository $tarifRepo)
    {
        $this->tarifRepository = $tarifRepo;
    }

    /**
     * Display a listing of the tarifs.
     * GET|HEAD /tarifs
     */
    public function index(Request $request): JsonResponse
    {
        $tarifs = $this->tarifRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tarifs->toArray(), 'Tarifs retrieved successfully');
    }

    /**
     * Store a newly created tarif in storage.
     * POST /tarifs
     */
    public function store(CreatetarifAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $tarif = $this->tarifRepository->create($input);

        return $this->sendResponse($tarif->toArray(), 'Tarif saved successfully');
    }

    /**
     * Display the specified tarif.
     * GET|HEAD /tarifs/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var tarif $tarif */
        $tarif = $this->tarifRepository->find($id);

        if (empty($tarif)) {
            return $this->sendError('Tarif not found');
        }

        return $this->sendResponse($tarif->toArray(), 'Tarif retrieved successfully');
    }

    /**
     * Update the specified tarif in storage.
     * PUT/PATCH /tarifs/{id}
     */
    public function update($id, UpdatetarifAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var tarif $tarif */
        $tarif = $this->tarifRepository->find($id);

        if (empty($tarif)) {
            return $this->sendError('Tarif not found');
        }

        $tarif = $this->tarifRepository->update($input, $id);

        return $this->sendResponse($tarif->toArray(), 'tarif updated successfully');
    }

    /**
     * Remove the specified tarif from storage.
     * DELETE /tarifs/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var tarif $tarif */
        $tarif = $this->tarifRepository->find($id);

        if (empty($tarif)) {
            return $this->sendError('Tarif not found');
        }

        $tarif->delete();

        return $this->sendSuccess('Tarif deleted successfully');
    }
}
