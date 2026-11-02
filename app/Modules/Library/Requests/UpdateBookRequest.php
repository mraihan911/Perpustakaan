<?php

namespace Modules\Library\Requests;

use Illuminate\Validation\Rule;

class UpdateBookRequest extends StoreBookRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'isbn' => [
                'required',
                'regex:' . self::ISBN_REGEX,
                Rule::unique('books', 'isbn')->ignore($this->route('book')),
            ],
        ]);
    }
}