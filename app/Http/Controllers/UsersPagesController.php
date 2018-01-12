<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        return response()->json([
            'pages' => User::find($user_id)->pages
        ]);
    }
}