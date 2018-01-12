<?php

namespace App\Http\Requests;

use App\User;
use App\UserPages;
use Illuminate\Foundation\Http\FormRequest;

class PagesDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $page = UserPages::find($this->route('page'));
        if(!$page){return true;}

        $user = User::where('remember_token', $this->get('access_token'))->where('id',$page->user_id)->get();

        return ($user->count())?true:false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
