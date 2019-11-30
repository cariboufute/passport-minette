<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::enableImplicitGrant();

        Gate::define('is-self', function ($user) {
            return $user->name === User::MINETTE;
        });

        Gate::define('have-sex', function ($user) {
            return $user->is_sexy;
        });

        Gate::define('have-love', function ($user) {
            return $user->is_husband;
        });
    }
}
