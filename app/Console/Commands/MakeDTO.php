<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDTO extends Command
{
    protected $signature = 'make:dto {name}';
    protected $description = 'Create a Data Transfer Object (DTO)';

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("DTOs/{$name}.php");
        $directory = app_path("DTOs");
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (File::exists($path)) {
            $this->error("DTO already exists!");
            return;
        }

        $stub = <<<PHP
<?php

namespace App\DTOs;

class {$name}
{
    public function __construct(
        // add your props here
    ) {}
}
PHP;

        File::put($path, $stub);
        $this->info("DTO created: {$path}");
    }
}
