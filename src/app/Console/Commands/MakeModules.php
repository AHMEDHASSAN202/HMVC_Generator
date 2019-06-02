<?php

namespace HMVC_Generator\app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeModules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {module_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Module For HMVC Pattern';

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
        $module_name  = ucfirst($this->argument('module_name'));
        $module_path = app_path(DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . $module_name) . DIRECTORY_SEPARATOR;
        $this->create_folders($module_path, $module_name);
        $this->stub_files($module_path, $module_name);
        $this->info('Module created successfully.');
    }

    private function create_folders($module_path, $module_name)
    {
        if (is_dir($module_path)){
             $this->error('module is exists');
            return;
        }
        mkdir($module_path . 'Config', 0777, true);
        mkdir($module_path . 'Database' . DIRECTORY_SEPARATOR . 'Migrations', 0777, true);
        mkdir($module_path . 'Providers', 0777, true);
        mkdir($module_path . 'Resources' . DIRECTORY_SEPARATOR . 'Lang' . DIRECTORY_SEPARATOR . 'ar', 0777, true);
        mkdir($module_path . 'Resources' . DIRECTORY_SEPARATOR . 'Lang' . DIRECTORY_SEPARATOR . 'en', 0777, true);
        mkdir($module_path . 'Resources' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . strtolower($module_name), 0777, true);
        mkdir($module_path . 'Routes', 0777, true);
        Artisan::call('module:request', ['name' => 'TestRequest', '--module_name' => ucfirst($module_name)]);
        Artisan::call('module:middleware', ['name' => 'TestMiddleware', '--module_name' => ucfirst($module_name)]);
        Artisan::call('module:controller', ['name' => 'TestController', '--module_name' => ucfirst($module_name)]);
        Artisan::call('module:model', ['name' => 'Test', '--module_name' => ucfirst($module_name)]);
    }

    private function stub_files($module_path, $module_name)
    {
        $service_provider_template = str_replace(['{{module_name}}', '{{module_name_small}}'], [$module_name, strtolower($module_name)], get_stub('ServiceProvider'));
        $web_template = str_replace(['{{module_name}}', '{{module_name_small}}'], [$module_name, strtolower($module_name)], get_stub('Web'));
        $api_template = str_replace(['{{module_name}}', '{{module_name_small}}'], [$module_name, strtolower($module_name)], get_stub('Api'));
        file_put_contents($module_path . 'Providers' . DIRECTORY_SEPARATOR . $module_name.'ServiceProvider.php', $service_provider_template);
        file_put_contents($module_path . 'Routes' . DIRECTORY_SEPARATOR . 'web.php', $web_template);
        file_put_contents($module_path . 'Routes' . DIRECTORY_SEPARATOR . 'api.php', $api_template);
        file_put_contents($module_path . 'Resources' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'test.blade.php', '<h1>'.$module_name.'</h1>');
    }

}
