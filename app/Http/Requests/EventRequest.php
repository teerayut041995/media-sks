<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'event_name' => 'required',
            'event_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'event_date' => 'required|date_format:"m/d/Y"',
            'event_location' => 'required',
            'event_description' => 'required',
            'publishing_status' => 'required',
        ];
    }

    public function messages(){
        return [
        'event_name.required' => 'กรุณากรอกชื่อกิจกรรม',
        'event_image.required' => 'กรุณาเลือกรูปภาพ',
        'event_image.image' => 'กรุณาเลือกไฟลืรูปภาพเท่านั้น',
        'event_date.required' => 'กรุณาเลือกวันที่จัดกิจกรรม',
        'event_date.date_format' => 'กรุณากรอกวันที่ให้ถูกต้อง เช่น 07/14/2018',
        'event_location.required' => 'กรุณากรอกสถานที่จัดกิจกรรม',
        'event_description.required' => 'กรุณากรอกคำอธิบายประกอบกิจกรรม',
        'publishing_status.required' => 'กรุณาเลือกสถานะ',
        ];
    }

}
