<?php

namespace App\Http;

use App\Http\Middleware\AcessInItem;
use App\Http\Middleware\ModelAccess;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  /**
   * The application's global HTTP middleware stack.
   *
   * These middleware are run during every request to your application.
   *
   * @var array<int, class-string|string>
   */
  protected $middleware = [
    // \App\Http\Middleware\TrustHosts::class,
    \App\Http\Middleware\TrustProxies::class,
    \Illuminate\Http\Middleware\HandleCors::class,
    \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
    \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    \App\Http\Middleware\TrimStrings::class,
    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    // \App\Http\Middleware\SetLanguageMiddleware::class,
  ];

  /**
   * The application's route middleware groups.
   *
   * @var array<string, array<int, class-string|string>>
   */
  protected $middlewareGroups = [
    'web' => [
      \App\Http\Middleware\EncryptCookies::class,
      \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
      \Illuminate\Session\Middleware\StartSession::class,
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
      \App\Http\Middleware\VerifyCsrfToken::class,
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    'api' => [
      // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
      \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
  ];



    protected $routeMiddleware = [
        'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
    ];
    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */


  /**
   * The application's middleware aliases.
   *
   * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
   *
   * @var array<string, class-string|string>
   */
  protected $middlewareAliases = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
    'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
    'signed' => \App\Http\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'setlang' => \App\Http\Middleware\SetLanguageMiddleware::class,
    'apiAuthCheck' => \App\Http\Middleware\CheckAuthUserMiddleware::class,
    // 'authCheck' => \App\Http\Middleware\RedirectIfNotAuthenticated::class,
    'user_managment_middleware' => \App\Http\Middleware\UserManagmentMiddleware::class,
    'museum_edit_middleware' => \App\Http\Middleware\Museum\MuseumEditMiddleware::class,
    'museum' => \App\Http\Middleware\Museum\MuseumMiddleware::class,
    'museum_branch_middleware' => \App\Http\Middleware\MuseumBranch\MuseumBranchMiddleware::class,
    'product_viewer_list' => \App\Http\Middleware\ProductViewerListMiddleware::class,
    'check_auth_have_museum' => \App\Http\Middleware\CheckHaveMuseum::class,
    'model_access' => ModelAccess::class,
    'acess_in_item' => AcessInItem::class,


  ];
}
