<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(Request $request){
        return $request->user()->is_admin ? view('panel-admin.index') : view('panel-user.index');
    }

}
