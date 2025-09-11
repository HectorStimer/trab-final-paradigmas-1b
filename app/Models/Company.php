<?php

namespace App\Models;

use illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    use HasFactory;

    protected $fillable = [

        'name',
        'responsible_id',
        'licended',


    ];

    protected $casts = [
        'licensed' => 'boolean',
    ];

    public function responsible(){
        return $this->belongTo(\App\Models\User::class, 'responsile_id');
    }

}
