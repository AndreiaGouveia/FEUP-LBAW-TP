<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('isAdmin', function () {
            return "<?php if(Auth::user()->isAdmin()): ?>";
        });

        \Blade::directive('endisAdmin', function() {
            return "<?php endif; ?>";
        });

        \Blade::directive('isModerator', function() {
            return "<?php if(Auth::user()->isModerator()): ?>";
        });

        \Blade::directive('endisModerator', function() {
            return "<?php endif; ?>";
        });
    
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
