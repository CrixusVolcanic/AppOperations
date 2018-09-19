<?php

namespace AppOperations;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'tbl_countries';
    protected $fillable = ['picture'];
}
