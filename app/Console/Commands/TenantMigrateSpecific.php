<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class TenantMigrateSpecific extends Command
{
    protected $signature = 'tenant:migrate-specific {tenant} {migration}';
    protected $description = 'Run a specific migration for a tenant';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tenant = $this->argument('tenant');
        $migration = $this->argument('migration');

        // Switch to the tenant's database
        $this->setTenantConnection($tenant);

        // Run the specific migration
        Artisan::call('migrate', [
            '--path' => "database/migrations/tenant/{$migration}.php"
        ]);

        $this->info("Migration {$migration} has been run for tenant {$tenant}");
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
