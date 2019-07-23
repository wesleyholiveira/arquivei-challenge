<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Arquivei\ArquiveiServiceInterface;

class ApiController extends Controller
{
    private $service;

    public function __construct(
        ArquiveiServiceInterface $service
    ) {
        $this->service = $service;
    }

    public function get($accessKey)
    {
        $fiscalNote = $this->service->find($accessKey);
        if ($fiscalNote->count() < 1) {
            $message = sprintf('Not found any data with: "%s" content', $accessKey);
            return $this->errorResponse($message, 404);
        }

        return $this->successfulResponse('The record was retrieved', $fiscalNote);
    }

    public function feed(Request $request)
    {
        try {
            $url = config('app.arquivei_url');
            $body = json_decode($request->getContent());
            $apiKey = $body->key;
            $apiId = $body->id;

            $response = $this->service->feed($url, [
                'headers' => [
                    'x-api-id' => $apiId,
                    'x-api-key' => $apiKey,
                    'Content-Type' => 'application/json'
                ]
            ]);

            return $this->successfulResponse('The database was feeded with successful', $response);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    private function successfulResponse($message, $content)
    {
        return response()->json([
            'message' => $message,
            'data' => $content
        ])->setStatusCode(200);
    }

    private function errorResponse($message, $statusCode)
    {
        return response()->json([
            'message' => $message
        ])->setStatusCode(($statusCode));
    }
}
