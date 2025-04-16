<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     schema="Subscriber",
 *     type="object",
 *     required={"id", "email"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="email", type="string", format="email", example="subscriber@example.com"),
 *     @OA\Property(property="name", type="string", nullable=true, example="John Doe"),
 *     @OA\Property(property="status", type="string", enum={"active", "unsubscribed"}, example="active"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Get(
 *     path="/api/subscribers",
 *     summary="Get all subscribers",
 *     tags={"Subscribers"},
 *     @OA\Response(
 *         response=200,
 *         description="List of subscribers",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(ref="#/components/schemas/Subscriber")
 *             ),
 *             @OA\Property(property="message", type="string", example="Subscribers retrieved successfully")
 *         )
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/subscribers",
 *     summary="Create a new subscriber",
 *     tags={"Subscribers"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email"},
 *             @OA\Property(property="email", type="string", format="email", example="subscriber@example.com"),
 *             @OA\Property(property="name", type="string", nullable=true, example="John Doe"),
 *             @OA\Property(property="status", type="string", enum={"active", "unsubscribed"}, example="active")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Subscriber created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/Subscriber"),
 *             @OA\Property(property="message", type="string", example="Subscriber created successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Failed to create",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Failed to create subscriber")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="The given data was invalid"),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="email", type="array",
 *                     @OA\Items(type="string", example="The email has already been taken.")
 *                 )
 *             )
 *         )
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/subscribers/{id}",
 *     summary="Get a specific subscriber",
 *     tags={"Subscribers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the subscriber",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Subscriber details",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/Subscriber"),
 *             @OA\Property(property="message", type="string", example="Subscriber retrieved successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Subscriber not found")
 *         )
 *     )
 * )
 *
 * @OA\Put(
 *     path="/api/subscribers/{id}",
 *     summary="Update a subscriber",
 *     tags={"Subscribers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the subscriber",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="email", type="string", format="email", example="updated@example.com"),
 *             @OA\Property(property="name", type="string", nullable=true, example="Updated Name"),
 *             @OA\Property(property="status", type="string", enum={"active", "unsubscribed"}, example="active")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Subscriber updated",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/Subscriber"),
 *             @OA\Property(property="message", type="string", example="Subscriber updated successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Failed to update",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Failed to update subscriber")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Subscriber not found")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="The given data was invalid"),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="email", type="array",
 *                     @OA\Items(type="string", example="The email has already been taken.")
 *                 )
 *             )
 *         )
 *     )
 * )
 *
 * @OA\Delete(
 *     path="/api/subscribers/{id}",
 *     summary="Delete a subscriber",
 *     tags={"Subscribers"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the subscriber",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Subscriber deleted",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="null", example=null),
 *             @OA\Property(property="message", type="string", example="Subscriber deleted successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Subscriber not found")
 *         )
 *     )
 * )
 */
class Subscriber
{
}
