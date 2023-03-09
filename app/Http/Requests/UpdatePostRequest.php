<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'       =>['required', Rule::unique('posts')->ignore($this->post),'max:150'],
            'content'     => ['nullable'],
            'category_id' =>['nullable','exists:categories,id'],
            'tags'        =>['exists:tag,id'],
            'cover_image' => ['nullable', 'image']
        ];
    }

        /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.required'=> 'A title is required',
            'title.unique' => 'E\' gia presente un post con questo titolo',
            'title.max'=>'Il post non può essere più lungo di :max caratteri',
            'category_id.exists' => 'Devi selezionare',
            'tags'        =>'il tag selezionato non è valido'
        ];
    }
}
