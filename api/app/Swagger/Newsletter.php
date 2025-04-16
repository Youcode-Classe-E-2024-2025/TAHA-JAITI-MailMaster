<?php

namespace App\Swagger;

/**
 *
 * 
 *
 * @OA\Get(
 *     path="/api/newsletters",
 *     summary="Get all newsletters for the authenticated user",
 *     tags={"Newsletters"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of newsletters",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(ref="#/components/schemas/Newsletter")
 *             ),
 *             @OA\Property(property="message", type="string", example="Newsletters retrieved successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Unauthenticated")
 *         )
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/newsletters",
 *     summary="Create a new newsletter",
 *     tags={"Newsletters"},
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "content"},
 *             @OA\Property(property="title", type="string", example="Monthly Update"),
 *             @OA\Property(property="content", type="string", example="This is the newsletter content...")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Newsletter created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/Newsletter"),
 *             @OA\Property(property="message", type="string", example="Newsletter created successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Failed to create",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Failed to create newsletter")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="The given data was invalid"),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="title", type="array",
 *                     @OA\Items(type="string", example="The title field is required.")
 *                 )
 *             )
 *         )
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/newsletters/{id}",
 *     summary="Get a specific newsletter",
 *     tags={"Newsletters"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the newsletter",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Newsletter details",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/Newsletter"),
 *             @OA\Property(property="message", type="string", example="Newsletter retrieved successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Newsletter not found")
 *         )
 *     )
 * )
 *
 * @OA\Put(
 *     path="/api/newsletters/{id}",
 *     summary="Update a newsletter",
 *     tags={"Newsletters"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the newsletter",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Updated Monthly Update"),
 *             @OA\Property(property="content", type="string", example="Updated newsletter content...")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Newsletter updated",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/Newsletter"),
 *             @OA\Property(property="message", type="string", example="Newsletter updated successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Failed to update",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Failed to update newsletter")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Newsletter not found")
 *         )
 *     )
 * )
 *
 * @OA\Delete(
 *     path="/api/newsletters/{id}",
 *     summary="Delete a newsletter",
 *     tags={"Newsletters"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the newsletter",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Newsletter deleted",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="null", example=null),
 *             @OA\Property(property="message", type="string", example="Newsletter deleted successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Newsletter not found")
 *         )
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="Newsletter",
 *     type="object",
 *     required={"id", "title", "content", "user_id"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Monthly Update"),
 *     @OA\Property(property="content", type="string", example="This is the newsletter content..."),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Newsletter
{
}
