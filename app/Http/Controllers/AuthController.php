<?php

namespace App\Http\Controllers;

use App\Exceptions\ProviderNotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * @var AuthRepository
     */
    private $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postAuthenticate(Request $request, string $provider)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        try {
            $result = $this->repository->authenticate($provider, $request->only(['email', 'password']));
            return response()->json($result);
        } catch (ProviderNotFoundException $e) {
            return response()->json(['error' => "Provider '" . $provider . "' not expected."], 422);
        } catch (UnauthorizedException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
