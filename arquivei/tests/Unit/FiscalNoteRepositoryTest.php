<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Fixtures\FiscalNoteFixtures;
use App\Domain\FiscalNote\Model\FiscalNote;
use App\Domain\FiscalNote\Repository\FiscalNoteRepository;

class FiscalNoteRepositoryTest extends TestCase
{
  private $repository;

  protected function setUp(): void
  {
    parent::setUp();

    $this->repository = new FiscalNoteRepository();
  }

  public function testFindFiscalNoteByAccessKeyValid()
  {
    $response = $this->repository->find(FiscalNoteFixtures::ACCESS_KEY['VALID']);
    $this->assertGreaterThan(0, $response->count());
  }

  public function testFindFiscalNoteByAccessKeyInvalid()
  {
    $response = $this->repository->find(FiscalNoteFixtures::ACCESS_KEY['INVALID']);
    $this->assertEquals(0, $response->count());
  }

  public function testSaveFiscalNote()
  {
    $data = factory(FiscalNote::class, 13)->make();
    $repository = new FiscalNoteRepository();

    $response = $repository->save($data);
    $this->assertEquals(count($data), $response->count());
  }
}
