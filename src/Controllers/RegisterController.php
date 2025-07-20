<?php

namespace Ichinya\MoonshineLogin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Ichinya\MoonshineLogin\Pages\RegisterPage;
use Ichinya\MoonshineLogin\Requests\RegisterFormRequest;
use Illuminate\Http\RedirectResponse;

final class RegisterController extends Controller
{
    public function form(RegisterPage $page): RegisterPage
    {
        return $page;
    }

    public function store(RegisterFormRequest $request): RedirectResponse
    {
        $user = User::query()->create(
            $request->validated()
        );
        auth()->login($user);

        return redirect()->intended(
            route('home')
        );
    }
}
