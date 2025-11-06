<?php

namespace App\Exceptions;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TooManyRequestsHttpException) {
            if ($request->is('password/email')) {
                return redirect()->route('password.request')->withErrors([
                    'error' => 'Too many password reset requests. Please try again after 24 hours.',
                ]);
            }

            if ($request->is('login')) {
                return redirect()->route('login')->withErrors([
                    'error' => 'Too many login attempts. Try again in 20 minutes.',
                ]);
            }

            if ($request->is('two-factor')) {
                return redirect()->route('login')->withErrors([
                    'error' => 'Too many OTP attempts. Please wait 10 minutes and try again.'
                ]);
            }

            if ($request->is('two-factor-verify')) {
                return redirect()->route('login')->withErrors([
                    'error' => 'Too many OTP attempts. Please wait 10 minutes and try again.'
                ]);
            }

            if ($request->is('password/backend/reset')) {
                return redirect()->route('candidate.change-password')->withErrors([
                    'error' => 'Too many password change requests. Please try again after 24 hours.',
                ]);
            }
        }
        if ($exception instanceof BindingResolutionException) {
            return response()->view('errors.binding-resolution', ['exception' => $exception], 500);
        }

        return parent::render($request, $exception);
    }
}
