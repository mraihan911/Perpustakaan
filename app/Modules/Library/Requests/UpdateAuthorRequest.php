<?php

namespace Modules\Library\Requests;

use Illuminate\Validation\Rule;

class UpdateAuthorRequest extends StoreAuthorRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'email' => ['required', 'email', Rule::unique('authors', 'email')->ignore($this->route('author'))],
        ]);
    }
}