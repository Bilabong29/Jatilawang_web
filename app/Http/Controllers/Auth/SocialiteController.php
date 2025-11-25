<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialiteController extends Controller
{
    private const SUPPORTED_PROVIDERS = ['google'];

    public function redirect(string $provider): RedirectResponse
    {
        abort_unless($this->isSupported($provider), 404);

        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        abort_unless($this->isSupported($provider), 404);

        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('login')->withErrors([
                'email' => 'Gagal login menggunakan '.ucfirst($provider).'. Silakan coba lagi.',
            ]);
        }

        $user = User::query()
            ->where('google_id', $socialUser->getId())
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if (! $user) {
            $user = $this->registerFromGoogle(
                $socialUser->getId(),
                $socialUser->getEmail(),
                $socialUser->getName() ?? $socialUser->getNickname(),
                $socialUser->getAvatar(),
                $socialUser->token ?? null
            );
        } else {
            $user->forceFill([
                'google_id' => $user->google_id ?: $socialUser->getId(),
                'google_avatar' => $socialUser->getAvatar(),
                'google_token' => $socialUser->token ?? null,
            ])->save();
        }

        Auth::login($user, remember: true);

        return redirect()->intended(route('home'));
    }

    private function registerFromGoogle(?string $googleId, ?string $email, ?string $name, ?string $avatar, ?string $token): User
    {
        return User::create([
            'google_id' => $googleId,
            'google_avatar' => $avatar,
            'google_token' => $token,
            'email' => $email,
            'full_name' => $name,
            'username' => $this->generateUsername($email ?? $name ?? 'user'),
            'password' => Hash::make(Str::random(40)),
            'role' => 'customer',
        ]);
    }

    private function generateUsername(string $seed): string
    {
        $base = Str::of($seed)
            ->lower()
            ->replace(['@', '.'], '_')
            ->slug('_')
            ->trim('_')
            ->limit(30, '')
            ->value() ?: 'user';

        $candidate = $base;

        while (User::where('username', $candidate)->exists()) {
            $candidate = $base.'_'.Str::lower(Str::random(4));
        }

        return $candidate;
    }

    private function isSupported(string $provider): bool
    {
        return in_array($provider, self::SUPPORTED_PROVIDERS, true);
    }
}
