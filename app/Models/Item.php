<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $fillable = ['unit_id', 'tax_id', 'name', 'rate', 'description'];

    public function proposalItem()
    {
        return $this->hasMany(ProposalItem::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id', 'id');
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class, 'tax_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
