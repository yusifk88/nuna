<?php

namespace App\Http\Middleware;

use App\Models\UserPin;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class mustHavePinCode
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $code = $request->code;

        $foundCode = UserPin::where("code", $code)->where("used", false)->first();

        if (!$foundCode) {

            throw ValidationException::withMessages([
                'code' => ['Code not found or invalid code'],
            ]);

        }

        return $next($request);

    }
}
