<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function discordRedirect(){
        return Socialite::driver('discord')->redirect();
    }

    public function discordCallback(){
        $discordUser = Socialite::driver('discord')->user();
        $user = User::where('discord_id', $discordUser->id)->first();
        
        if ($user) {
            $user->update([
                'discord_token' => $discordUser->token,
                'discord_refresh_token' => $discordUser->refreshToken,
            ]);
        } else {
            $user = new User;
            
            $user->name = $discordUser->name;
            $user->email = $discordUser->email;
            $user->discord_id = $discordUser->id;
            $user->discord_token = $discordUser->token;
            $user->discord_refresh_token = $discordUser->refreshToken;
            $user->save();
        }

        Auth::login($user);

        return redirect('/');
    }

    
}
