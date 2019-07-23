<?php

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\Arquivei\ArquiveiService;
use App\Services\Arquivei\ArquiveiServiceInterface;
use App\Domain\FiscalNote\Model\FiscalNote;
use App\Domain\FiscalNote\Repository\FiscalNoteRepositoryInterface;
use App\Domain\FiscalNote\Repository\FiscalNoteRepository;

class ArquiveiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ClientInterface::class, function () {
            return new Client();
        });

        $this->app->bind(FiscalNoteRepositoryInterface::class, function ($app) {
            return new FiscalNoteRepository(
                $app->make(FiscalNote::class)
            );
        });

        $this->app->bind(ArquiveiServiceInterface::class, function ($app) {
            return new ArquiveiService(
                $app->make(FiscalNoteRepositoryInterface::class),
                $app->make(ClientInterface::class),
                config('app.arquivei')
            );
        });
    }
}
