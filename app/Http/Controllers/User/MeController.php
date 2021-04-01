<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:retailer');
    }

    public function getMe()
    {
        return response()->json(Auth::guard('retailer')->user());
    }
}
