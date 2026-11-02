
@php
    $selected = (array) old(
        'category_ids',
        isset($book) && $book
            ? $book->categories->pluck('id')->all()
            : []
    );
@endphp

<div class="field">
    <label for="title">Judul</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $book->title ?? '') }}"
    >
    @error('title')
        <small class="err">{{ $message }}</small>
    @enderror
</div>

<div class="field">
    <label for="isbn">ISBN</label>
    <input
        type="text"
        id="isbn"
        name="isbn"
        value="{{ old('isbn', $book->isbn ?? '') }}"
    >
    @error('isbn')
        <small class="err">{{ $message }}</small>
    @enderror
</div>

<div class="field">
    <label for="published_year">Tahun Terbit</label>
    <input
        type="number"
        id="published_year"
        name="published_year"
        value="{{ old('published_year', $book->published_year ?? '') }}"
    >
    @error('published_year')
        <small class="err">{{ $message }}</small>
    @enderror
</div>

<div class="field">
    <label for="price">Harga</label>
    <input
        type="number"
        step="0.01"
        id="price"
        name="price"
        value="{{ old('price', $book->price ?? '') }}"
    >
    @error('price')
        <small class="err">{{ $message }}</small>
    @enderror
</div>

<div class="field">
    <label for="stock">Stok</label>
    <input
        type="number"
        id="stock"
        name="stock"
        value="{{ old('stock', $book->stock ?? '') }}"
    >
    @error('stock')
        <small class="err">{{ $message }}</small>
    @enderror
</div>

<div class="field">
    <label for="author_id">Penulis</label>
    <select id="author_id" name="author_id">
        <option value="">-- Pilih penulis --</option>

        @foreach ($authors as $author)
            <option
                value="{{ $author->id }}"
                @selected(old('author_id', $book->author_id ?? '') == $author->id)
            >
                {{ $author->name }}
            </option>
        @endforeach
    </select>

    @error('author_id')
        <small class="err">{{ $message }}</small>
    @enderror
</div>

<div class="field">
    <label for="category_ids">
        Kategori (opsional, tahan Ctrl untuk memilih lebih dari satu)
    </label>

    <select id="category_ids" name="category_ids[]" multiple>
        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(in_array($category->id, $selected))
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_ids')
        <small class="err">{{ $message }}</small>
    @enderror
</div>

<button type="submit">Simpan</button>

<a href="{{ route('library.books.index') }}">Batal</a>
