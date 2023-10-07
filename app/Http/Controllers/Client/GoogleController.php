<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
class GoogleController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        $googleUser = Socialite::driver('google')->user();

        //truong hop 1 - chua ton tai
        //Create User email password google user_id
        // $user->email = $googleUser->getEmail();
        // $user->name = $googleUser->getName();
        // $user->google_user_id = $googleUser->getId();
        // $user->password = Hash::make('passsword' . '@' .$googleUser->id);

        $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'email' => $googleUser->getEmail(),
                    'name' => $googleUser->getName(),
                    'google_user_id' => $googleUser->getId(),
                    'password' => Hash::make('password' . '@' .$googleUser->getId()),
                ]
            );

            Auth::login($user);
            return redirect()->route('home.index');
    }
}
