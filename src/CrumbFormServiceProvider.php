<?php

namespace Knusperleicht\CrumbForm;


use Illuminate\Support\ServiceProvider;
use Knusperleicht\CrumbForm\Mail\Control\MailRepository;
use Knusperleicht\CrumbForm\Mail\Control\MailRepositoryInterface;
use Knusperleicht\CrumbForm\Mail\Control\MailService;
use Knusperleicht\CrumbForm\Mail\Control\MailServiceInterface;

const NAME_SPACE = 'Knusperleicht';
const API_PATH = __DIR__ . './../routes/api.php';
const MIGRATION_CREATE_MAIL_TABLE_PATH = __DIR__ . '/../database/migrations/create_mails_table.php.stub';
const VIEW_PATH = __DIR__ . '/../views';
const CONFIG_PATH = __DIR__ . '/../config/config.php';

class CrumbFormServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->register(CrumbFormEventServiceProvider::class);

        $this->app->bind(MailRepositoryInterface::class, MailRepository::class);
        $this->app->bind(MailServiceInterface::class, MailService::class);
    }

    public function boot(): void
    {
        $this->publishConfig();
        $this->loadRoutesFrom(API_PATH);
        $this->loadViewsFrom(VIEW_PATH, NAME_SPACE);

        /*DB::listen(function ($query){
            $query->sql;
            $query->time;
        });*/

    }

    private function publishConfig(): void
    {
        // Export views
        $this->publishes(
            [
                VIEW_PATH => base_path('resources/views/vendor/crumbform')
            ], 'views');

        // Export config
        $this->publishes(
            [
                CONFIG_PATH => config_path('crumbform.php'),
            ], 'config');

        // Export the migration
        if ($this->app->runningInConsole() && !class_exists('CreatePostsTable')) {
            $this->publishes([
                MIGRATION_CREATE_MAIL_TABLE_PATH => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_mails_table.php'),
            ], 'migrations');
        }
    }
}
