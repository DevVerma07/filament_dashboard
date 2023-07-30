<?php

namespace App\Models;

use App\Models\SupportTicket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function support_teeicket()
    {
        return $this->belongsTo(SupportTicket::class);
    }
}
