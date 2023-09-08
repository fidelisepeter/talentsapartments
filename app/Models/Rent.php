<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function getStatusPercentageAttribute()
    {
        $status = 0;
        if (
            $this->school_check_status != 'Approved' &&
            $this->payment_reference == null &&
            $this->guarantor_letter_photo == null &&
            $this->health_check_photo == null &&
            $this->attestation_letter_photo == null
        ) {
            $status = 10;
        } elseif (
            $this->school_check_status == 'Approved' &&
            $this->payment_reference == null &&
            $this->guarantor_letter_photo == null &&
            $this->health_check_photo == null &&
            $this->attestation_letter_photo == null
        ) {
            $status = 20;
        } elseif (
            $this->school_check_status == 'Approved' &&
            $this->payment_reference != null &&
            $this->guarantor_letter_photo == null &&
            $this->health_check_photo == null &&
            $this->attestation_letter_photo == null
        ) {
            $status = 35;
        } elseif (
            $this->school_check_status == 'Approved' &&
            $this->payment_reference != null &&
            $this->guarantor_letter_photo != null &&
            $this->health_check_photo == null &&
            $this->attestation_letter_photo == null
        ) {
            $status = 70;
        } elseif (
            $this->school_check_status == 'Approved' &&
            $this->payment_reference != null &&
            $this->guarantor_letter_photo != null &&
            $this->health_check_photo != null &&
            $this->attestation_letter_photo == null
        ) {
            $status = 85;
        } elseif (
            $this->school_check_status == 'Approved' &&
            $this->payment_reference != null &&
            $this->guarantor_letter_photo != null &&
            $this->health_check_photo != null &&
            $this->attestation_letter_photo != null
        ) {
            $status = 100;
        }
        return  $status;
    }
}
