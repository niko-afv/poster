<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App;

class FanPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id)
    {
        $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');

        $fb_response = $fb->get('/me/accounts', $this->token);
        $pages_list = $fb_response->getGraphEdge()->asArray();
        $pages = [];

        $accounts = App\User::find($user_id)->accounts()->where('account_type_id',1)->get()->pluck('source_id');

        $fanpages = new Collection($pages_list);
        $fanpages2 = $fanpages->keyBy('id');
        $fanpages = $fanpages->pluck('id');
        $list = $fanpages->diff($accounts);


        foreach ($list as $item) {
            $page = $fanpages2[$item];
            $fb_response = $fb->get('/'.$page['id'].'/photos?fields=picture', $page['access_token']);
            $photos_list = $fb_response->getGraphEdge()->asArray();

            $pages[] = [
                'token' => $page['access_token'],
                'id' => $page['id'],
                'name' => $page['name'],
                'category' => $page['category'],
                'photo' => $photos_list[0]['picture']
            ];
        }

        return response()->json([
            'success' => (count($pages))?true: false,
            'data' => [
                'accounts' => $pages
            ]
        ]);
    }


}
