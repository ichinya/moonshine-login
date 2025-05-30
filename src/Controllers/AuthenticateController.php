<?php

namespace Ichinya\MoonshineLogin\Controllers;

use App\Http\Controllers\Controller;
use Ichinya\MoonshineLogin\Pages\LoginPage;
use Ichinya\MoonshineLogin\Requests\AuthenticateFormRequest;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class AuthenticateController extends Controller
{
    public function form(LoginPage $page): LoginPage
    {
        return $page;
    }

    public function authenticate(AuthenticateFormRequest $request): RedirectResponse
    {
        if (! auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => __('moonshine::auth.failed'),
            ]);
        }

        return redirect()->intended(
            route('profile')
        );
    }

    public function logout(
        #[Auth]
        Guard $guard,
        Request $request
    ): RedirectResponse {
        $guard->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended(
            url()->previous() ?? route('home')
        );
    }
}
