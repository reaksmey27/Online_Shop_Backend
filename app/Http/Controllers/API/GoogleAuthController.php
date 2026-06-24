<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GoogleAuthController extends Controller
{
    public function redirectUrl()
    {
        $params = http_build_query([
            'client_id'     => config('services.google.client_id'),
            'redirect_uri'  => config('services.google.redirect'),
            'response_type' => 'code',
            'scope'         => 'openid email profile',
            'access_type'   => 'online',
            'prompt'        => 'select_account',
        ]);

        return response()->json([
            'url' => 'https://accounts.google.com/o/oauth2/v2/auth?' . $params,
        ]);
    }

    public function callback(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $tokenResponse = Http::post('https://oauth2.googleapis.com/token', [
            'code'          => $request->code,
            'client_id'     => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
            'redirect_uri'  => config('services.google.redirect'),
            'grant_type'    => 'authorization_code',
        ]);

        if ($tokenResponse->failed()) {
            return response()->json(['message' => 'Failed to exchange Google authorization code.'], 422);
        }

        $profileResponse = Http::withToken($tokenResponse->json('access_token'))
            ->get('https://www.googleapis.com/oauth2/v3/userinfo');

        if ($profileResponse->failed()) {
            return response()->json(['message' => 'Failed to fetch Google profile.'], 422);
        }

        $profile = $profileResponse->json();

        if (empty($profile['sub']) || empty($profile['email'])) {
            return response()->json(['message' => 'Invalid Google profile response.'], 422);
        }

        // Find by google_id first, then by email
        $user = User::where('google_id', $profile['sub'])->first()
             ?? User::where('email', $profile['email'])->first();

        if ($user) {
            $user->update([
                'google_id'         => $profile['sub'],
                'avatar'            => $profile['picture'] ?? $user->avatar,
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
        } else {
            $user = User::create([
                'name'              => $profile['name']    ?? 'Google User',
                'email'             => $profile['email'],
                'google_id'         => $profile['sub'],
                'avatar'            => $profile['picture'] ?? null,
                'email_verified_at' => now(),
                'password'          => null,
            ]);
        }

        $token = $user->createToken('google_auth')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user'    => $user,
            'token'   => $token,
        ]);
    }
}