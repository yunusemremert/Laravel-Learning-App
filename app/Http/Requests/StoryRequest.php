<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryRequest extends FormRequest
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
            'title' => [
                'required', 'min:10', function($attribute, $value, $fail){
                    if($value == 'Dummy Title'){
                        $fail($attribute. ' is not valid');
                    }
                },
                // Rule:unique('stories')->ignore($storyId);
            ],
            'body' => 'required',
            'type' => 'required',
            'status' => 'required|in:0,1'
        ];
    }

    public function withValidator($v){
        //
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'body.required' => 'A body is required',
            'required' => 'Please enter :attribute'
        ];
    }
}
