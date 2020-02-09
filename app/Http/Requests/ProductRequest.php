<?php

namespace App\Http\Requests;

use App\Http\Libraries\Fabelio;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $regex = '/^(https:\/\/)?(fabelio+)\.(com+)\/(ip+)\/([\/\w \.-]*)\.html?$/';
        $rules = [
            'url' => [
                'required',
                'max:512',
                'regex:' . $regex,
                'unique:products,url',
                function ($attr, $val, $fail) {
                    $data = Fabelio::returnJsonProduct($this->url);
                    if (!$data) {
                        return $fail($attr.' is invalid.');
                    }
                    $this->merge($data);
                }
            ]
        ];
        return $rules;
    }
}
