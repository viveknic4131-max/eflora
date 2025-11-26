<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a Service class';

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Services/{$name}.php");
        $directory = app_path("Services");
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        if (File::exists($path)) {
            $this->error("Service already exists!");
            return;
        }

        $stub = <<<PHP
<?php

namespace App\Services;

class {$name}
{
    // Example:
    // public function handle() {}
}
PHP;

        File::put($path, $stub);
        $this->info("Service created: {$path}");
    }
}
