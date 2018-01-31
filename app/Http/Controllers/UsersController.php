<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'user' => User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function groups(Request $request, $user_id){
        return response()->json([
            'success' => true,
            'data' => [
                'groups' => User::where('id',$user_id)->first()->groups()->with('accounts')->get()
            ]
        ]);
    }

    public function removeAccount(Request $request, $user_id, $account_id){
        $user = User::where('id',$user_id)->first();
        $query = $user->accounts()->where('id', $account_id);
        $query->delete();
        $count = $query->count();
        return response()->json([
            'success' => ($count == 0)?true:false,
            'data' => []
        ]);
    }


}
