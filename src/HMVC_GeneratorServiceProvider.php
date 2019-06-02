<?php

namespace HMVC_Generator;

use Illuminate\Support\ServiceProvider;
use HMVC_Generator\app\Console\Commands\MakeControllers;
use HMVC_Generator\app\Console\Commands\MakeMiddlewares;
use HMVC_Generator\app\Console\Commands\MakeMigrations;
use HMVC_Generator\app\Console\Commands\MakeModels;
use HMVC_Generator\app\Console\Commands\MakeModules;
use HMVC_Generator\app\Console\Commands\MakeRequests;

class HMVC_GeneratorServiceProvider extends ServiceProvider
{

    protected $commands = [
        MakeModules::class,
        MakeControllers::class,
        MakeModels::class,
        MakeMiddlewares::class,
        MakeRequests::class,
        MakeMigrations::class
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands($this->commands);
    }
}
