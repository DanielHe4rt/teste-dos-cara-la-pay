<?php


namespace Feature\app\Http\Controllers;


use App\Models\Retailer;
use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\TestCase;
use Mockery as m;

class AuthControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function createApplication()
    {
        return require './bootstrap/app.php';
    }

    public function testShouldUserSendWrongProvider()
    {
        // Prepare
        $payload = ['provider' => 'manager'];

        $expectedJson = [
            'error' => "Provider '" . $payload['provider'] . "' not expected."
        ];

        $user = [
            'email' => 'fake@danielheart.dev',
            'password' => 'arrozdoce'
        ];

        // Act
        $request = $this->post(route('authenticate', $payload), $user);

        // Assert
        $request->assertResponseStatus(422);
        $request->seeJson($expectedJson);
    }

    public function testUserShouldNotAuthenticateWithoutAnAccount()
    {
        // Prepare
        $payload = ['provider' => 'user'];

        $user = [
            'email' => 'fake@danielheart.dev',
            'password' => 'arrozdoce'
        ];
        // Act
        $request = $this->post(route('authenticate', $payload), $user);

        // Assert
        $request->assertResponseStatus(401);
        $request->seeJson(['error' => 'Unauthorized']);
    }

    public function testUserShouldNotAuthenticateWithWrongPassword()
    {
        // Prepare
        $payload = ['provider' => 'user'];

        $userPayload = [
            'email' => 'fake@danielheart.dev',
        ];
        $user = User::factory()->create($userPayload);
        $userPayload['password'] = 'lalala';
        // Act
        $request = $this->post(route('authenticate', $payload), $userPayload);

        // Assert
        $request->assertResponseStatus(401);
        $request->seeJson(['error' => 'Unauthorized']);
    }

    public function testUserCanAuthenticate()
    {

        // Prepare
        Artisan::call('passport:install');
        $user = Retailer::factory()->create(['email' => 'fake@danielheart.dev']);
        $payloadProvider = ['provider' => 'retailer'];
        $userPayload = [
            'email' => $user->email,
            'password' => 'secret123'
        ];

        // Act

        $request = $this->post(route('authenticate', $payloadProvider), $userPayload);

        $request->assertResponseOk();
        $request->seeJsonStructure(['access_token', 'token_type', 'provider']);
    }
}
