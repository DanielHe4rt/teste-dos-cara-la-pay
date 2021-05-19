<?php


namespace App\Observers;


use App\Models\User;
use Ramsey\Uuid\Uuid;

class UserObserver
{
    public function created(User $user) {
        $user->wallet()->create([
            'id' => Uuid::uuid4()->toString(),
            'balance' => 0
        ]);
    }
}
