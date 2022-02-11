<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalItem extends Model
{
    use HasFactory;
    protected $table = 'proposal_items';
    protected $fillable = ['proposal_id', 'item_id'];

    public function proposal()
    {
        return $this->belongsTo('App\Models\Proposal', 'proposal_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id', 'id');
    }
}
