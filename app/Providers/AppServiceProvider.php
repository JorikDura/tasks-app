<?php

namespace App\Providers;

use App\Models\Task;
use App\Policies\TaskPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
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
        Model::shouldBeStrict(
            app()->isLocal()
        );

        Gate::policy(class: Task::class, policy: TaskPolicy::class);
    }
}
