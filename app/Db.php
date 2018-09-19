<?php

namespace AppOperations;

use Illuminate\Database\Eloquent\Model;

class Db extends Model
{
    protected $table = 'tbl_dbs';

    public function country(){
        return $this->hasOne(Country::class, 'id', 'id_country');
    }

    public function provider(){
        return $this->hasOne(Person::class, 'id', 'id_provider');
    }

    public function analyst(){
        return $this->hasOne(Person::class, 'id', 'id_analyst');
    }
}
