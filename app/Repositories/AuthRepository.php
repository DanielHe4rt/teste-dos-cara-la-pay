<?php


namespace App\Repositories;


use App\Exceptions\ProviderNotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{

    private $provider;

    public function authenticate(string $provider, array $data): array
    {
        $model = $this->getProvider($provider);
        $model = $model->where('email', $data['email'])->first();
        if (!$model) {
            throw new UnauthorizedException();
        }

        return $this->authorize($model, $data['password']);
    }

    private function authorize(AuthenticatableContract $model, string $password): array
    {
        if (!Hash::check($password, $model->password)) {
            throw new UnauthorizedException();
        }
        $tokenResult = $model->createToken($this->provider);
        return [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'provider' => ucfirst($this->provider)
        ];
    }

    private function getProvider(string $provider): AuthenticatableContract
    {
        $this->provider = $provider;
        switch ($provider) {
            case 'user':
                return new User();
            case 'retailer':
                return new Retailer();
            default:
                throw new ProviderNotFoundException();
        }
    }

    private function prepareAuthPayload(string $email, string $password)
    {
        return [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => $email,
            'password' => $password,
            'scope' => ''
        ];
    }

}
