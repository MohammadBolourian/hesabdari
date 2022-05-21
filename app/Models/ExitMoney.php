<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExitMoney extends Model
{
    use HasFactory;

    protected $table='exit_monies';

    protected $fillable = ['user_id','name','price','day'];

}
