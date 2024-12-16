<?php

namespace App\Http\Requests\Subject;

use App\Helpers\Qs;
use Illuminate\Foundation\Http\FormRequest;

class SubjectCreate extends FormRequest
{

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
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:subjects,slug',
            'my_class_id' => 'required|exists:my_classes,id',
            'teacher_id' => 'required|exists:users,id',
            'hari' => 'required|integer|min:1|max:7',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ];
    }
    public function attributes()
    {
        return [
            'my_class_id' => 'Class',
            'teacher_id' => 'Teacher',
            'slug' => 'Short Name',
            'hari' => 'Day',
            'jam_mulai' => 'Time',
            'jam_selesai' => 'Time',
        ];
    } 

    protected function getValidatorInstance()
    {
        $input = $this->all();

        $input['teacher_id'] = $input['teacher_id'] ? Qs::decodeHash($input['teacher_id']) : NULL;

        $this->getInputSource()->replace($input);

        return parent::getValidatorInstance();
    }
}
