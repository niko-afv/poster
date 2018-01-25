<?php

namespace App\Http\Controllers;

use App\AccountType;
use Illuminate\Http\Request;

class AccountTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'accounttypes' => AccountType::all()
            ]
        ]);
    }
}