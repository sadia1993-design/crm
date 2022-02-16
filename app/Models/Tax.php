<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $table = 'taxes';
    protected $fillable = ['rule'];

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}