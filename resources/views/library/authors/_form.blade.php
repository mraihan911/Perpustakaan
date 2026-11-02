<div class="field mb-4">
    <label for="name" class="block text-sm font-medium text-gray-700">Nama Penulis</label>
    <input
        type="text"
        id="name"
        name="name"
        value="{{ old('name', $author->name ?? '') }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"
        required
    >
    @error('name')
        <small class="err text-red-500 text-xs">{{ $message }}</small>
    @enderror
</div>

<div class="field mb-4">
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <input
        type="email"
        id="email"
        name="email"
        value="{{ old('email', $author->email ?? '') }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"
        required
    >
    @error('email')
        <small class="err text-red-500 text-xs">{{ $message }}</small>
    @enderror
</div>

<div class="field mb-6">
    <label for="bio" class="block text-sm font-medium text-gray-700">Biografi (Opsional)</label>
    <textarea
        id="bio"
        name="bio"
        rows="4"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"
    >{{ old('bio', $author->bio ?? '') }}</textarea>
    @error('bio')
        <small class="err text-red-500 text-xs">{{ $message }}</small>
    @enderror
</div>

<div class="flex items-center space-x-4">
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 font-medium">Simpan</button>
    <a href="{{ route('library.authors.index') }}" class="text-gray-600 hover:underline">Batal</a>
</div>