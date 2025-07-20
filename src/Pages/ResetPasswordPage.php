<?php

declare(strict_types=1);

namespace Ichinya\MoonshineLogin\Pages;

use Ichinya\MoonshineLogin\Layouts\FormLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Fields\Hidden;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Fields\Text;
use Override;

class ResetPasswordPage extends Page
{
    protected ?string $layout = FormLayout::class;

    #[Override]
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle(),
        ];
    }

    #[Override]
    public function getTitle(): string
    {
        return $this->title ?: 'ForgotPage';
    }

    protected function components(): iterable
    {
        return [
            FormBuilder::make()
                ->class('authentication-form')
                ->action(route('password.update'))
                ->fields([
                    Hidden::make('token')->setValue(request()->route('token')),
                    Text::make('E-mail', 'email')
                        ->setValue(request()->input('email'))
                        ->required()
                        ->readonly(),
                    Password::make(__('Password'), 'password')
                        ->required(),
                    PasswordRepeat::make(__('Repeat password'), 'password_confirmation')
                        ->required(),
                ])->submit(__('Reset password'), [
                    'class' => 'btn-primary btn-lg w-full',
                ]),
        ];
    }
}
