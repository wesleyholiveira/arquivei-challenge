<?php

namespace App\Http\Domain\FiscalNote\Repository;

interface FiscalNoteRepositoryInterface
{
    public function find($accessKey);
    public function save($content);
}
