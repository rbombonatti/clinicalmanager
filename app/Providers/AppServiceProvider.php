<?php

namespace App\Providers;

use App\Models\HealthInsurancePlan;
use App\Models\Procedure;
use App\Observers\HealthInsurancePlanObserver;
use App\Observers\ProcedureObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
        Vite::prefetch(concurrency: 3);
        Model::preventLazyLoading();

        Procedure::observe(ProcedureObserver::class);
        HealthInsurancePlan::observe(HealthInsurancePlanObserver::class);

        Inertia::share('translations', function () {
            $locale = App::getLocale();
            return File::exists(resource_path("lang/{$locale}.json"))
                ? json_decode(File::get(resource_path("lang/{$locale}.json")), true)
                : [];
        });
    }
}
