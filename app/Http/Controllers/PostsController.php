<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\Facebook;
use Session;
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
        $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');

        // Get basic info on the user from Facebook.
        try {

            $pages = $fb->get('/me/accounts', $request->token);
            $pages = $pages->getGraphEdge()->asArray();

            //$response = $fb->post('/'.$pages[0]['id'].'/feed', ['message' => $request->post_content, 'link' => $request->link], $pages['0']['access_token']);
            $response = $fb->post('/'.$pages[0]['id'].'/photos', ['message'=> 'Checkout my photo','url' => 'https://statics.viralizalo.com/virs/2016/08/VIR_286240_21980_que_tipo_de_director_deportivo_serias.jpg?cb=5013538'], $pages['0']['access_token']);


        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        dd($response->getGraphNode()->asArray());

        return response()->json([
            'data' => [
                'content' => $request->get('content')
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
