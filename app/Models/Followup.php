<?php

namespace App\Models;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Followup extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'user_id',
        'notes',
        'remarks',
        'status',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
