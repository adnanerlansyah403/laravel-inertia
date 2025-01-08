<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $guarded = ['id'];


    protected static function boot() {
        parent::boot();

        static::creating(function ($role) {
            $role->slug = Str::slug($role->name);
        });
        static::updating(function ($role) {
            $role->slug = Str::slug($role->name);
        });
    }

}
