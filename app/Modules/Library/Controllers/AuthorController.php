<?php

namespace Modules\Library\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Modules\Library\Exceptions\AuthorHasBooksException;
use Modules\Library\Requests\StoreAuthorRequest;
use Modules\Library\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->orderBy('name')->paginate(10);

        return view('library.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('library.authors.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        Author::create($request->validated());

        return redirect()->route('library.authors.index')->with('success', 'Penulis berhasil ditambahkan.');
    }

    public function edit(Author $author)
    {
        return view('library.authors.edit', compact('author'));
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return redirect()->route('library.authors.index')->with('success', 'Penulis berhasil diperbarui.');
    }

    public function destroy(Author $author)
    {
        $jumlah = $author->books()->count();

        if ($jumlah > 0) {
            throw new AuthorHasBooksException($author->name, $jumlah);
        }

        $author->delete();

        return redirect()->route('library.authors.index')->with('success', 'Penulis berhasil dihapus.');
    }
}