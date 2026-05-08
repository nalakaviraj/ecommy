<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EnsureInstalled
{
    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldBypass($request)) {
            return $next($request);
        }

        if ($this->isInstalled()) {
            return $next($request);
        }

        return redirect('/install/');
    }

    private function shouldBypass(Request $request): bool
    {
        return $request->is('install') ||
            $request->is('install/*');
    }

    private function isInstalled(): bool
    {
        try {
            DB::connection()->getPdo();

            return Schema::hasTable('business_settings') &&
                Schema::hasTable('languages');
        } catch (\Throwable $e) {
            return false;
        }
    }
}

