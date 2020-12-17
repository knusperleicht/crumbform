<?php

namespace Knusperleicht\CrumbForm;


use Illuminate\Support\ServiceProvider;
use Knusperleicht\CrumbForm\Mail\Control\MailRepository;
use Knusperleicht\CrumbForm\Mail\Control\MailRepositoryInterface;
use Knusperleicht\CrumbForm\Mail\Control\MailService;
use Knusperleicht\CrumbForm\Mail\Control\MailServiceInterface;
use Mews\Captcha\CaptchaServiceProvider;

const NAME_SPACE = 'Knusperleicht';
const API_PATH = __DIR__ . './../routes/api.php';
const MIGRATION_PATH = __DIR__ . '/../database/migrations';
const VIEW_PATH = __DIR__ . '/../views';
const CONFIG_PATH = __DIR__ . '/../config/crumbform.php';

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
        $this->loadRoutesFrom(API_PATH);
        $this->loadMigrationsFrom(MIGRATION_PATH);
        $this->loadViewsFrom(VIEW_PATH, NAME_SPACE);

        /*DB::listen(function ($query){
            $query->sql;
            $query->time;
        });*/

    }

    private function publishConfig(): void
    {
        $this->publishes(
            [
                VIEW_PATH => base_path('resources/views/vendor/crumbform')
            ], 'views');

        $this->publishes(
            [
                CONFIG_PATH => config_path('crumbform.php'),
            ], 'config');
    }
}
