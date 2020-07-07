<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded=[];

    public function abilities()
    {
        return $this->belongsToMany(Ability::class)->withTimestamps();
    }
    //assign ability to role
    public function assignTo($ability)
    {

        if(is_string($ability))
        {
            $role=Ability::whereName($ability)->firstOrFail();
        }

         $this->abilities()->sync($ability,false);
    }

}
