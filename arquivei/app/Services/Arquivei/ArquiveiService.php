<?php

namespace App\Services\Arquivei;

use GuzzleHttp\ClientInterface;
use App\Domain\FiscalNote\Repository\FiscalNoteRepositoryInterface;

class ArquiveiService implements ArquiveiServiceInterface
{
    private $client;
    private $repository;
    private $params;

    public function __construct(
        FiscalNoteRepositoryInterface $repository,
        ClientInterface $client,
        array $params
    ) {
        $this->client = $client;
        $this->repository = $repository;
        $this->params = $params;
    }

    public function find($accessKey) {
        return $this->repository->find($accessKey);
    }

    public function feed()
    {
        $url = $this->params['arquivei']['url'];
        $params = $this->params['arquivei']['client'];
        $response = $this->client->get($url, $params);
        $content = json_decode($response->getBody());
        $data = $content->data;
        return $this->repository->save($data);
    }
}
