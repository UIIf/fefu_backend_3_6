<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class OAuthController extends Controller
{

    private const ALLOWED_PROVIDERS = ['github', 'google'];

    private function getValidateProvider(string $provider): string
    {
        if(!in_array($provider, self::ALLOWED_PROVIDERS, true))
            abort(404);

        return $provider;
    }

    private function processOAtuhException(Throwable $exception, string $provider)
    {
        Log::error($exception->getMessage());

        return view('auth.oauth_login_failed', ['provider' => $provider, 'error' => $exception->getMessage()]);
    }

    public function redirectToService(Request $request, string $provider)
    {
        $provider = $this->getValidateProvider($provider);

        try {
            $result = Socialite::driver($provider)
                ->scopes(config('services.'. $provider . 'scopes'))
                ->redirect();
        } catch (Throwable $exception) {
            var_dump($exception->getMessage());
            $result = $this->processOAtuhException($exception, $provider);
        }
        return $result;
    }

    public function login(Request $request, string $provider)
    {
        $provider = $this->getValidateProvider($provider);

        try {
            /** @var AbstractUser $socialUser */
            $oauthUser = Socialite::with($provider)->user();
        } catch (Throwable $exception) {
            return $this->processOAtuhException($exception, $provider);
        }

        $dbUserByDaythId = User::where("{$provider}_id", $oauthUser->id)->first();
        $dbUserByDaythEmail = User::query()
            ->whereNull("{$provider}_id")
            ->whereNotNull('email')
            ->where('email', $oauthUser->email)->first();

        $oauthUserData = [
            "{$provider}_id" => $oauthUser->getId(),
            "{$provider}_logged_in_at" => Carbon::now(),
        ];

        if ($dbUserByDaythId !==null) {
            $dbUserByDaythId->update($oauthUserData);
            $appAuthUser = $dbUserByDaythId;
        } else {
            $oauthUserData = [
                "{$provider}_id" => $oauthUser->getId(),
                "{$provider}_logged_in_at" => Carbon::now(),
                "{$provider}_registered_at" => Carbon::now(),
            ];

            if($dbUserByDaythEmail !== null){
                $dbUserByDaythEmail->update($oauthUserData);
                $appAuthUser = $dbUserByDaythEmail;
            }else{
                $appAuthUser = User::create(array_merge([
                        'name' => $oauthUser->getName() ?? $oauthUser->getNickname(),
                        'email' => $oauthUser->getEmail(),
                    ], $oauthUserData));
            }
        }

        Auth::login($appAuthUser);
        $request->session()->regenerate();

        return redirect(route('profile'));
    }



}