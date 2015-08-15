<?php

namespace Restaurant\Providers;

use Illuminate\Support\ServiceProvider;
use Restaurant\Models\MenuSection;
use Restaurant\Models\SiteConfig;
use Restaurant\Models\MenuItem;
use Bican\Roles\Models\Role;
use Restaurant\Models\About;
use Restaurant\Models\Info;
use Restaurant\Models\Hour;
use Restaurant\Models\User;

class RepositoryServiceProvider extends ServiceProvider
{
   /**
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMenuSectionRepo();
        $this->registerSiteConfigRepo();
        $this->registerMenuItemRepo();
        $this->registerPhotoRepo();
        $this->registerUsersRepo();
        $this->registerRolesRepo();
        $this->registerAboutRepo();
        $this->registerHourRepo();
        $this->registerInfoRepo();
    }

    private function registerMenuSectionRepo()
    {
        $this->app->singleton('Restaurant\Repositories\MenuSectionRepo', function ($app) {
            return new \Restaurant\Repositories\MenuSectionRepo(new MenuSection());
        });
    }

    private function registerMenuItemRepo()
    {
        $this->app->singleton('Restaurant\Repositories\MenuItemRepo', function ($app) {
            return new \Restaurant\Repositories\MenuItemRepo(new MenuItem());
        });
    }

    private function registerHourRepo()
    {
        $this->app->singleton('Restaurant\Repositories\HourRepo', function ($app) {
            return new \Restaurant\Repositories\HourRepo(new Hour());
        });
    }

    private function registerAboutRepo()
    {
        $this->app->singleton('Restaurant\Repositories\AboutRepo', function ($app) {
            return new \Restaurant\Repositories\AboutRepo(new About());
        });
    }

    private function registerInfoRepo()
    {
        $this->app->singleton('Restaurant\Repositories\InfoRepo', function ($app) {
            return new \Restaurant\Repositories\InfoRepo(new Info());
        });
    }

    private function registerPhotoRepo()
    {
        $this->app->singleton('Restaurant\Repositories\PhotoRepo', function ($app) {
            return new \Restaurant\Repositories\PhotoRepo(new Photo());
        });
    }

    private function registerSiteConfigRepo()
    {
        $this->app->singleton('Restaurant\Repositories\SiteConfigRepo', function ($app) {
            return new \Restaurant\Repositories\SiteConfigRepo(new SiteConfig());
        });
    }

    public function registerUsersRepo()
    {
        $this->app->singleton('Restaurant\Repositories\UsersRepo', function ($app) {
            return new \Restaurant\Repositories\UsersRepo(new User());
        });
    }

    public function registerRolesRepo()
    {
        $this->app->singleton('Restaurant\Repositories\RolesRepo', function ($app) {
            return new \Restaurant\Repositories\RolesRepo(new Role());
        });
    }
}
