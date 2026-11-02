<?php

namespace Modules\Library\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Arr;
use Modules\Library\Exceptions\BookNotAvailableException;
use Modules\Library\Requests\StoreBookRequest;
use Modules\Library\Requests\UpdateBookRequest;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author', 'categories')->latest()->paginate(10);

        return view('library.books.index', compact('books'));
    }

    public function create()
    {
        return view('library.books.create', $this->formData());
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        $book = Book::create(Arr::except($data, 'category_ids'));
        $book->categories()->sync($data['category_ids'] ?? []);

        return redirect()->route('library.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        return view('library.books.edit', $this->formData() + ['book' => $book]);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        $book->update(Arr::except($data, 'category_ids'));
        $book->categories()->sync($data['category_ids'] ?? []);

        return redirect()->route('library.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('library.books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function borrow(Book $book)
    {
        if ($book->stock < 1) {
            throw new BookNotAvailableException($book->id, $book->title);
        }

        $book->decrement('stock');

        return back()->with('success', "Buku '{$book->title}' berhasil dipinjam.");
    }

    private function formData(): array
    {
        return [
            'authors'    => Author::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ];
    }
}