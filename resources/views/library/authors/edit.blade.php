@extends('layouts.library')
@section('title', 'Edit Penulis')
@section('content')
    <h2>Edit Penulis</h2>
    <form method="POST" action="{{ route('library.authors.update', $author) }}" novalidate>
        @csrf
        @method('PUT')
        @include('library.authors._form')
    </form>
@endsection