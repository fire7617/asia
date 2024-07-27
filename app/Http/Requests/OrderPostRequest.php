<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use App\Rules\OrderNameRule;

class OrderPostRequest extends FormRequest
{

    CONST CODE_INVALID_PARAM = 422;

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
            'id'                => ['required','string'],
            'name'              => ['required','alpha','max:255',new OrderNameRule],
            'price'             => ['required','int','max:2000'],
            'currency'          => ['required',Rule::in(['TWD','USD'])],
            'address'           => ['required'],
            'address.city'      => [],
            'address.district'  => [],
            'address.street'    => [],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required' => 'id is required',
            'name.alpha' => 'Name contains non-English characters',
            'price.max' => 'Price is over 2000',
            'currency.in' => 'currency format is wrong',
        ];
    }


    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {

        $response = new Response(['error' => $validator->errors()->first()], self::CODE_INVALID_PARAM);

        throw new ValidationException($validator, $response);
    }

    //public function response(array $errors)
    //{
    //    if ($this->expectsJson()) {
    //        return new JsonResponse($errors, 400);
    //    }

    //}
}
