<?php

declare(strict_types=1);

namespace Ichinya\MoonshineLogin\Pages;

use Ichinya\MoonshineLogin\Layouts\FormLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Divider;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Link;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use Override;

class LoginPage extends Page
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
        return $this->title ?: 'LoginPage';
    }

    protected function components(): iterable
    {
        return [
            FormBuilder::make()
                ->class('authentication-form')
                ->action(route('authenticate'))
                ->fields([
                    Text::make('E-mail', 'email')
                        ->required()
                        ->customAttributes([
                            'autofocus' => true,
                            'autocomplete' => 'username',
                        ]),
                    Password::make(__('Password'), 'password')
                        ->required(),
                    Switcher::make(__('Remember me'), 'remember'),
                ])->submit(__('Log in'), [
                    'class' => 'btn-primary btn-lg w-full',
                ]),
            Divider::make(),
            Flex::make([
                ActionButton::make(__('Create account'), route('register'))->primary(),
                Link::make(route('forgot'), __('Forgot password')),
            ])->justifyAlign('start'),
        ];
    }
}
