<?php

namespace App\Virtual;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema
 */
class ApiResponse
{
    /**
     * @OA\Property(format="int32")
     *
     * @var int
     */
    public int $code;

    /**
     * @OA\Property
     *
     * @var string
     */
    public string $type;

    /**
     * @OA\Property
     *
     * @var string
     */
    public string $message;
}
