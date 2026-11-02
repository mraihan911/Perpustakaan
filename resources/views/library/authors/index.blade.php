@extends('layouts.library')
@section('title', 'Daftar Penulis')
@section('content')
    <h2>Daftar Penulis</h2>
    <p><a href="{{ route('library.authors.create') }}">+ Tambah Penulis</a></p>
    <table>
        <tr><th>No</th><th>Nama</th><th>Email</th><th>Jumlah Buku</th><th>Aksi</th></tr>
        @forelse ($authors as $i => $author)
            <tr>
                <td>{{ $authors->firstItem() + $i }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ $author->email }}</td>
                <td>{{ $author->books_count }}</td>
                <td>
                    <a href="{{ route('library.authors.edit', $author) }}">Edit</a>
                    <form class="inline" method="POST" action="{{ route('library.authors.destroy', $author) }}"
                          onsubmit="return confirm('Hapus penulis ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Belum ada data penulis.</td></tr>
        @endforelse
    </table>
    {{ $authors->links() }}
@endsection