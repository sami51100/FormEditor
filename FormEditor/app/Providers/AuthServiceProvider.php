<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('form-access', function ($user, $form) {
            if ($user->role_id === 1 || $user->role_id === 2) {
                return 1;
            }
            return $user->id === $form->user_id;
        });

        Gate::define('user-access', function ($user, $userRoleID) {
            if ($user->role_id === 1) {
                if ($userRoleID >= 2 && $userRoleID <= 5) {
                    return 1;
                }
                return 0;
            } else if ($user->role_id === 2) {
                if ($userRoleID >= 3 && $userRoleID <= 5) {
                    return 1;
                }
                return 0;
            }
            return 0;
        });
    }
}
