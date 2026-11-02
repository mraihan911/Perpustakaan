@extends('layouts.library')
@section('title', 'Tambah Buku')
@section('content')
    <h2>Tambah Buku</h2>
    <form method="POST" action="{{ route('library.books.store') }}" novalidate>
        @csrf
        @include('library.books._form')
    </form>
@endsection