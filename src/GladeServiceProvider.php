<?php
namespace GladeApi\GladeBankTransfer;

use Illuminate\Support\ServiceProvider;

class GladeServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $config = realpath(__DIR__.'/../config/glade.php');

        $this->publishes([
            $config => config_path('glade.php')
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
         // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/glade.php', 'glade-bank-transfer');
    	/**
    	 *Register the main class to use with the facade
    	 */
        $this->app->singleton('glade-bank-transfer', function () {
            return new GladeBankTransfer;
        });
    }

     /**
    * Get the services provided by the provider
    * @return array
    */
    public function provides()
    {
        return ['glade-bank-transfer'];
    }

}
?>