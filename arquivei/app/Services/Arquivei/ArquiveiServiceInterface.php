<?php

namespace App\Services\Arquivei;

interface ArquiveiServiceInterface
{
    public function find($accessKey);
    public function feed();
}
