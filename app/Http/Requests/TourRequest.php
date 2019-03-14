<?php

namespace Honviettour\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TourRequest extends FormRequest
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
        $trans = json_decode($this->trans, true);
        $prices = json_decode($this->prices, true);
        $images = json_decode($this->images, true);
        if(!empty($trans)) {
            $transRules = [
                'name' => 'required',
                'lang' => 'required|size:2|in:en,vi',
                'description' => 'required',
                'service' => 'required',
                'note' => 'required',
                'detail' => 'required',
            ];
            $validator = Validator::make($trans, $transRules);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        }
        if(!empty($prices)) {
            $pricesRules = [
                'type' => 'required',
                'value' => 'required|numeric',
                'description' => 'required|string',
                'note' => 'required|string',
            ];
            $validator = Validator::make($prices, $pricesRules);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        }
        if(!empty($images)) {
            $imagesRules = [
                'type' => 'required',
                'value' => 'required|numeric',
                'description' => 'required|string',
                'note' => 'required|string',
            ];
            $validator = Validator::make($images, $imagesRules);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        }
        // var_dump($trans);die;
        return [
            'start_place' => 'required',
            'available_number' => 'required|numeric',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|numeric',
            'trans' => 'required|json',
            'images' => 'required|json',
            'plans' => 'required|numeric|exists:plans,id',
            'prices' => 'required|json',
        ];
    }
}