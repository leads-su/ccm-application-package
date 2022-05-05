<?php

namespace ConsulConfigManager\Application\Providers;

use Illuminate\Support\Facades\Route;
use ConsulConfigManager\Application\Http;
use ConsulConfigManager\Application\UseCases;
use ConsulConfigManager\Application\Presenters;
use ConsulConfigManager\Domain\DomainServiceProvider;
use ConsulConfigManager\Application\ApplicationDomain;

/**
 * Class ApplicationServiceProvider
 * @package ConsulConfigManager\Application\Providers
 */
class ApplicationServiceProvider extends DomainServiceProvider
{
    /**
     * Boot any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerRoutes();
        $this->offerPublishing();
        parent::boot();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerConfiguration();
        parent::register();
    }

    /**
     * Register package routes
     * @return void
     */
    protected function registerRoutes(): void
    {
        if (ApplicationDomain::shouldRegisterRoutes()) {
            Route::group([
                'middleware'    =>  config('domain.application.middleware'),
            ], function (): void {
                $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');
            });
        }
    }

    /**
     * Register package configuration
     * @return void
     */
    protected function registerConfiguration(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/application.php', 'domain.application');
    }

    /**
     * Offer resources for publishing
     * @return void
     */
    protected function offerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/application.php'         =>  config_path('domain/application.php'),
            ], 'ccm-application-config');
        }
    }

    /**
     * @inheritDoc
     */
    protected function registerInterceptors(): void
    {
        $this->registerReleaseInterceptors();
    }

    /**
     * Register release specific interceptors
     * @return void
     */
    private function registerReleaseInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\Release\List\ReleaseListInputPort::class,
            UseCases\Release\List\ReleaseListInteractor::class,
            Http\Controllers\Release\ReleaseListController::class,
            Presenters\Release\ReleaseListHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Release\Latest\ReleaseLatestInputPort::class,
            UseCases\Release\Latest\ReleaseLatestInteractor::class,
            Http\Controllers\Release\ReleaseLatestController::class,
            Presenters\Release\ReleaseLatestHttpPresenter::class,
        );
    }
}
