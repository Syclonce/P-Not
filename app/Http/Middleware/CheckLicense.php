<?php

namespace App\Http\Middleware;

use App\Models\License;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;


class CheckLicense
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $licenseKey = Config::get('app.license');
        var_dump($licenseKey);
        if (!$licenseKey) {
            return response()->json(['message' => 'License key is not configured'], 500);
        }

        $license = License::where('key', $licenseKey)->first();

        if (!$license || !$license->is_active) {
            return response()->json(['message' => 'Invalid license key'], 403);
        }

        // Check if license has expired
        $expiryDate = Carbon::parse($license->expiry_date);
        if ($expiryDate->isPast()) {
            return response()->json(['message' => 'License key has expired'], 403);
        }

        // If everything checks out, proceed with the request
        return $next($request);
    }
}
