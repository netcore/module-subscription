<?php
namespace Modules\Subscription\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Subscription\Models\Option;
use Netcore\Translator\Helpers\TransHelper;

class OptionsRequest extends FormRequest
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
        $excludeUnique = $this->route('option') ? ',' . $this->route('option')->id : null;

        $rules = [
            'type'  =>  'required|in:' . implode(',', Option::TYPES),
            'key'   =>  'required|unique:netcore_subscription__options,key' . $excludeUnique
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
        $messages = [];

        foreach (TransHelper::getAllLanguages() as $language)
        {
            $messages['translations.' . $language->iso_code . '.name.required'] = 'Name (' . $language->title_localized . ') is required';
        }

        return $messages;
    }

}