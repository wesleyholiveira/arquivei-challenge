<?php

namespace Tests\Fixtures;

final class ArquiveiServiceFixtures
{
  const REQUEST = [
    'arquivei' => [
      'url' => 'https://apiuat.arquivei.com.br/v1/nfe/received',
      'client' => [
        'headers' => [
          'x-api-id' => 'e021f345e68de190b17becb313e81f7874479bcb',
          'x-api-key' => 'c0d24ab7b6a1732189cabf4d7d4896031c8a25dc',
        ]
      ]
    ]
  ];
}
