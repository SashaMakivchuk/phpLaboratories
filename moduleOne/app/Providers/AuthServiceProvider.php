<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\ProjectPolicy;
use App\Models\Project;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define Gates
        Gate::define('view-project', function (User $user, Project $project) {
            return $user->id === $project->creator_user_id || $user->role === 'editor' || $user->role === 'Superadmin';
        });

        Gate::define('create-project', function (User $user) {
            return $user->role === 'Superadmin';
        });

        Gate::define('edit-project', function (User $user, Project $project) {
            return $user->id === $project->creator_user_id || $user->role === 'editor' || $user->role === 'Superadmin';
        });

        Gate::define('delete-project', function (User $user, Project $project) {
            return $user->role === 'Superadmin';
        });
    }
}

