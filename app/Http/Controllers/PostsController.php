<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Classes\FBPoster;
use App\Classes\IGPoster;
use App;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token = 'xD')
    {
        // Save for later

        return response()->json([
            'data' => [
                'token' => $token
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $params = [
            'token' => $request->token,
            'post_content' => $request->post_content,
            'link' => $request->link,
            'fb_photo' => $request->facebook_photo,
            'ig_photo' => $request->instagram_photo
        ];

        $fb_response = FBPoster::post($params);
        $ig_response = IGPoster::post($params);


        return response()->json([
            'data' => [
                'fb_response' => $fb_response,
                'ig_response' => $ig_response
            ]
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function destroy($id)
    {
        //
    }
}
