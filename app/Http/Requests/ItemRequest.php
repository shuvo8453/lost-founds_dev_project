<?php

namespace App\Http\Requests;

use App\Enums\ItemTypeEnum;
use Illuminate\Validation\Rules\Enum;
use Joy2362\ServiceGenerator\Request\ApiServiceRequest;

class ItemRequest extends ApiServiceRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:1', 'max:100', 'string'],
            'description' => ['nullable', 'min:1', 'string'],
            'type' => ['required', new Enum(ItemTypeEnum::class)],
            'image' => ['nullable','image'],
        ];
    }
}
