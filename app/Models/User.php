<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use function App\View\Components\send_mail;


use Laragear\WebAuthn\WebAuthnAuthentication;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laragear\WebAuthn\Contracts\WebAuthnAuthenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable implements WebAuthnAuthenticatable
{

    use HasApiTokens, HasFactory, Notifiable, WebAuthnAuthentication, HasRoles;


    /**
     * Load User FUll Names when name is being call.
     *
     * @param  string  $token
     * @return void
     */

    public $name;

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            $model->name = $model->first_name . ' ' . $model->middle_name . ' ' . $model->last_name;
        });
    }

 /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */

    public function sendPasswordResetNotification($token)
    {


        // dd($this->email);

        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->email,
        ], false));

        $message = '<h1>Hello!</h1>';
        $message .= '<p>You are receiving this email because we received a password reset request for your account.</p>';
        $message .= '<a href="' . $url . '" rel="noopener" style="box-sizing: border-box;border-radius: 4px;display: inline-block;overflow: hidden;text-decoration: none;padding: 8px 18px;color: #fff;background-image: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%);" target="_blank">Reset Password</a>';
        $message .= '<p>If you did not request a password reset, no further action is required.</p>';
        $message .= '<p>If you are having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: ' . $url . '</p>';

        send_mail($this->first_name, $this->email, 'Reset Password Notification', $message);

        // $url = url('reset-password?token='.$token);
        // $input = ['[full_name]', '[transaction_id]', '[link]', '[type]', '[auth]'];
        // // $outfilled = [$invoice->full_name, $transaction_id, $link ?? '', $invoice->type, ''];
        // // $message =  str_replace($input, $outfilled,  DB::table('settings')->value('manual_payment_confirmation_message'));

        // // send_mail($invoice->full_name, $invoice->email, 'Rent Booking Payment', $message);



        // $this->notify(new ResetPasswordNotification($token));
        // $this->notify(new ResetPasswordNotification($url));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'suffix',
        'photo',
        'first_name',
        'last_name',
        'middle_name',
        'matric_number',
        'street',
        'city',
        'country',
        'phone_number',
        'email',
        'year',
        'password',
        'verification_code',
        'application_form_number',
        'ta_uid',
        'email_verified_at',
        'role',
        'company',
        'inscription',
        'office_phone',
        'note',
        'note_1',
        'enable_biometrics',
        'referrer',
        'referral_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function lawyer()
    {
        return $this->hasOne(Lawyer::class);
    }

    public function consent_document()
    {
        return $this->hasMany(ConsentDocuments::class);
    }

    public function signed_documents()
    {
        return $this->hasMany(SignedDocuments::class);
    }

    public function guest()
    {
        return $this->hasMany(Guest::class);
    }

    public function bedspace()
    {
        return $this->hasOne(BedSpace::class);
    }
}
