<?php

namespace App\Http\Domain\FiscalNote\Model;

use Illuminate\Database\Eloquent\Model;

class FiscalNote extends Model
{
    protected $primaryKey = 'access_key';
    protected $keyType = 'string';

    public $incrementing = false;
}
