<?php 

namespace App\Console\Commands; 
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class MigrateTenantFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:migrateFiles {tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate tenant folder if it does not exist and run migrations if new files are present';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tenant = $this->argument('tenant');
        $tenantFolder = database_path('migrations/tenant');

        if (File::exists($tenantFolder)) {
            $this->info("The folder '{$tenantFolder}' already exists.");

            // Get the list of migration files in the tenant folder
            $migrationFiles = File::files($tenantFolder);

            if (empty($migrationFiles)) {
                $this->info("No migration files found in the '{$tenantFolder}' folder. No migration needed.");
            } else {
                $this->setTenantConnection($tenant);
                // Get the list of applied migrations
                $appliedMigrations = DB::table('migrations')->pluck('migration')->toArray();

                $newMigrations = [];
                foreach ($migrationFiles as $file) {
                    $migrationName = pathinfo($file, PATHINFO_FILENAME);
                    if (!in_array($migrationName, $appliedMigrations)) {
                        $newMigrations[] = $migrationName;
                    }
                }

                if (empty($newMigrations)) {
                    $this->info("No new migrations found. All migrations have been applied.");
                } else {
                    $this->info("New migration files found. Running migrations...");
                    
                    // Run migrations for the tenant folder
                    Artisan::call('migrate', [
                        '--path' => 'database/migrations/tenant',
                    ]);

                    $this->info(Artisan::output());
                    $this->info("Migrations have been run.");
                }
            }
        } else {
            try {
                // Ensure the tenant directory is created
                File::makeDirectory($tenantFolder, 0755, true);
                $this->info("The folder '{$tenantFolder}' has been created.");
                $this->info("No migration files were found. No migration needed.");
            } catch (\Exception $e) {
                $this->error("An error occurred: " . $e->getMessage());
            }
        }

        return 0;
    }

    protected function setTenantConnection($tenant)
    {
        // Assuming you have a method to get the tenant's database configuration
        $tenantDbConfig = $this->getTenantDbConfig($tenant);

        config()->set('database.connections.tenant', $tenantDbConfig);
        DB::purge('tenant');
        DB::reconnect('tenant');
        DB::setDefaultConnection('tenant');
    }

    protected function getTenantDbConfig($tenant)
    {
        // Replace this with your logic to get the tenant's database configuration
        return [
            'driver' => 'mysql',
           'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => $tenant,  //tenant_dreams
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ];
    }
}
