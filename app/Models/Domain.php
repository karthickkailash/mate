<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Domain as BaseDomain;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends BaseDomain
{
    use SoftDeletes;
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}