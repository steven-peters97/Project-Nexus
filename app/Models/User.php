<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $hidden = [
        'email',
        'discord_token',
        'discord_refresh_token',
    ];

    protected $fillable = [
        'id',
        'guild_id',
        'username',
        'nickname',
        'email',
        'combat_div_id',
        'ind_div_id',
        'is_banned',
        'avatar',
        'discord_token',
        'discord_refresh_token',
        'discord_expires_in',
    ];

    public function initials()
    {
        // Use nickname if available, otherwise fallback to username
        $name = $this->nickname ?? $this->username;

        // Split the name into words
        $words = preg_split('/[\s,]+/', $name);

        // If only one word, take first two letters
        if (count($words) === 1) {
            return strtoupper(substr($name, 0, 2));
        }

        // Otherwise take first letter of first two words
        return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
    }

}
