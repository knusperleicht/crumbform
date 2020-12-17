<?php

namespace Knusperleicht\CrumbForm;


use Illuminate\Support\ServiceProvider;
use Knusperleicht\CrumbForm\Mail\Control\MailRepository;
use Knusperleicht\CrumbForm\Mail\Control\MailRepositoryInterface;
use Knusperleicht\CrumbForm\Mail\Control\MailService;
use Knusperleicht\CrumbForm\Mail\Control\MailServiceInterface;
use Mews\Captcha\CaptchaServiceProvider;

define('CF_NAMESPACE', 'Knusperleicht');
define('CF_API_PATH', __DIR__ . './../routes/api.php');
define('CF_MIGRATION_PATH', __DIR__ . '/../database/migrations');
define('CF_VIEW_PATH', __DIR__ . '/../views');
define('CF_CONFIG_PATH', __DIR__ . '/../config/crumbform.php');

class CrumbFormServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->register(CrumbFormEventServiceProvider::class);
        $this->app->register(CaptchaServiceProvider::class);

        $this->app->bind(MailRepositoryInterface::class, MailRepository::class);
        $this->app->bind(MailServiceInterface::class, MailService::class);
    }

    public function boot(): void
    {
        $this->publishConfig();
        $this->loadRoutesFrom(CF_API_PATH);
        $this->loadMigrationsFrom(CF_MIGRATION_PATH);
        $this->loadViewsFrom(CF_VIEW_PATH, CF_NAMESPACE);

        /*DB::listen(function ($query){
            $query->sql;
            $query->time;
        });*/

    }

    private function publishConfig(): void
    {
        $this->publishes(
            [
                CF_VIEW_PATH => base_path('resources/views/vendor/crumbform')
            ], 'views');

        $this->publishes(
            [
                CF_CONFIG_PATH => config_path('crumbform.php'),
            ], 'config');
    }
}
