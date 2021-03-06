<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'BlogId';
    protected $fillable = ['Title', 'Body'];

    public function itemsCollection2()
    {
        return $this->hasMany(Items2::class, 'BlogId2');
    }
}
