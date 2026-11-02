<?php

namespace Modules\Library\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorHasBooksException extends Exception
{
    public function __construct(
        public readonly string $authorName,
        public readonly int $bookCount,
    ) {
        parent::__construct("Penulis '{$authorName}' tidak dapat dihapus karena masih memiliki {$bookCount} buku.");
    }

    public function report(): void
    {
        Log::warning($this->getMessage(), ['author' => $this->authorName, 'books' => $this->bookCount]);
    }

    public function render(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $this->getMessage(),
                'error'   => 'author_has_books',
                'details' => ['author' => $this->authorName, 'book_count' => $this->bookCount],
            ], 409);
        }

        return back()->with('error', $this->getMessage());
    }
}