<?php

namespace App\Services\Arquivei;

use GuzzleHttp\ClientInterface;
use App\Domain\FiscalNote\Repository\FiscalNoteRepositoryInterface;

class ArquiveiService implements ArquiveiServiceInterface
{
    private $client;
    private $repository;

    public function __construct(
        FiscalNoteRepositoryInterface $repository,
        ClientInterface $client
    ) {
        $this->client = $client;
        $this->repository = $repository;
    }

    public function find($accessKey) {
        return $this->repository->find($accessKey);
    }

    public function feed($url, $params)
    {
        $response = $this->client->get($url, $params);
        $content = json_decode($response->getBody());
        $data = $content->data;
        $this->repository->save($data);
        return $data;
    }
}
