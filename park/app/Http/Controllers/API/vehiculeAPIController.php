<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatevehiculeAPIRequest;
use App\Http\Requests\API\UpdatevehiculeAPIRequest;
use App\Models\vehicule;
use App\Repositories\vehiculeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class vehiculeAPIController
 */
class vehiculeAPIController extends AppBaseController
{
    private vehiculeRepository $vehiculeRepository;

    public function __construct(vehiculeRepository $vehiculeRepo)
    {
        $this->vehiculeRepository = $vehiculeRepo;
    }

    /**
     * Display a listing of the vehicules.
     * GET|HEAD /vehicules
     */
    public function index(Request $request): JsonResponse
    {
        $vehicules = $this->vehiculeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($vehicules->toArray(), 'Vehicules retrieved successfully');
    }

    /**
     * Store a newly created vehicule in storage.
     * POST /vehicules
     */
    public function store(CreatevehiculeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $vehicule = $this->vehiculeRepository->create($input);

        return $this->sendResponse($vehicule->toArray(), 'Vehicule saved successfully');
    }

    /**
     * Display the specified vehicule.
     * GET|HEAD /vehicules/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var vehicule $vehicule */
        $vehicule = $this->vehiculeRepository->find($id);

        if (empty($vehicule)) {
            return $this->sendError('Vehicule not found');
        }

        return $this->sendResponse($vehicule->toArray(), 'Vehicule retrieved successfully');
    }

    /**
     * Update the specified vehicule in storage.
     * PUT/PATCH /vehicules/{id}
     */
    public function update($id, UpdatevehiculeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var vehicule $vehicule */
        $vehicule = $this->vehiculeRepository->find($id);

        if (empty($vehicule)) {
            return $this->sendError('Vehicule not found');
        }

        $vehicule = $this->vehiculeRepository->update($input, $id);

        return $this->sendResponse($vehicule->toArray(), 'vehicule updated successfully');
    }

    /**
     * Remove the specified vehicule from storage.
     * DELETE /vehicules/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var vehicule $vehicule */
        $vehicule = $this->vehiculeRepository->find($id);

        if (empty($vehicule)) {
            return $this->sendError('Vehicule not found');
        }

        $vehicule->delete();

        return $this->sendSuccess('Vehicule deleted successfully');
    }
}
