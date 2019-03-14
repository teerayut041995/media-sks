<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest
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
            'project_name' => 'required',
            'topics' => 'required',
            'lecturer' => 'required',
            'embed_video' => 'required',
        ];
    }
    public function messages(){
        return [
        'project_name.required' => 'กรุณากรอกชื่อโครงการอบบรม',
        'topics.required' => 'กรุณากรอกเรื่องที่บรรยาย',
        'lecturer.required' => 'กรุณากรอกผู้บรรยาย',
        'embed_video.required' => 'กรุณากรอก Embed Video',
        ];
    }
}
