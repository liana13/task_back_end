<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class VehicleController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/api/Vehicles",
     *     summary="Display a listing of the resource",
     *     operationId="index",
     *     tags={"Vehicles"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response="200",
     *         description="The all Vehicles"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return VehicleResource::collection(Vehicle::with('user')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/Vehicles",
     *     operationId="storeVehicles",
     *     tags={"Vehicles"},
     *     summary="Create yet another example record",
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response="201",
     *         description="New Vehicle created",
     *         @OA\JsonContent(ref="#/components/schemas/VehicleRequest")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/VehicleRequest")
     *     ),
     * )
     * Store a newly created resource in storage.
     *
     * @param VehicleRequest $request
     *
     * @return VehicleResource
     */
    public function store(VehicleRequest $request): VehicleResource
    {
        return new VehicleResource(Vehicle::create($request->validated()));
    }

    /**
     * @OA\Get(
     *     path="/api/Vehicles/{Vehicle}",
     *     operationId="Get Vehicle by id",
     *     tags={"Vehicles"},
     *     summary="Display the specified resource",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="Vehicle",
     *         in="path",
     *         description="The ID of Vehicle",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="json",
     *             @OA\Items(ref="#/components/schemas/VehicleRequest")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Invalid tag value",
     *     ),
     * )
     * Display the specified resource.
     *
     * @param Vehicle $vehicle
     * @return VehicleResource
     */
    public function show(Vehicle $vehicle): VehicleResource
    {
        return new VehicleResource($vehicle);
    }

    /**
     * @OA\Put(
     *     path="/api/Vehicles/{Vehicle}",
     *     operationId="VehicleUpdate",
     *     tags={"Vehicles"},
     *     summary="Update Vehicle by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="Vehicle",
     *         in="path",
     *         description="The ID of Vehicle",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="json",
     *             @OA\Items(ref="#/components/schemas/VehicleRequest")
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/VehicleRequest")
     *     ),
     * )
     * Update the specified resource in storage.
     *
     * @param VehicleRequest $request
     * @param Vehicle $vehicle
     * @return VehicleResource
     */
    public function update(VehicleRequest $request, Vehicle $vehicle): VehicleResource
    {
        $vehicle->update($request->validated());
        return new VehicleResource($vehicle);
    }

    /**
     * @OA\Delete(
     *     path="/api/Vehicles/{Vehicle}",
     *     operationId="VehicleDelete",
     *     tags={"Vehicles"},
     *     summary="Delete Vehicle by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="Vehicle",
     *         in="path",
     *         description="The ID of Vehicle",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Deleted",
     *     ),
     * )
     * Remove the specified resource from storage.
     *
     * @param Vehicle $vehicle
     * @return Response
     */
    public function destroy(Vehicle $vehicle): Response
    {
        $vehicle->delete();
        return \response()->noContent();
    }
}
