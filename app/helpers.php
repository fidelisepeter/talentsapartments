<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




    function send_mail($first_name,$email, $subject,$message)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {
            
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;
            if(env('MAIL_DRIVER', '') == 'smtp'){
                $mail->isSMTP();    //Send using SMTP
            }                                      
            $mail->Host       = env('MAIL_HOST', '');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME'); //Set the                     //SMTP username
            $mail->Password   = env('MAIL_PASSWORD');                               //SMTP password
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');            //Enable implicit TLS encryption
            $mail->Port       = env('MAIL_PORT', 587); //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('Reservations@talentsapartments.com', 'Talents Apartments');
            $mail->addAddress($email, $first_name);     //Add a recipient
           // $mail->addAddress('blackgenius9000@gmail.com');               //Name is optional
            $mail->addReplyTo('Reservations@talentsapartments.com', 'Talents Apartments');
            // $mail->addCC('blackgenius9000@gmail.com');
            // $mail->addBCC('blackgenius9000@gmail.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
          //  $mail->addAttachment('./photo/20220120080003.png');  //Add attachments

            //Content
            $message = view('mail')->with([
                'message' => $message,
                'subject' => $subject,
                 ]);
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody =  $message;
            $mail->send();
            return;
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }

    function createNotification($title, $created_by, $message){
        DB::table('notifications')->insert([
             'title' => $title,
             'created_by' => $created_by,
             'message' => $message,
             'year' => DB::table('settings')->value('current_year'),
             'created_at'=>Carbon::now()
         ]);

         foreach(DB::table('users')->where('role', 'super_admin')->where('role', 'admin')->get() as $admin){
            send_mail($admin->first_name, $admin->email, $title, $created_by.' '.$message);
         }
         return;
    }


    function sendPdf( $first_name, $email, $subject,$message, $file_location)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;
            if(env('MAIL_DRIVER', '') == 'smtp'){
                $mail->isSMTP();    //Send using SMTP
            }                                      
            $mail->Host       = env('MAIL_HOST', '');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME'); //Set the                     //SMTP username
            $mail->Password   = env('MAIL_PASSWORD');                               //SMTP password
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');            //Enable implicit TLS encryption
            $mail->Port       = env('MAIL_PORT', 587); //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('Reservations@talentsapartments.com', 'Talents Apartments');
            $mail->addAddress($email, $first_name);     //Add a recipient
            $mail->addReplyTo('Reservations@talentsapartments.com', 'Talents Apartments');
            $mail->addAttachment($file_location);  //Add attachments

            //Content
            $message = view('mail')->with([
                'message' => $message,
                'subject' => $subject,
                 ]);
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
             echo 'Message has been sent';
            return;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }


    function sendGurantorForm($user_id)
    {


        $settings = DB::table('settings')->first();
        $subject = 'Talents Apartment Guarantor Form';
        // $file_location = asset('guarantor.pdf');
        $user = DB::table('users')->where('id', $user_id)->first();
        $file_location = asset($settings->guarantor_form_file);
        // $file_location = storage_path('/app/public/site-files/guarantor.pdf');

       
        
        $input = ['[first_name]', '[middle_name]', '[last_name]', '[guarantor_first_name]', '[guarantor_title]', '[guarantor_last_name]', '[session_year]', '[pass]', '[profile_link]'];
        $outfilled = [$user->first_name, $user->middle_name, $user->last_name, $user->g_first_name, $user->g_suffix, $user->g_last_name, $settings->current_year, $password ?? '', url('/profile')];
        $message =  str_replace($input, $outfilled, $settings->guarantor_form_message);

        
        
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;
            if(env('MAIL_DRIVER', '') == 'smtp'){
                $mail->isSMTP();    //Send using SMTP
            }                                      
            $mail->Host       = env('MAIL_HOST', '');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME'); //Set the                     //SMTP username
            $mail->Password   = env('MAIL_PASSWORD');                               //SMTP password
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');            //Enable implicit TLS encryption
            $mail->Port       = env('MAIL_PORT', 587); //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('Reservations@talentsapartments.com', 'Talents Apartments');
            $mail->addAddress($user->g_email, $user->g_first_name);     //Add a recipient
            $mail->addReplyTo('Reservations@talentsapartments.com', 'Talents Apartments');
            $mail->addAttachment($file_location);  //Add attachments

            //Content
            $message = view('mail')->with([
                'message' => $message,
                'subject' => $subject,
                 ]);
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
             echo 'Message has been sent';
            //  dd($file_location);
            return;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


    function sendHealthForm($user_id)
    {

        $settings = DB::table('settings')->first();
        $subject = 'Talents Apartment Health Form';
        // $file_location = asset('guarantor.pdf');
        $user = DB::table('users')->where('id', $user_id)->first();
        $file_location = asset($settings->health_form_file);

        
        
        $input = ['[first_name]', '[middle_name]', '[last_name]', '[guarantor_first_name]', '[guarantor_title]', '[guarantor_last_name]', '[session_year]', '[pass]', '[profile_link]'];
        $outfilled = [$user->first_name, $user->middle_name, $user->last_name, $user->g_first_name, $user->g_suffix, $user->g_last_name, $settings->current_year, $password ?? '', url('/profile')];
        $message =  str_replace($input, $outfilled, $settings->health_form_message);

        
        
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;
            if(env('MAIL_DRIVER', '') == 'smtp'){
                $mail->isSMTP();    //Send using SMTP
            }                                      
            $mail->Host       = env('MAIL_HOST', '');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME'); //Set the                     //SMTP username
            $mail->Password   = env('MAIL_PASSWORD');                               //SMTP password
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');            //Enable implicit TLS encryption
            $mail->Port       = env('MAIL_PORT', 587); //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('Reservations@talentsapartments.com', 'Talents Apartments');
            $mail->addAddress($user->email, $user->first_name);     //Add a recipient
            $mail->addReplyTo('Reservations@talentsapartments.com', 'Talents Apartments');
            $mail->addAttachment($file_location);  //Add attachments

            //Content
            $message = view('mail')->with([
                'message' => $message,
                'subject' => $subject,
                 ]);
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
             echo 'Message has been sent';
            //  dd($file_location);
            return;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function sendAttestationForm($user_id)
    {

        $settings = DB::table('settings')->first();
        $subject = 'Talents Apartment Attestation Form';
        // $file_location = asset('guarantor.pdf');
        $user = DB::table('users')->where('id', $user_id)->first();
        $file_location = asset($settings->attestation_form_file);

        
        
        $input = ['[first_name]', '[middle_name]', '[last_name]', '[guarantor_first_name]', '[guarantor_title]', '[guarantor_last_name]', '[session_year]', '[pass]', '[profile_link]'];
        $outfilled = [$user->first_name, $user->middle_name, $user->last_name, $user->g_first_name, $user->g_suffix, $user->g_last_name, $settings->current_year, $password ?? '', url('/profile')];
        $message =  str_replace($input, $outfilled, $settings->attestation_form_message);

        
        
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;
            if(env('MAIL_DRIVER', '') == 'smtp'){
                $mail->isSMTP();    //Send using SMTP
            }                                      
            $mail->Host       = env('MAIL_HOST', '');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME'); //Set the                     //SMTP username
            $mail->Password   = env('MAIL_PASSWORD');                               //SMTP password
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');            //Enable implicit TLS encryption
            $mail->Port       = env('MAIL_PORT', 587); //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('Reservations@talentsapartments.com', 'Talents Apartments');
            $mail->addAddress($user->email, $user->first_name);     //Add a recipient
            $mail->addReplyTo('Reservations@talentsapartments.com', 'Talents Apartments');
            $mail->addAttachment($file_location);  //Add attachments

            //Content
            $message = view('mail')->with([
                'message' => $message,
                'subject' => $subject,
                 ]);
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
             echo 'Message has been sent';
            //  dd($file_location);
            return;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

