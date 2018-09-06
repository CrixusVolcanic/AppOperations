<?php

namespace AppOperations;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'tbl_persons';

    public function tp_persons(){
        return $this->hasOne(TpPerson::class, 'id', 'id_tp_person');
    }
}
