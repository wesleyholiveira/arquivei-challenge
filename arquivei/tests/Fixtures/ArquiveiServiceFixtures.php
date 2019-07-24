<?php

namespace Tests\Fixtures;

final class ArquiveiServiceFixtures
{
  const REQUEST = [
    'url' => 'https://sandbox-api.arquivei.com.br/v1/nfe/received',
    'client' => [
      'headers' => [
        'x-api-id' => 'f96ae22f7c5d74fa4d78e764563d52811570588e',
        'x-api-key' => 'cc79ee9464257c9e1901703e04ac9f86b0f387c2',
        'Content-Type' => 'application/json'
      ]
    ]
  ];
}