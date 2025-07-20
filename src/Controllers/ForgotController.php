<?php

namespace Ichinya\MoonshineLogin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Ichinya\MoonshineLogin\Pages\ForgotPage;
use Ichinya\MoonshineLogin\Requests\ForgotPasswordFormRequest;
use Ichinya\MoonshineLogin\Requests\ResetPasswordFormRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use MoonShine\Laravel\MoonShineUI;

class ForgotController extends Controller
{
    public function form(ForgotPage $page): ForgotPage
    {
        return $page;
    }

    public function updatePassword(ResetPasswordFormRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            static function (User $user, string $password): void {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('alert', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function reset(ForgotPasswordFormRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT) {
            MoonShineUI::toast(__('If the account exists, then the instructions are sent to your email'));
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['alert' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
