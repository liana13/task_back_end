<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Laravel Swagger API documentation",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="liana.tsaturyan.a@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Tag(
 *     name="Vehicles",
 *     description="Vehicle CRUD",
 * )
 * @OA\Tag(
 *     name="Rent Vehicle",
 *     description="Rent Vehicle functionality",
 * )
 */
class ApiController extends Controller
{

}
