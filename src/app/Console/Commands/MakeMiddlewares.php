<?php

namespace HMVC_Generator\app\Console\Commands;

use Illuminate\Console\Command;

class MakeMiddlewares extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:middleware {name} {--module_name}';

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
        $module_path =  app_path(DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . $module_name) . DIRECTORY_SEPARATOR;
        if (!file_exists($module_path)) {
            $this->error(sprintf('%s module is not exists', $module_name));
            return;
        }
        $middleware_path = $module_path . 'Http' . DIRECTORY_SEPARATOR . 'Middleware';
        if (!file_exists($middleware_path)) {
            mkdir($middleware_path, 0777, true);
        }
        $middleware_template = str_replace(['{{module_name}}', '{{module_name_small}}', '{{middleware_name}}'], [$module_name, strtolower($module_name), $name], get_stub('Middleware'));
        file_put_contents($middleware_path . DIRECTORY_SEPARATOR . $name.'.php', $middleware_template);
        $this->info('Done !');
    }
}
