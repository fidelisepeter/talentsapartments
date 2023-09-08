<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignedDocuments extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document_id',
        'lawyer_id',
        // 'user_id',
        'signatures',
        'signatures_status',
        'stamps',
        'stamps_status',
        'names',
        'names_status',
        'signed_date',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function document()
    {
        return $this->belongsTo(Documents::class, 'document_id');
    }

    // public function user()
    // {
    //     return $this->hasOne(User::class, 'id', 'user_id');
    // }
}
