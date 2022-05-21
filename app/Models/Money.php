<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use HasFactory;

     protected $table='monies';


    protected $fillable = ['add_money','minus_money','comment','time','cat_id','user_id'];
    private $id;

    public function category()
    {
//        return $this->belongsTo(Category::class);
        return $this->belongsTo(Category::class, 'cat_id');
//        return $this->belongsToMany(Category::class, 'categories','cat_id','id');
    }
}
