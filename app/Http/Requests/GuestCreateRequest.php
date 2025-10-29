<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuestCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $guestId = $this->route('guest');
        return [
            'name' =>  ['required', 'string', 'max:30'],
            'event_ids' =>  ['nullable', 'array'],
            'event_ids.*' => ['string', 'exists:events,id'],
            'email' => ['required', 'email', 'max:50', Rule::unique('guests')->ignore($guestId)],
            'phone' => ['required', 'digits:10']
        ];
    }
}
