<?php

namespace App\Http\Requests;

use App\Models\Ambiente;
use Illuminate\Foundation\Http\FormRequest;

class SolicitudCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [

            // Logic for findOrFail
            // 'username' => 'unique:users,username,'.$this->user.'|required',
            'ambiente' => 'required',

            //'email' => Rule::unique('users')->where(function ($query) {
              //      return $query->where('account_id', 1);
                //    })
        ];
    }
}
