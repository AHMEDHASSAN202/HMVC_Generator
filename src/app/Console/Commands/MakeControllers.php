<?php

namespace HMVC_Generator\app\Console\Commands;

use Illuminate\Console\Command;

class MakeControllers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:controller {name} {--module_name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Controllers For Module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module_name = $this->option('module_name') ?? $this->ask("Module Name ?");
        $module_path = app_path(DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . $module_name) . DIRECTORY_SEPARATOR;
        if (!file_exists($module_path)) {
            $this->error(sprintf('%s module is not exists', $module_name));
            return;
        }
        if (!file_exists($module_path . 'Http' . DIRECTORY_SEPARATOR . 'Controllers')) {
            mkdir($module_path . 'Http' . DIRECTORY_SEPARATOR . 'Controllers', 0777, true);
        }
        $controller_template = str_replace(['{{module_name}}', '{{module_name_small}}', '{{controller_name}}'], [$module_name, strtolower($module_name), $name], get_stub('Controller'));
        file_put_contents($module_path . 'Http' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $name . '.php', $controller_template);
        $this->info('Done !');
    }

}
