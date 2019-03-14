<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest
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
            'post_title' => 'required',
            'post_image_update' => 'image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required',
            'post_detail' => 'required',
            'summernoteInput' => 'required',
        ];
    }
    public function messages(){
        return [
        'post_title.required' => 'กรุณากรอกชื่อบทความ',
        'post_image_update.image' => 'กรุณาเลือกไฟลืรูปภาพเท่านั้น',
        'category_id.required' => 'กรุณาเลือกประเภทบทความ',
        'post_detail.required' => 'กรุณากรอกเนื้อหาย่อ',
        'summernoteInput.required' => 'กรุณากรอกเนื้อหาบทความ',
        ];
    }
}
