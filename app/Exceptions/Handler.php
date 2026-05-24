<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use App\Http\Controllers\Error\ErrorsHandlingController;

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
        if ($exception instanceof NotFoundHttpException) {
            $locale = $request->segment(1); // получаем язык из первого сегмента URL, например 'en' или 'ru'
            // Можно проверить, что $locale действительно поддерживается
            $supportedLocales = ['en', 'ru']; // список поддерживаемых языков
            if (!in_array($locale, $supportedLocales)) {
                $locale = config('app.locale'); // язык по умолчанию
            }
            // Теперь вызываем контроллер, передавая язык
            return app()->call('App\Http\Controllers\Error\ErrorsHandlingController@notFound', ['locale' => $locale]);
        }
        return parent::render($request, $exception);
    }

}
