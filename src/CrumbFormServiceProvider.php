<?php

namespace Knusperleicht\CrumbForm;


use Illuminate\Support\ServiceProvider;
use Knusperleicht\CrumbForm\Mail\Control\MailRepository;
use Knusperleicht\CrumbForm\Mail\Control\MailRepositoryInterface;
use Knusperleicht\CrumbForm\Mail\Control\MailService;
use Knusperleicht\CrumbForm\Mail\Control\MailServiceInterface;
use Mews\Captcha\CaptchaServiceProvider;

class CrumbFormServiceProvider extends ServiceProvider
{


    public function register(): void
    {
        $this->app->register(CrumbFormEventServiceProvider::class);
        $this->app->register(CaptchaServiceProvider::class);
        //$loader = CaptchaServiceProvider::getInstance();
        //$loader->alias('Captcha', 'LucaDegasperi\OAuth2Server\Facades\AuthorizationServerFacade');
        //$this->mergeConfig();
    }

    public function boot(): void
    {
        $this->publishConfig();
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerViews();

        $this->app->bind(MailRepositoryInterface::class, MailRepository::class);
        $this->app->bind(MailServiceInterface::class, MailService::class);
        /*DB::listen(function ($query){
            $query->sql;
            $query->time;
        });*/

    }

    /*private function mergeConfig(): void
    {
        $path = $this->configPath();
        $this->mergeConfigFrom($path, 'config');
    }*/

    private function publishConfig(): void
    {
        $this->publishes(
            [
                $this->viewsPath() => base_path('resources/views/vendor/crumbform')
            ], 'views');

        $this->publishes(
            [
                __DIR__ . '/../config/crumbform.php' => config_path('crumbform.php'),
            ], 'config');
    }

    private function registerRoutes(): void
    {
        $path = $this->routesPath();
        $this->loadRoutesFrom($path);
    }

    private function registerMigrations(): void
    {
        $path = $this->migrationPath();
        $this->loadMigrationsFrom($path);
    }

    private function registerViews(): void
    {
        $path = $this->viewsPath();
        $this->loadViewsFrom($path, 'knusperleicht');
    }

    private function routesPath(): string
    {
        return __DIR__ . '/../routes/api.php';
    }

    private function migrationPath(): string
    {
        return __DIR__ . '/../database/migrations';
    }

    private function viewsPath(): string
    {
        return __DIR__ . '/../views';
    }
}
