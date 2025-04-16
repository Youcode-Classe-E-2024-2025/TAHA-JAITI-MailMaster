<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     schema="Campaign",
 *     type="object",
 *     required={"id", "newsletter_id", "status"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="newsletter_id", type="integer", example=1),
 *     @OA\Property(property="status", type="string", enum={"draft", "sent"}, example="draft"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(
 *         property="newsletter",
 *         ref="#/components/schemas/Newsletter"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/campaigns",
 *     summary="Get all campaigns for the authenticated user",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of campaigns",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(ref="#/components/schemas/Campaign")
 *             ),
 *             @OA\Property(property="message", type="string", example="Campaigns retrieved successfully")
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
 *     path="/api/campaigns",
 *     summary="Create a new campaign",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"newsletter_id"},
 *             @OA\Property(property="newsletter_id", type="integer", example=1),
 *             @OA\Property(property="status", type="string", enum={"draft", "sent"}, example="draft")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Campaign created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/Campaign"),
 *             @OA\Property(property="message", type="string", example="Campaign created successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Failed to create",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Campaign creation failed")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="The given data was invalid"),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="newsletter_id", type="array",
 *                     @OA\Items(type="string", example="The newsletter_id field is required.")
 *                 )
 *             )
 *         )
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/campaigns/{id}",
 *     summary="Get a specific campaign",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the campaign",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Campaign details",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/Campaign"),
 *             @OA\Property(property="message", type="string", example="Campaign retrieved successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Unauthorized")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Campaign not found")
 *         )
 *     )
 * )
 *
 * @OA\Put(
 *     path="/api/campaigns/{id}",
 *     summary="Update a campaign",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the campaign",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", enum={"draft", "sent"}, example="sent")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Campaign updated",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/Campaign"),
 *             @OA\Property(property="message", type="string", example="Campaign updated successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Failed to update",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Campaign update failed")
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Unauthorized")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Campaign not found")
 *         )
 *     )
 * )
 *
 * @OA\Delete(
 *     path="/api/campaigns/{id}",
 *     summary="Delete a campaign",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the campaign",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Campaign deleted",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="null", example=null),
 *             @OA\Property(property="message", type="string", example="Campaign deleted successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Unauthorized")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Campaign not found")
 *         )
 *     )
 * )
 */
class Campaign
{
}