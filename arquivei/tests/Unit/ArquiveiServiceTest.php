<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Fixtures\FiscalNoteFixtures;
use App\Domain\FiscalNote\Model\FiscalNote;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Arquivei\ArquiveiServiceInterface;
use Tests\Fixtures\ArquiveiServiceFixtures;

class ArquiveiServiceTest extends TestCase
{
  public function testFindServiceWithValidKey()
  {
    $fiscalNote = factory(FiscalNote::class);
    $expectedCollection = new Collection([$fiscalNote]);

    $service = $this->getServiceFindMock(
      $expectedCollection,
      FiscalNoteFixtures::ACCESS_KEY['VALID']
    );

    $expectedCollection = $service->find(FiscalNoteFixtures::ACCESS_KEY['VALID']);
    $this->assertGreaterThan(0, $expectedCollection->count());
  }

  public function testFindServiceWithInvalidKey()
  {
    $expectedCollection = new Collection();

    $service = $this->getServiceFindMock(
      $expectedCollection,
      FiscalNoteFixtures::ACCESS_KEY['INVALID']
    );

    $expectedCollection = $service->find(FiscalNoteFixtures::ACCESS_KEY['INVALID']);
    $this->assertEquals(0, $expectedCollection->count());
  }

  public function testFeedService()
  {
    $expectedData = new \stdClass();
    $expectedData->access_key = FiscalNoteFixtures::DATA['ACCESS_KEY'];
    $expectedData->xml = FiscalNoteFixtures::DATA['XML'];

    $service = $this->mock(ArquiveiServiceInterface::class, function($mock) use ($expectedData) {
      $mock->shouldReceive('feed')
      ->once()
      ->andReturn($expectedData);
    });

    $service->params = ArquiveiServiceFixtures::REQUEST;

    $this->assertEquals(ArquiveiServiceFixtures::REQUEST, $service->params);
    $this->assertInstanceOf(\stdClass::class, $service->feed());
  }

  private function getServiceFindMock($collection, $accessKey)
  {
    $service = $this->mock(FiscalNoteserviceInterface::class, function ($mock) use ($collection, $accessKey) {
      $mock->shouldReceive('find')
        ->with($accessKey)
        ->once()
        ->andReturn($collection);
    });
    return $service;
  }
}
