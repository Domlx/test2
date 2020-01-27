<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait Responsible
{
    /**
     * @var string|null
     */
    protected $type;

    /**
     * Get response with attributes
     *
     * @param $attributes
     *
     * @return JsonResponse
     */
    public function getAttributes($attributes): JsonResponse
    {
        return $this->generateResponse('attributes', $attributes);
    }

    /**
     * Get response with message
     *
     * @param  string|null  $message
     *
     * @return JsonResponse
     */
    public function getMessage(string $message = null): JsonResponse
    {
        return $this->generateResponse('message', $message);
    }

    /**
     * Generate response according to key
     *
     * @param $key
     * @param $value
     *
     * @return JsonResponse
     */
    protected function generateResponse(string $key, $value): JsonResponse
    {
        return response()->json([
            'data' => [
                'type' => $this->type,
                $key   => $value,
            ]
        ], Response::HTTP_OK);
    }

    /**
     * Generate response according to key
     *
     * @return JsonResponse
     */
    protected function generateNotFound(): JsonResponse
    {
        return response()->json([
            'data' => [
                'type' => $this->type,
                'message'   => 'Item not found'
            ]
        ], Response::HTTP_NOT_FOUND);
    }

}
