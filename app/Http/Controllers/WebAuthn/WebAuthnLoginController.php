<?php

namespace App\Http\Controllers\WebAuthn;

use App\Models\User;
use function response;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SettingsController;
use Illuminate\Contracts\Support\Responsable;
use Laragear\WebAuthn\Http\Requests\AssertedRequest;
use Laragear\WebAuthn\Http\Requests\AssertionRequest;

class WebAuthnLoginController
{
    /**
     * Returns the challenge to assertion.
     *
     * @param  \Laragear\WebAuthn\Http\Requests\AssertionRequest  $request
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function options(AssertionRequest $request): Responsable
    {
        return $request->toVerify($request->validate(['email' => 'sometimes|email|string']));
    }

    /**
     * Log the user in.
     *
     * @param  \Laragear\WebAuthn\Http\Requests\AssertedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(AssertedRequest $request): Response
    {
        if($request->login()){
            $settings = new SettingsController();
            User::find(Auth::id())->webAuthnCredentials()->update([
                'set_as_default' => false,
            ]);
    
            User::find(Auth::id())->webAuthnCredentials()->where('id',  $request->id)->update([
                'set_as_default' => true,
            ]);

            return response()->noContent(204);
        }      
        return response()->noContent(442);
    }
}
