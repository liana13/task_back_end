<?php

namespace App\Virtual;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example storring request",
 *     description="Some simple request createa as example",
 * )
 */
class VehicleRequest
{
    /**
     * @OA\Property(
     *     title="Model",
     *     description="Model of key for storring",
     *     example="Ford",
     * )
     *
     * @var string
     */
    public string $model;

    /**
     * @OA\Property(
     *     title="Class",
     *     description="Class for storring",
     *     example="focus",
     * )
     *
     * @var string
     */
    public string $class;

    /**
     * @OA\Property(
     *     title="User Id",
     *     description="User Id for storring",
     *     example="1",
     * )
     *
     * @var int
     */
    public int $user_id;
}
