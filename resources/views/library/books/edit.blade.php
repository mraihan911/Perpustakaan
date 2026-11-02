@extends('layouts.library')
@section('title', 'Edit Buku')
@section('content')
    <h2>Edit Buku</h2>
    <form method="POST" action="{{ route('library.books.update', $book) }}" novalidate>
        @csrf
        @method('PUT')
        @include('library.books._form')
    </form>
@endsection