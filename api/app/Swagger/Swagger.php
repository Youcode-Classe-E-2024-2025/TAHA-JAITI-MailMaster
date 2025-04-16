<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="MailMaster API Documentation",
 *     description="API documentation for MailMaster",
 *     @OA\Contact(
 *         email="taha.jaiti@gmail.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8080",
 *     description="Local server"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter your bearer token in the format **Bearer {token}**"
 * )
 */
class Swagger
{
}