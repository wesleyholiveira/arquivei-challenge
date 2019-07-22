<?php

namespace App\Http\Service\Arquivei;

interface ArquiveiServiceInterface
{
    public function find($accessKey);
    public function feed($url, $params);
}
