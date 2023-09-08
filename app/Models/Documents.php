<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'type',
        'description',
        'has_user_name',
        'has_lawyer_name',
        'has_signature',
        'has_stamp',
        'show_sign_date',
        'user_name_config',
        'lawyer_name_config',
        'signature_config',
        'stamp_config',
        'signed_date_config',
        'lawyers_assigned',
        'attachments',
        'document_path',
        'year',
    ];

    
    use HasFactory;

    public function signed(){
        return $this->hasMany(SignedDocuments::class, 'document_id');
    }

    public function consent(){
        return $this->hasMany(ConsentDocuments::class, 'document_id');
    }
}
