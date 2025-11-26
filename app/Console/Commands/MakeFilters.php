<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeFilters extends Command
{
    protected $signature = 'make:filter {name}';
    protected $description = 'Create a Filter class for search & filters';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));

        $path = app_path("Filters/{$name}Filter.php");

        // Create folder if not exists
        if (!File::exists(app_path('Filters'))) {
            File::makeDirectory(app_path('Filters'));
        }

        // Prevent overwrite
        if (File::exists($path)) {
            $this->error("Filter already exists: {$path}");
            return;
        }

        $stub = <<<PHP
<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class {$name}Filter
{
    public function apply(Builder \$query, array \$filters): Builder
    {
        // Text search
        if (!empty(\$filters['search'])) {
            \$query->where('name', 'LIKE', "%{\$filters['search']}%");
        }

        // Category filter
        if (!empty(\$filters['category'])) {
            \$query->where('category_id', \$filters['category']);
        }

        // Start date
        if (!empty(\$filters['start_date'])) {
            \$query->whereDate('created_at', '>=', \$filters['start_date']);
        }

        // End date
        if (!empty(\$filters['end_date'])) {
            \$query->whereDate('created_at', '<=', \$filters['end_date']);
        }

        return \$query;
    }
}
PHP;

        File::put($path, $stub);

        $this->info("Filter created: {$path}");
    }
}
