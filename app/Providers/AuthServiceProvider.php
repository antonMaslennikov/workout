<?php

namespace App\Providers;

use App\Models\Activitie;
use App\Models\User;
use App\Policies\ActivitiePolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Activitie::class => ActivitiePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // гейт для редактирования упр-я
        Gate::define('update-activitie', function (User $user, Activitie $activitie) {
            // разрешаем менеджеру
            return $user->roles->containsStrict('id', 2);
        });

        // гейт для удаления упр-я
//        Gate::define('delete-activitie', function (User $user, Activitie $activitie = null) {
//            return $user->roles->containsStrict('id', 2);
//        });

        // для админа так разрешаются все возможности
        Gate::before(function (User $user) {
            return $user->roles->containsStrict('id', 1);
        });


        // замена штатного письма с подтверждением пароля
//        VerifyEmail::toMailUsing(function ($notifiable, $url) {
//            return (new MailMessage)
//                ->subject('Подтвердите ваш Email')
//                ->view('mail.auth.verifyEmail', ['url' => $url]);
//        });
    }
}
