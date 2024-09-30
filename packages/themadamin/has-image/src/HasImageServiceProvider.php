<?php


namespace Themadamin\HasImage;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class HasImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->app->make("Themadamin\HasImage\HasImage");
    }
}
