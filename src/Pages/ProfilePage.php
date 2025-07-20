<?php

declare(strict_types=1);

namespace Ichinya\MoonshineLogin\Pages;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Hidden;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Fields\Text;
use Override;

class ProfilePage extends Page
{
    protected ?string $layout = AppLayout::class;

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
        return $this->title ?: 'LoginPage';
    }

    protected function components(): iterable
    {
        return [
            Box::make([
                FormBuilder::make()
                    ->class('authentication-form')
                    ->action(route('profile.update'))
                    ->fill(auth()->user())
                    ->fields([
                        Tabs::make([
                            Tab::make(__('Profile'), [
                                Text::make(__('Name'), 'name')->required(),
                                Text::make('E-mail', 'email')
                                    ->required()
                                    ->customAttributes([
                                        'autofocus' => true,
                                        'autocomplete' => 'off',
                                    ]),
                            ]),
                            Tab::make(__('Password'), [
                                Password::make(__('Password'), 'password'),
                                PasswordRepeat::make(__('Repeat password'), 'password_confirmation'),
                            ])->active(
                                session('errors')?->has('password') ?? false
                            ),
                        ]),
                    ])->submit(__('Update profile'), [
                        'class' => 'btn-primary btn-lg w-full',
                    ]),
            ]),
            FormBuilder::make()
                ->name('logout')
                ->class('authentication-form')
                ->action(route('logout'))
                ->fields([
                    Hidden::make('_method')->setValue('DELETE'),
                ])->submit(__('Log out'), [
                    'class' => 'btn-primary btn-lg w-full',
                ]),
        ];
    }
}
