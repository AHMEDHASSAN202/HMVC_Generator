<?php

namespace HMVC_Generator\app\Console\Commands;

use Illuminate\Console\Command;

class MakeModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:model {name} {--module_name=}';

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
        if (!file_exists($module_path . 'Models')) {
            mkdir($module_path . 'Models', 0777, true);
        }
        $model_template = str_replace(['{{module_name}}', '{{module_name_small}}', '{{model_name}}'], [$module_name, strtolower($module_name), $name], get_stub('Model'));
        file_put_contents($module_path . 'Models' . DIRECTORY_SEPARATOR . $name.'.php', $model_template);
        $this->info('Done !');
    }
}
