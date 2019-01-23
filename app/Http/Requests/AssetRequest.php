<?php namespace App\Http\Requests;

class AssetRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => '',
            'model' => 'required',
            'price' => 'required'
        ];
    }
}
