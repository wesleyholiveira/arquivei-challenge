<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Fixtures\FiscalNoteFixtures;
use App\Domain\FiscalNote\Model\FiscalNote;
use Illuminate\Database\Eloquent\Collection;
use App\Domain\FiscalNote\Repository\FiscalNoteRepositoryInterface;

class FiscalNoteRepositoryTest extends TestCase
{
  public function testFindFiscalNoteByAccessKeyValid()
  {
    $fiscalNote = factory(FiscalNote::class);
    $expectedCollection = new Collection([$fiscalNote]);
    $repository = $this->getRepositoryFindMock($expectedCollection);

    $actualCollection = $repository->find(FiscalNoteFixtures::ACCESS_KEY['VALID']);
    $this->assertGreaterThan(0, $actualCollection->count());
  }

  public function testFindFiscalNoteByAccessKeyInvalid()
  {
    $expectedCollection = new Collection();
    $repository = $this->getRepositoryFindMock($expectedCollection);

    $actualCollection = $repository->find(FiscalNoteFixtures::ACCESS_KEY['INVALID']);
    $this->assertEquals(0, $actualCollection->count());
  }

  public function testSaveFiscalNote()
  {
    $expectedFiscalNote = factory(FiscalNote::class);
    $expectedCollection = new Collection([$expectedFiscalNote]);
    $repository = $this->getRepositorySaveMock($expectedFiscalNote, $expectedCollection);

    $actualCollection = $repository->save($expectedFiscalNote);
    $this->assertGreaterThan(0, $actualCollection->count());
  }

  private function getRepositoryFindMock($collection)
  {
    $repository = $this->mock(FiscalNoteRepositoryInterface::class, function($mock) use ($collection) {
      $mock->shouldReceive('find')
      ->once()
      ->andReturn($collection);
    });
    return $repository;
  }

  private function getRepositorySaveMock($data, $collection)
  {
    $repository = $this->mock(FiscalNoteRepositoryInterface::class, function($mock) use ($data, $collection) {
      $mock->shouldReceive('save')
      ->with($data)
      ->once()
      ->andReturn($collection);
    });
    return $repository;
  }
}
