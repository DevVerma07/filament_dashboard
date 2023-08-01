<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\SupportTicketFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportTicket extends Model
{

    use HasFactory;
    protected $table = "support_tickets";

    protected $fillable = [
        'question',
    ];

    public function comments()
    {
        return $this->hasMany('Comment::class');
    }
}
