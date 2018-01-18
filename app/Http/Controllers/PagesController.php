<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\UserPages;
use Illuminate\Validation\Validator;
use App\Http\Requests\PagesDeleteRequest;

class PagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            [
                'success' => true,
                'data' => [
                    'pages' => App\User::byToken($this->token)->first()->pages
                ]
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'id'=> 'unique:user_pages,id',
            'name'=> 'unique:user_pages,name',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Page already exits!'
            ]);
        }

        $response = UserPages::create([
            'id' => $request->id,
            'name' => $request->name,
            'category' => $request->category,
            'photo' => $request->photo,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'success' => $response
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(PagesDeleteRequest $request, $id)
    {
        $affected = UserPages::destroy([$id]);

        return response()->json([
            'success' => ($affected >0)?true:false,
        ]);
    }
}
