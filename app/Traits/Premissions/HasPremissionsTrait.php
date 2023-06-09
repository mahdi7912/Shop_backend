<?php

namespace App\Traits\Premissions;

use App\Models\Premission;
use App\Models\Role;

trait HasPremissionsTrait
{

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function premissions()
    {
        return $this->belongsToMany(Premission::class);
    }

    public function hasPremission($premission)
    {
        return (bool) $this->premissions->where('name', $premission->name)->count();
    }

    public function hasPremissionTo($premission)
    {
        return $this->hasPremission($premission) || $this->hasPremissionThroughRole($premission);
    }


    public function hasPremissionThroughRole($premission)
    {
        foreach ($premission->roles as $role) {
            if ($this->role->contains($role)) {
                return true;
            }else {
                return false;
            }
        }
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name' , $role)) {
                return true;
            }else{
                return false;
            }

        }
    }
}
