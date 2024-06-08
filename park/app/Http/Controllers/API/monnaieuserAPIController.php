<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemonnaieuserAPIRequest;
use App\Http\Requests\API\UpdatemonnaieuserAPIRequest;
use App\Models\monnaieuser;
use App\Repositories\monnaieuserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class monnaieuserAPIController
 */
class monnaieuserAPIController extends AppBaseController
{
    private monnaieuserRepository $monnaieuserRepository;

    public function __construct(monnaieuserRepository $monnaieuserRepo)
    {
        $this->monnaieuserRepository = $monnaieuserRepo;
    }

    /**
     * Display a listing of the monnaieusers.
     * GET|HEAD /monnaieusers
     */
    public function index(Request $request): JsonResponse
    {
        $monnaieusers = $this->monnaieuserRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($monnaieusers->toArray(), 'Monnaieusers retrieved successfully');
    }

    /**
     * Store a newly created monnaieuser in storage.
     * POST /monnaieusers
     */
    public function store(CreatemonnaieuserAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $monnaieuser = $this->monnaieuserRepository->create($input);

        return $this->sendResponse($monnaieuser->toArray(), 'Monnaieuser saved successfully');
    }

    /**
     * Display the specified monnaieuser.
     * GET|HEAD /monnaieusers/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var monnaieuser $monnaieuser */
        $monnaieuser = $this->monnaieuserRepository->find($id);

        if (empty($monnaieuser)) {
            return $this->sendError('Monnaieuser not found');
        }

        return $this->sendResponse($monnaieuser->toArray(), 'Monnaieuser retrieved successfully');
    }

    /**
     * Update the specified monnaieuser in storage.
     * PUT/PATCH /monnaieusers/{id}
     */
    public function update($id, UpdatemonnaieuserAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var monnaieuser $monnaieuser */
        $monnaieuser = $this->monnaieuserRepository->find($id);

        if (empty($monnaieuser)) {
            return $this->sendError('Monnaieuser not found');
        }

        $monnaieuser = $this->monnaieuserRepository->update($input, $id);

        return $this->sendResponse($monnaieuser->toArray(), 'monnaieuser updated successfully');
    }

    /**
     * Remove the specified monnaieuser from storage.
     * DELETE /monnaieusers/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var monnaieuser $monnaieuser */
        $monnaieuser = $this->monnaieuserRepository->find($id);

        if (empty($monnaieuser)) {
            return $this->sendError('Monnaieuser not found');
        }

        $monnaieuser->delete();

        return $this->sendSuccess('Monnaieuser deleted successfully');
    }
}
