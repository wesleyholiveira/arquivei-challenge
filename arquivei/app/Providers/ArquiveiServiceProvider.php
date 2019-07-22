<?php

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use App\Http\Service\Arquivei\ArquiveiService;
use App\Http\Service\Arquivei\ArquiveiServiceInterface;
use App\Http\Domain\FiscalNote\Repository\FiscalNoteRepositoryInterface;
use App\Http\Domain\FiscalNote\Repository\FiscalNoteRepository;
use App\Http\Domain\FiscalNote\Model\FiscalNote;

class ArquiveiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ClientInterface::class, function ($app) {
            return new Client();
        });

        $this->app->bind(FiscalNoteRepositoryInterface::class, function ($app) {
            return new FiscalNoteRepository();
        });

        $this->app->bind(ArquiveiServiceInterface::class, function ($app) {
            return new ArquiveiService(
                $app->make(FiscalNoteRepositoryInterface::class),
                $app->make(ClientInterface::class)
            );
        });
    }
}
