<?php

namespace App\Http\Controllers\Api;

use App\Facades\VehicleManager;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class RentVehicleController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/api/available-Vehicles",
     *     summary="Get all available Vehicles in this time",
     *     operationId="availableVehicles",
     *     tags={"Rent Vehicle"},
     *     @OA\Response(
     *         response="200",
     *         description="The available Vehicles",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *     )
     * )
     * Get all available Vehicles
     * @return AnonymousResourceCollection
     */
    public function availableVehicles(): AnonymousResourceCollection
    {
        return VehicleResource::collection(Vehicle::onlyAvailable()->get());
    }

    /**
     * @OA\Post(
     *     path="/api/attach/{Vehicle}/{user}",
     *     operationId="attachVehicle",
     *     tags={"Rent Vehicle"},
     *     summary="Attach Vehicle to user if both are available",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *     description="ID of Vehicle",
     *         in="path",
     *         name="Vehicle",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *     description="ID of user",
     *         in="path",
     *         name="user",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Vehicle attached to user",
     *        @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *     ),
     *     @OA\Response(
     *         response="409",
     *         description="Vehicle or User is not available",
     *     )
     * )
     * Attach Vehicle to user
     * @param Vehicle $vehicle
     * @param User|null $user
     * @return Application|ResponseFactory|Response
     */
    public function attach(Vehicle $vehicle, ?User $user): Response|Application|ResponseFactory
    {
        $user = $user ?? auth()->id();
        $message = 'Vehicle or User is unavailable';
        $status = 409;
        /** @var bool $attached */
        $attached = VehicleManager::attachWitchUser($vehicle, $user);
        if ($attached) {
            $message = 'User can use an attached Vehicle';
            $status = 200;
        }
        return response($message, $status);
    }

    /**
     * @OA\Post(
     *     path="/api/detach/{Vehicle}",
     *     operationId="detachVehicle",
     *     tags={"Rent Vehicle"},
     *     summary="Detach the Vehicle from any user",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *     description="ID of Vehicle",
     *         in="path",
     *         name="Vehicle",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Vehicle detached from user",
     *        @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Vehicle whit given id is not exisit",
     *     )
     * )
     * Detach the Vehicle from any user
     * @param Vehicle $vehicle
     * @return Response|Application|ResponseFactory
     */
    public function detach(Vehicle $vehicle): Response|Application|ResponseFactory
    {
        $message = 'Can\'t detach the Vehicle';
        /** @var bool $detached */
        $detached = VehicleManager::detachFromUser($vehicle);
        if ($detached) {
            $message = 'Vehicle is available';
        }
        return response($message);
    }
}
