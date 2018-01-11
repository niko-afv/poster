<?php

/**
 * Class FBPoster
 * Facebook Poster
 */

namespace App\Classes;

use Facebook\Facebook;
use App;

class FBPoster extends Poster
{
    static function post(Array $params)
    {
        $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');

        // Get basic info on the user from Facebook.
        try {

            $pages = $fb->get('/me/accounts', $params['token']);
            $pages = $pages->getGraphEdge()->asArray();

            //$response = $fb->post('/'.$pages[0]['id'].'/feed', ['message' => $params['post_content'], 'link' => $params['link']], $pages['0']['access_token']);
            $response = $fb->post('/'.$pages[0]['id'].'/photos', ['message'=> $params['post_content'],'url' => 'https://cdn.memegenerator.es/imagenes/memes/full/20/11/20118882.jpg'], $pages['0']['access_token']);

            return $response;

        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

}