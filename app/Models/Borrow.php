<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'returned_at',
        'due_date',
        'fine_amount',
        'condition',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'returned_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'due_date' => 'datetime',
        'fine_amount' => 'decimal:2',
    ];
}
