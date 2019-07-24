<?php

namespace Tests\Fixtures;

final class FiscalNoteFixtures
{
  const ACCESS_KEY = [
    'VALID' => 'littlelesker',
    'INVALID' => 'asdaoskdaposk'
  ];

  const DATA = [
    'ACCESS_KEY' => self::ACCESS_KEY['VALID'],
    'XML' => ''
  ];
}
