<?php

namespace Modules\Library\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    // ISBN-10 (9 digit + angka/X) atau ISBN-13 (diawali 978/979)
    protected const ISBN_REGEX = '/^(\d{9}[\dX]|97[89]\d{10})$/';

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $isbn = $this->input('isbn');

        if (is_string($isbn)) {
            $this->merge(['isbn' => strtoupper(preg_replace('/[\s-]/', '', $isbn))]);
        }
    }

    public function rules(): array
    {
        return [
            'title'          => ['required', 'string', 'max:255'],
            'isbn'           => ['required', 'regex:' . self::ISBN_REGEX, 'unique:books,isbn'],
            'published_year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'price'          => ['required', 'numeric', 'min:0'],
            'stock'          => ['required', 'integer', 'min:0'],
            'author_id'      => ['required', 'exists:authors,id'],
            'category_ids'   => ['nullable', 'array'],
            'category_ids.*' => ['exists:categories,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'          => 'Judul buku wajib diisi.',
            'title.max'               => 'Judul buku maksimal 255 karakter.',
            'isbn.required'           => 'ISBN wajib diisi.',
            'isbn.regex'              => 'Format ISBN tidak valid (gunakan ISBN-10 atau ISBN-13).',
            'isbn.unique'             => 'ISBN sudah terdaftar.',
            'published_year.required' => 'Tahun terbit wajib diisi.',
            'published_year.integer'  => 'Tahun terbit harus berupa bilangan bulat.',
            'published_year.min'      => 'Tahun terbit minimal 1900.',
            'published_year.max'      => 'Tahun terbit tidak boleh melebihi tahun ini.',
            'price.required'          => 'Harga wajib diisi.',
            'price.numeric'           => 'Harga harus berupa angka.',
            'price.min'               => 'Harga tidak boleh negatif.',
            'stock.required'          => 'Stok wajib diisi.',
            'stock.integer'           => 'Stok harus berupa bilangan bulat.',
            'stock.min'               => 'Stok tidak boleh negatif.',
            'author_id.required'      => 'Penulis wajib dipilih.',
            'author_id.exists'        => 'Penulis yang dipilih tidak ditemukan.',
            'category_ids.*.exists'   => 'Kategori yang dipilih tidak valid.',
        ];
    }
}