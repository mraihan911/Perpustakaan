@extends('layouts.library')
@section('title', 'Daftar Buku')
@section('content')
    <h2>Daftar Buku</h2>
    <p><a href="{{ route('library.books.create') }}">+ Tambah Buku</a></p>
    <table>
        <tr><th>No</th><th>Judul</th><th>Penulis</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
        @forelse ($books as $i => $book)
            <tr>
                <td>{{ $books->firstItem() + $i }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author->name }}</td>
                <td>{{ $book->categories->pluck('name')->join(', ') }}</td>
                <td>Rp {{ number_format($book->price, 2, ',', '.') }}</td>
                <td>{{ $book->stock }}</td>
                <td>
                    <a href="{{ route('library.books.edit', $book) }}">Edit</a>
                    <form class="inline" method="POST" action="{{ route('library.books.borrow', $book) }}">
                        @csrf
                        <button type="submit">Pinjam</button>
                    </form>
                    <form class="inline" method="POST" action="{{ route('library.books.destroy', $book) }}"
                          onsubmit="return confirm('Hapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Belum ada data buku.</td></tr>
        @endforelse
    </table>
    {{ $books->links('pagination::simple-bootstrap-5') }}
@endsection