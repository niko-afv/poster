<?php

/**
 * Class IGPoster
 * Instagram Poster
 */

namespace App\Classes;

use InstagramAPI\Instagram;
use App;

class IGPoster extends Poster
{
    static function post(Array $params)
    {
        $ig = new Instagram(false, false, $storageConfig = []);
        $username = 'testing7101';
        $password = 'testing';


        try {
            $loginResponse = $ig->login($username, $password);

            if ($loginResponse !== null && $loginResponse->isTwoFactorRequired()) {
                $twoFactorIdentifier = $loginResponse->getTwoFactorInfo()->getTwoFactorIdentifier();
                // The "STDIN" lets you paste the code via terminal for testing.
                // You should replace this line with the logic you want.
                // The verification code will be sent by Instagram via SMS.
                $verificationCode = trim(fgets(STDIN));
                $ig->finishTwoFactorLogin($username, $password, $twoFactorIdentifier, $verificationCode);
            }

            $userId = $ig->people->getUserIdForName('testing7101');
            $response = $ig->people->getInfoById($userId);

            // if you want only a caption, you can simply do this:
            $metadata = ['caption' => $params['post_content']];
            $ig->timeline->uploadPhoto(public_path($params['photo']), $metadata);

            return $response;

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
        }
    }

}