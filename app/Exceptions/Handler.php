<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $e, $request) {
            if (!app()->environment(['local', 'testing'])) {
                if ($e instanceof HttpException) {
                    request()->session()->flash("flash.bannerStyle", "danger");
                    request()->session()->flash("flash.banner", "Sorry, something went wrong. Status Code: " . $e->getStatusCode());
                    return back()->with([
                        'message' => 'The page expired, please try again.',
                    ]);
                } else {
                    // dd($e);
                    request()->session()->flash("flash.bannerStyle", "danger");
                    request()->session()->flash("flash.banner", "Sorry, app crashed. Please contact web admin for help");
                    return back();
                }
            }
        });
    }
}
