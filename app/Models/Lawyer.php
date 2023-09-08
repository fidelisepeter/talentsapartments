<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'signature',
        'stamp',
        'salary',
        'year',
        'start_date',
        'new_document_email_notification',
    ];

    public function get()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function name()
    {
        $user = User::where('id', $this->get->id)->first();
        $name = $user->first_name.' '.$user->middle_name.' '.$user->last_name;
        return $name;
    }

    public function documents()
    {
        $get_document = [];
        $documents = Documents::all();
        foreach($documents as $document){

            $lawyers_assigned = json_decode($document->lawyers_assigned);
            if(in_array($this->id, $lawyers_assigned ?? [])){

                $get_document[] = $document;
            }
        }
        $documents = $get_document;
        
        if(count($documents) !== 0){

            return $documents;
        }else{
            return [];
        }
        
    }

    public function agreement_forms()
    {
        $get_document = [];
        // $documents = Documents::all();
        $documents = ConsentDocuments::all();
        foreach($documents->unique('document_id') as $consent){

            $lawyers_assigned = json_decode($consent->document()->value('lawyers_assigned'));
            if(in_array($this->id, $lawyers_assigned)){

                $get_document[] = $consent->document;
            }
        }
        $documents = $get_document;
        
        if(count($documents) !== 0){

            return $documents;
        }else{
            return [];
        }
        
    }
}
