<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Fixtures\FiscalNoteFixtures;
use Illuminate\Database\Eloquent\Collection;
use Tests\Fixtures\ArquiveiServiceFixtures;
use App\Domain\FiscalNote\Repository\FiscalNoteRepositoryInterface;
use App\Services\Arquivei\ArquiveiService;
use App\Domain\FiscalNote\Model\FiscalNote;
use App\Domain\FiscalNote\Repository\FiscalNoteRepository;

class ArquiveiServiceTest extends TestCase
{
  private $client;
  private $repository;
  private $service;
  private $params;

  protected function setUp(): void
  {
    parent::setUp();

    $this->client = new \GuzzleHttp\Client();
    $this->repository = new FiscalNoteRepository();
    $this->params = ArquiveiServiceFixtures::REQUEST;
    $this->service = new ArquiveiService($this->repository, $this->client, $this->params);
  }

  public function testFindServiceWithValidKey()
  {
    $expectedCollection = $this->service->find(FiscalNoteFixtures::ACCESS_KEY['VALID']);
    $this->assertGreaterThan(0, $expectedCollection->count());
  }

  public function testFindServiceWithInvalidKey()
  {
    $expectedCollection = $this->service->find(FiscalNoteFixtures::ACCESS_KEY['INVALID']);
    $this->assertEquals(0, $expectedCollection->count());
  }

  public function testFeedService()
  {
    $expectedCollection = $this->service->feed();
    $this->assertGreaterThan(0, $expectedCollection->count());
  }

  private function getRepositoryMock()
  {
    $model = factory(FiscalNote::class)->make();
    $expectedCollection = new Collection([$model]);
    return $this->mock(FiscalNoteRepositoryInterface::class, function($mock) use ($expectedCollection) {
      $mock->shouldReceive([
        'find' => $expectedCollection,
        'save' => $expectedCollection
      ])->once();
    });
  }
}
