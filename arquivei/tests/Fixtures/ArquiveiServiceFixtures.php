<?php

namespace Tests\Fixtures;

final class ArquiveiServiceFixtures
{
  const REQUEST = [
    'arquivei' => [
      'url' => 'https://apiuat.arquivei.com.br/v1/nfe/received',
      'client' => [
        'headers' => [
          'x-api-id' => '',
          'x-api-key' => '',
        ]
      ]
    ]
  ];
}
