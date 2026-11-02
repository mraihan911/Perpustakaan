<?php

namespace Modules\Library\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookNotAvailableException extends Exception
{
    public function __construct(
        public readonly int $bookId,
        public readonly string $title,
    ) {
        parent::__construct("Buku '{$title}' tidak tersedia karena stok habis.");
    }

    // Dicatat ke storage/logs/laravel.log
    public function report(): void
    {
        Log::warning($this->getMessage(), ['book_id' => $this->bookId]);
    }

    public function render(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $this->getMessage(),
                'error'   => 'book_not_available',
                'details' => ['book_id' => $this->bookId, 'title' => $this->title],
            ], 422);
        }

        return back()->with('error', $this->getMessage());
    }
}