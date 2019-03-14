<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'category_id' => 'required',
            'sub_category_name' => 'required',
            'sub_category_ranking' => 'integer',
        ];
    }

    public function messages(){
        return [
        'category_id.required' => 'กรุณาเลือกประเภทบทความหลัก',
        'sub_category_name.required' => 'กรุณากรอกชื่อประเภทบทความย่อย',
        'sub_category_ranking.integer' => 'กรอกเฉพาะตัวเลขเท่านั้น'
        ];
    }
}
