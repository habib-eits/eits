<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $table = 'party';
    protected $primaryKey = 'PartyID';

    protected $fillable = [
        'partyid',
        'name',
        'tel',
        'other_tel',
        'business_details',
        'service',
        'channel',
        'campaign_id',
        'branch_id',
        'agent_id',
        'service_id',
        'sub_service_id',
        'currency',
        'amount',
        'created_at',
        'updated_at',
    ];
}
