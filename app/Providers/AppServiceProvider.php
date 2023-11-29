<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use App\Models\User;
use Config;
use URL;
use Lang;
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

        VerifyEmail::toMailUsing(function ($notifiable){
            
            $expire_in=Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60));

            $notifiable->link_expire_time=$expire_in;
            $notifiable->save();

            $verifyUrl = URL::temporarySignedRoute(
                'verification.verify',$expire_in,
                [
                    'id' =>base64_encode($notifiable->getKey()),
                    'hash' => base64_encode($notifiable->getEmailForVerification()),
                ]
            );

            $segmat=isset(explode('?', $verifyUrl)[1]) ? '?'.explode('?', $verifyUrl)[1] : '';

            $url=WebsiteURL().'/inwt/auth/email/verify/'.base64_encode($notifiable->getKey()).$segmat;

            return (new MailMessage)
                ->markdown('vendor.notifications.email')
                ->subject(Lang::get('Verify Email Address'))
                ->greeting("Hello ".ucfirst($notifiable->name)."!")
                ->line(Lang::get('Please click the button below to verify your email address.'))
                ->action(Lang::get('Verify Email Address'), $url)
                ->line(Lang::get('If you did not create an account, no further action is required.'));

        });

    }
}
