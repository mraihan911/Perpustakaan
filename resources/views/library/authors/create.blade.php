@extends('layouts.library')
@section('title', 'Tambah Penulis')
@section('content')
    <h2>Tambah Penulis</h2>
    <form method="POST" action="{{ route('library.authors.store') }}" novalidate>
        @csrf
        @include('library.authors._form')
    </form>
@endsection