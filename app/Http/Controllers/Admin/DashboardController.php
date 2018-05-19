<?php
/**
 * Created by PhpStorm.
 * User: Panas
 * Date: 13.05.2018
 * Time: 11:45
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    protected function index()
    {

        $user = User::find(Auth::id());
        
        dd($user);
        return view('dashboard');
    }
}