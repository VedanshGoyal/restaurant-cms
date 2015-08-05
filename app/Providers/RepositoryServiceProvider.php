<?php

namespace Restaurant\Providers;

use Illuminate\Support\ServiceProvider;
use Restaurant\Models\MenuSection;
use Restaurant\Models\MenuItem;
use Restaurant\Models\About;
use Restaurant\Models\Info;
use Restaurant\Models\Hour;
use Restaurant\Models\SiteConfig;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMenuSectionRepo();
        $this->registerMenuItemRepo();
        $this->registerHourRepo();
        $this->registerAboutRepo();
        $this->registerInfoRepo();
        $this->registerPhotoRepo();
        $this->registerSiteConfigRepo();
        
    }

    private function registerMenuSectionRepo()
    {
        $this->app->bind('Restaurant\Repositories\MenuSectionRepo', function ($app) {
            return new \Restaurant\Repositories\MenuSectionRepo(new MenuSection());
        });
    }

    private function registerMenuItemRepo()
    {
        $this->app->bind('Restaurant\Repositories\MenuItemRepo', function ($app) {
            return new \Restaurant\Repositories\MenuItemRepo(new MenuItem());
        });
    }

    private function registerHourRepo()
    {
        $this->app->bind('Restaurant\Repositories\HourRepo', function ($app) {
            return new \Restaurant\Repositories\HourRepo(new Hour());
        });
    }

    private function registerAboutRepo()
    {
        $this->app->bind('Restaurant\Repositories\AboutRepo', function ($app) {
            return new \Restaurant\Repositories\AboutRepo(new About());
        });
    }

    private function registerInfoRepo()
    {
        $this->app->bind('Restaurant\Repositories\InfoRepo', function ($app) {
            return new \Restaurant\Repositories\InfoRepo(new Info());
        });
    }

    private function registerPhotoRepo()
    {
        $this->app->bind('Restaurant\Repositories\PhotoRepo', function ($app) {
            return new \Restaurant\Repositories\PhotoRepo(new Photo());
        });
    }

    private function registerSiteConfigRepo()
    {
        $this->app->bind('Restaurant\Repositories\SiteConfigRepo', function ($app) {
            return new \Restaurant\Repositories\SiteConfigRepo(new SiteConfig());
        });
    }
}
