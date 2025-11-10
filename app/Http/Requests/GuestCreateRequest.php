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
        $eventIds = $this->input('event_ids', []);
        return [
            'name' =>  ['required', 'string', 'max:30'],
            'event_ids' =>  ['required', 'array'],
            //'event_ids.*' =>  array_merge(['string', (collect($eventIds)->contains(0) ? [] : ['exists:events,id'])]),
            'event_ids.*' =>  ['string', (in_array('0', $eventIds) ? [] : 'exists:events,id')],
            'email' => ['required', 'email', 'max:50', Rule::unique('guests')->ignore($guestId)],
            'phone' => ['required', 'digits:10']
        ];
    }
}
