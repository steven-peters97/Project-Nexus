<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::middleware('guest')->group(function () {
    Route::get('login', function() {
        return Socialite::driver('discord')
            ->scopes(['identify', 'guilds.members.read', 'guilds'])
            ->redirect();
    })->name('login');

    Route::get('login/callback', function() {
        $discordOauthUser = Socialite::driver('discord')->user();
        $accessToken = $discordOauthUser->token;
        $refreshToken = $discordOauthUser->refreshToken;
        $expiresIn = $discordOauthUser->expiresIn;

        $guild_id = env('DISCORD_GUILD_ID');

        $response = Http::withToken($accessToken)
            ->get("https://discord.com/api/users/@me/guilds/{$guild_id}/member");

        $discordUser = $response->json();

        $user = User::updateOrCreate(
            ['id' => $discordUser['user']['id']],
            [
                'id' => $discordUser['user']['id'],
                'guild_id' => $guild_id,
                'username' => $discordUser['user']['username'] ?? 'Unknown',
                'nickname' => $discordUser['nick'] ?? null,
                'email' => $discordOauthUser->email,
                'combat_div_id' => null,
                'ind_div_id' => null,
                'is_banned' => 0,
                'avatar' => 'https://cdn.discordapp.com/avatars/'. $discordUser['user']['id'] .'/'. $discordUser['user']['avatar'] .'.png',
                'discord_token' => $accessToken,
                'discord_refresh_token' => $refreshToken,
                'discord_expires_in' => $expiresIn,
            ],
        );

        Auth::login($user);
        return redirect('/dashboard');
    });
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');

