<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    protected function getApiNamespace($version = null)
    {
        $namespace = $this->namespace . '\Api';
        return $this->configureNamespaceForVersion($namespace, $version);
    }

    protected function getWebNamespace($version = null)
    {
        $namespace = $this->namespace . '\Web';
        return $this->configureNamespaceForVersion($namespace, $version);
    }

    private function configureNamespaceForVersion($namespace, $version = null)
    {
        if ($version) {
            $namespace = $namespace . "\V$version";
        }
        return $namespace;
    }

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        parent::boot();
    }

    public function map()
    {
        $this->mapApiVersionedRoutes(1);
        $this->mapWebVersionedRoutes(1);
    }

    protected function mapWebVersionedRoutes($version)
    {
        Route::middleware('web')
            ->namespace($this->getWebNamespace($version))
            ->group(base_path("routes/web/V$version/web.php"));
    }

    protected function mapApiVersionedRoutes($version)
    {
        Route::prefix("api/v$version")
            ->middleware(['api'])
            ->namespace($this->getApiNamespace($version))
            ->group(base_path("routes/api/V$version/api.php"));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
