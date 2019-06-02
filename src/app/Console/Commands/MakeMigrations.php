<?php

namespace HMVC_Generator\app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:migration {name} {--module_name=} {--table=} {--create=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $module_name = $this->option('module_name') ?? $this->ask("Module Name ?");
        $create = $this->option('create');
        $table = $this->option('table');
        $module_path =  app_path(DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . $module_name) . DIRECTORY_SEPARATOR;
        if (!file_exists($module_path)) {
            $this->error(sprintf('%s module is not exists', $module_name));
            return;
        }
        $migration_path = $module_path . 'Database' . DIRECTORY_SEPARATOR . 'Migrations';
        if (!file_exists($migration_path)) {
            mkdir($migration_path, 0777, true);
        }
        $related_path = 'app/Modules/' . $module_name . '/Database/Migrations';
        Artisan::call('make:migration '. $name . ' --path='. $related_path . ' --create=' . $create . ' --table=' . $table);
        $this->info('Done !');
    }
}
