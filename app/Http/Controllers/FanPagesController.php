<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class FanPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $token)
    {
        $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');

        $fb_response = $fb->get('/me/accounts', $token);
        $pages_list = $fb_response->getGraphEdge()->asArray();
        $pages = [];

        foreach ($pages_list as $page) {
            $fb_response = $fb->get('/'.$page['id'].'/photos?fields=picture', $page['access_token']);
            $photos_list = $fb_response->getGraphEdge()->asArray();

            $pages[] = [
                'token' => $page['access_token'],
                'id' => $page['id'],
                'name' => $page['name'],
                'category' => $page['category'],
                'photo' => $photos_list[0]
            ];
        }

        return response()->json([
            'data' => [
                'pages' => $pages
            ]
        ]);
    }


}
