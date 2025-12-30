<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Inject Latest Articles into Navbar for Notifications
        \Illuminate\Support\Facades\View::composer('review.components.navbar-app', function ($view) {
            try {
                // Reuse logic from ArtikelController to fetch cached articles
                $controller = app(\App\Http\Controllers\ArtikelController::class);
                $articles = $controller->getArticles();
                
                // Take top 5 latest
                $latestArticles = array_slice($articles, 0, 5);
                
                $view->with('notificationArticles', $latestArticles);
            } catch (\Exception $e) {
                $view->with('notificationArticles', []);
            }
        });
    }
}
