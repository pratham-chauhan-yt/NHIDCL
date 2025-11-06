<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Blade;
use Symfony\Component\Mailer\Transport\Transports;
use Symfony\Component\Mailer\Transport\TransportFactory;
use App\Mail\Transport\CustomSmtpTransportFactory;

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
  public function boot()
  { 
    app()->extend(TransportFactory::class, function ($factory, $app) {
      $factory->register(new CustomSmtpTransportFactory());
      return $factory;
    });
    Paginator::useBootstrapFive();
    Blade::if('canModule', function ($moduleName) {
      if (!auth()->check()) return false;
      $user = auth()->user();

      // If user has Super Admin role, give full access
      if ($user->hasRole('Super Admin')) {
        return true;
      }
      return $user->getAllPermissions()->where('module', $moduleName)->isNotEmpty();
    });
  }
}
