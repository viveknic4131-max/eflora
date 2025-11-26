<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repo {name}';
    protected $description = 'Create a Repository class';

    public function handle()
    {
        $name = $this->argument('name');
          $directory = app_path("Repositories");
        $path = app_path("Repositories/{$name}.php");

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (File::exists($path)) {
            $this->error("Repository already exists!");
            return;
        }

        $stub = <<<PHP
<?php

namespace App\Repositories;

class {$name}
{
    // Example:
    // public function all() {}
}
PHP;

        File::put($path, $stub);
        $this->info("Repository created: {$path}");
    }
}
