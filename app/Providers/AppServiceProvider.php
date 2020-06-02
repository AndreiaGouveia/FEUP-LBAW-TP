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
            return "<?php if(Auth::check() && Auth::user()->isAdmin()): ?>";
        });

        \Blade::directive('endisAdmin', function() {
            return "<?php endif; ?>";
        });

        \Blade::directive('isModerator', function() {
            return "<?php if(Auth::check() && Auth::user()->isModerator()): ?>";
        });

        \Blade::directive('endisModerator', function() {
            return "<?php endif; ?>";
        });

        \Blade::directive('markdown', function ($expression) {
            return "<?php echo (new Parsedown)->text($expression); ?>";
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
