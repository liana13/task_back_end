<?php

namespace App\Virtual;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="Some simple request createa as example",
 *     type="object",
 *     title="Example user's model",
 * )
 */
class UserModel
{
    /**
     * @OA\Property(
     *     title="Name",
     *     description="The  name",
     *     format="string",
     *     example="Сергей Сергеев"
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="Email",
     *     description="Email of user",
     *     format="email",
     *     example="sergeev2@example.com"
     * )
     *
     * @var string
     */
    public string $email;
}
