<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CardCreateRequest extends FormRequest
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
        $card = $this->route('card');
        $cardId = $card instanceof \App\Models\Card ? $card->id : $card;
        return [
            'event_id'   => ['required', 'integer', 'exists:events,id', Rule::unique('cards', 'event_id')->ignore($cardId,'id')],
            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'date'       => ['required', 'date'],
            'time' => ['required', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'title'      => ['required', 'string', 'max:255'],
            'location'   => ['nullable', 'string', 'max:255'],
            'address'    => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'theme_color' => ['nullable', 'string', 'max:50'],
            'rsvp_link' => ['nullable', 'string', 'max:255'],
            'is_active' =>  ['required', 'in:0,1'],
            'html' =>  ['required', 'string'],
        ];
    }
}
