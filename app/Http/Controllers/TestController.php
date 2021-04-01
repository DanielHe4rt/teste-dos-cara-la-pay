<?php


namespace App\Http\Controllers;


use App\Models\Retailer;
use App\Models\User;

class TestController extends Controller
{

    public function test() {
        Retailer::factory()->create();
    }
}
