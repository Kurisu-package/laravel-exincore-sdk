<?php
/**
 * Created by PhpStorm.
 * User: kurisu
 * Date: 18-11-12
 * Time: 上午11:12
 */

namespace Kurisu\ExinCore;

use Illuminate\Support\ServiceProvider;

class ExinCoreServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/publicConf.php' => config_path('exincore.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('laravel-exincore-sdk', function ($app) {
            return new ExinCore(config('exincore', []));
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['laravel-exincore-sdk'];
    }
}
