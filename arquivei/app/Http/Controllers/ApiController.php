<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Service\Arquivei\ArquiveiServiceInterface;

class ApiController extends Controller
{
    private $service;
    private $repository;

    public function __construct(
        ArquiveiServiceInterface $service
    ) {
        $this->service = $service;
    }

    public function get(Request $request, $accessKey)
    {
        $fiscalNote = $this->service->find($accessKey);
        return $this->successfulResponse('The record was retrieved', $fiscalNote);
    }

    public function feed(Request $request)
    {
        try {
            $url = $this->service->url;
            $body = json_decode($request->getContent());
            $apiKey = $body->key;
            $apiId = $body->id;
            $contentType = $request->header('content-type');

            $response = $this->service->feed($url, [
                'headers' => [
                    'x-api-id' => $apiId,
                    'x-api-key' => $apiKey,
                    'Content-Type' => $contentType
                ]
            ]);

            return $this->successfulResponse('The database was feeded with successful', $response);
        } catch (\Exception $e) {
            return $this->internalErrorResponse($e->getMessage());
        }
    }

    private function successfulResponse($message, $content)
    {
        return response()->json([
            'message' => $message,
            'data' => $content
        ])->setStatusCode(200);
    }

    private function internalErrorResponse($message)
    {
        return response()->json([
            'message' => $message
        ])->setStatusCode(500);
    }
}
