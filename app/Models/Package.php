<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'max_customers', 'price', 'description'];

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}
