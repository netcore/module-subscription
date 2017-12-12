<?php
namespace Modules\Subscription\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Netcore\Translator\Helpers\TransHelper;

class PlansUpdateRequest extends FormRequest
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
        $rules = [
            'prices.*.*.monthly_price'    =>  'decimal:0,9999999',
            'prices.*.*.original_price'   =>  'decimal:0,9999999',
        ];

        foreach (TransHelper::getAllLanguages() as $language)
        {
            $rules['translations.' . $language->iso_code . '.name'] = 'required';
        }

        return $rules;
    }

    /**
     * Get the validation messages
     *
     * @return array
     */
    public function messages()
    {
        $messages = [
            'decimal'   =>  'Price value is invalid'
        ];

        foreach (TransHelper::getAllLanguages() as $language)
        {
            $messages['translations.' . $language->iso_code . '.name.required'] = 'Name (' . $language->title_localized . ') is required';
        }

        return $messages;
    }

}