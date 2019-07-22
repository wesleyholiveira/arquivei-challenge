<?php

namespace App\Http\Service\Arquivei;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\GuzzleException;
use App\Http\Domain\FiscalNote\Model\FiscalNote;
use App\Http\Domain\FiscalNote\Repository\FiscalNoteRepositoryInterface;

class ArquiveiService implements ArquiveiServiceInterface
{
    private $client;
    private $repository;

    public $url;

    public function __construct(
        FiscalNoteRepositoryInterface $repository,
        ClientInterface $client
    ) {
        $this->client = $client;
        $this->repository = $repository;
        $this->url = config('app.arquivei_url');
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
