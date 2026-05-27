<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $locale = app()->getLocale(); // Получаем текущую локаль приложения
        return $request->expectsJson() ? null : route('no-permission-page', ['locale' => $locale]);
    }
}
