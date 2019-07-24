<?php

namespace App\Domain\FiscalNote\Repository;

use App\Domain\FiscalNote\Model\FiscalNote;
use Illuminate\Database\QueryException;
use App\Exceptions\FiscalNoteRepositoryException;

class FiscalNoteRepository implements FiscalNoteRepositoryInterface
{
    public function find($accessKey)
    {
        return FiscalNote::where('access_key', $accessKey)->get();
    }

    public function save($data)
    {
        try {
            $collection = collect();
            foreach ($data as $note) {
                $collection->add(factory(FiscalNote::class)->create([
                    'access_key' => $note->access_key,
                    'xml' => $note->xml
                ]));
            }
            return $collection;
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                throw new FiscalNoteRepositoryException('Records already exists', $e->getCode(), $e);
            }
            return $e;
        }
    }
}
