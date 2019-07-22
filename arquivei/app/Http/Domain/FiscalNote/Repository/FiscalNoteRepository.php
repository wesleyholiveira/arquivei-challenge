<?php

namespace App\Http\Domain\FiscalNote\Repository;

use App\Http\Domain\FiscalNote\Model\FiscalNote;
use Illuminate\Database\QueryException;

class FiscalNoteRepository implements FiscalNoteRepositoryInterface
{
    public function find($accessKey)
    {
        return FiscalNote::where('access_key', $accessKey)->get();
    }

    public function save($data)
    {
        try {
            $collection = [];
            foreach ($data as $note) {
                factory(FiscalNote::class)->create([
                    'access_key' => $note->access_key,
                    'xml' => $note->xml
                ]);
            }
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                throw new \Exception('Records already exists', $e->getCode(), $e);
            }
            return $e;
        }
    }
}
