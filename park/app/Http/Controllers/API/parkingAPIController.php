<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateparkingAPIRequest;
use App\Http\Requests\API\UpdateparkingAPIRequest;
use App\Models\parking;
use App\Repositories\parkingRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class parkingAPIController
 */
class parkingAPIController extends AppBaseController
{
    private parkingRepository $parkingRepository;

    public function __construct(parkingRepository $parkingRepo)
    {
        $this->parkingRepository = $parkingRepo;
    }

    /**
     * Display a listing of the parkings.
     * GET|HEAD /parkings
     */
    public function index(Request $request): JsonResponse
    {
        $parkings = $this->parkingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($parkings->toArray(), 'Parkings retrieved successfully');
    }

    /**
     * Store a newly created parking in storage.
     * POST /parkings
     */
    public function store(CreateparkingAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $parking = $this->parkingRepository->create($input);

        return $this->sendResponse($parking->toArray(), 'Parking saved successfully');
    }

    /**
     * Display the specified parking.
     * GET|HEAD /parkings/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var parking $parking */
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            return $this->sendError('Parking not found');
        }

        return $this->sendResponse($parking->toArray(), 'Parking retrieved successfully');
    }

    /**
     * Update the specified parking in storage.
     * PUT/PATCH /parkings/{id}
     */
    public function update($id, UpdateparkingAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var parking $parking */
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            return $this->sendError('Parking not found');
        }

        $parking = $this->parkingRepository->update($input, $id);

        return $this->sendResponse($parking->toArray(), 'parking updated successfully');
    }

    /**
     * Remove the specified parking from storage.
     * DELETE /parkings/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var parking $parking */
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            return $this->sendError('Parking not found');
        }

        $parking->delete();

        return $this->sendSuccess('Parking deleted successfully');
    }
}
