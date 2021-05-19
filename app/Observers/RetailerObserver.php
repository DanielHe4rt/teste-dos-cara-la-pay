<?php


namespace App\Observers;


use App\Models\Retailer;
use Ramsey\Uuid\Uuid;

class RetailerObserver
{
    public function created(Retailer $retailer) {
        $retailer->wallet()->create([
            'id' => Uuid::uuid4()->toString(),
            'balance' => 0
        ]);
    }
}
