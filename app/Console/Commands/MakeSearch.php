<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeSearch extends Command
{
    protected $signature = 'make:search {name}';
    protected $description = 'Create a Search class with search & filter boilerplate';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));

        $folder = app_path('Search');
        $path = $folder . "/{$name}Search.php";

        // Create folder if missing
        if (!File::exists($folder)) {
            File::makeDirectory($folder);
        }

        // Stop overwrite
        if (File::exists($path)) {
            $this->error("Search file already exists: {$path}");
            return;
        }

        // File template
        $stub = <<<PHP
<?php

namespace App\\Search;

use Illuminate\Database\Eloquent\Builder;

class {$name}Search
{
    public function apply(Builder \$query, array \$filters): Builder
    {
        // Text search
        if (!empty(\$filters['search'])) {
            \$query->where('name', 'LIKE', "%{\$filters['search']}%");
        }

        // Category filter example
        if (!empty(\$filters['category'])) {
            \$query->where('category_id', \$filters['category']);
        }

        // Date range filter
        if (!empty(\$filters['start_date'])) {
            \$query->whereDate('created_at', '>=', \$filters['start_date']);
        }

        if (!empty(\$filters['end_date'])) {
            \$query->whereDate('created_at', '<=', \$filters['end_date']);
        }

        return \$query;
    }
}
PHP;

        // Create file
        File::put($path, $stub);

        $this->info("✔ Search file created: {$path}");
    }
}
