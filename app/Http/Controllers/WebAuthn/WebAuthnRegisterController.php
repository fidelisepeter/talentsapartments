<?php

namespace App\Http\Controllers\WebAuthn;

use App\Models\User;
use function response;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SettingsController;
use Illuminate\Contracts\Support\Responsable;
use Laragear\WebAuthn\Http\Requests\AttestedRequest;
use Laragear\WebAuthn\Http\Requests\AttestationRequest;

class WebAuthnRegisterController
{
    /**
     * Returns a challenge to be verified by the user device.
     *
     * @param  \Laragear\WebAuthn\Http\Requests\AttestationRequest  $request
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function options(AttestationRequest $request): Responsable
    {
        return $request
            ->fastRegistration()
//            ->userless()
//            ->allowDuplicates()
            ->toCreate();
    }

    /**
     * Registers a device for further WebAuthn authentication.
     *
     * @param  \Laragear\WebAuthn\Http\Requests\AttestedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(AttestedRequest $request): Response
    {
        $request->save();

        $settings = new SettingsController();
        $browser = $settings->getBrowser();
        User::find(Auth::id())->webAuthnCredentials()->update([
            'set_as_default' => false,
        ]);

        User::find(Auth::id())->webAuthnCredentials()->where('id',  $request->id)->update([
            'set_as_default' => true,
            'device_data' => json_encode($browser),
            'device_ip' => $request->ip(),
            'device_name' => $browser['name'] . " (" . $browser['platform']. ")",
        ]);

        return response()->noContent();
    }
}
