<?php

namespace App\Domain\FiscalNote\Repository;

interface FiscalNoteRepositoryInterface
{
    public function find($accessKey);
    public function save($content);
}
