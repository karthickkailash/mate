<?php 
namespace App\Models; 
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tenant extends BaseTenant implements TenantWithDatabase
{ 
    use HasDatabase, HasDomains,SoftDeletes;
    protected $connection = 'mysql'; 
    protected $fillable = ['id','data'];
    protected $casts = [
        'data' => 'array',
    ];
    
    //Define the relationship to the Domain model
    public function domains()
    {
        return $this->hasMany(Domain::class, 'tenant_id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}