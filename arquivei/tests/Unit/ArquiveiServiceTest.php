<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Fixtures\FiscalNoteFixtures;
use Tests\Fixtures\ArquiveiServiceFixtures;
use App\Services\Arquivei\ArquiveiService;
use App\Domain\FiscalNote\Repository\FiscalNoteRepository;
use App\Exceptions\FiscalNoteRepositoryException;

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

  public function testFeedServiceAlreadyExistsRecords()
  {
    $this->expectException(FiscalNoteRepositoryException::class);
    $this->service->feed();
    $this->assertTrue(true);
  }
}
