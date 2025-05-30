<?php

namespace Ichinya\MoonshineLogin;

use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use Ichinya\MoonshineLogin\Pages\ForgotPage;
use Ichinya\MoonshineLogin\Pages\LoginPage;
use Ichinya\MoonshineLogin\Pages\ProfilePage;
use Ichinya\MoonshineLogin\Pages\RegisterPage;
use Ichinya\MoonshineLogin\Pages\ResetPasswordPage;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;

class MoonshineLoginServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->publishes([__DIR__.'/../config/socialite.php' => config_path('socialite.php')], ['config', 'laravel-login', 'moonshine', 'ichinya-moonshine-login', 'moonshine-login']);

        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
            ])
            ->pages([
                ...$config->getPages(),
                LoginPage::class,
                RegisterPage::class,
                ForgotPage::class,
                ResetPasswordPage::class,
                ProfilePage::class,
            ]);
    }
}
