<?php


namespace App\Repositories;


use App\Models\Retailer;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\InvalidDataProviderException;

class AuthRepository
{
    public function authenticate(string $provider, array $fields): array
    {

        $selectedProvider = $this->getProvider($provider);
        $model = $selectedProvider->where('email', $fields['email'])->first();

        if (!$model) {
            throw new AuthorizationException('Wrong credentials', 401);
        }

        if (!Hash::check($fields['password'], $model->password)) {
            throw new AuthorizationException('Wrong credentials', 401);
        }

        $token = $model->createToken($provider);

        return [
            'access_token' => $token->accessToken,
            'expires_at' => $token->token->expires_at,
            'provider' => $provider
        ];
    }

    public function getProvider(string $provider)
    {
        if ($provider == "user") {
            return new User();
        } else if ($provider == "retailer") {
            return new Retailer();
        } else {
            throw new InvalidDataProviderException('Provider Not found');
        }
    }
}
