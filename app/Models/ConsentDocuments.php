<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentDocuments extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'user_id',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function document()
    {
        return $this->belongsTo(Documents::class, 'document_id');
    }
}
