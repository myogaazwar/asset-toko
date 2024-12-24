@extends('layouts.app')
@section('title', 'Tambah Asset Masuk')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h2 class="text-center font-bold text-3xl">Tambah Asset Masuk</h2>

        <form action="{{ route('assetmasuk.store') }}" method="POST" class="mt-6">
            @csrf
            <div>
                <label for="kodeasset" class="block font-bold">Kode Asset</label>
                <select name="kodeasset" id="kodeasset"
                    class="w-full border border-gray-300 p-2 rounded focus:ring-green-200 focus:border-green-200">
                    @foreach ($assetsAktif as $asset)
                        <option value="{{ $asset->kodeasset }}">{{ $asset->kodeasset }} - {{ $asset->namaasset }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label for="tanggal" class="block font-bold">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal"
                    class="@error('tanggal') border-red-500 border-2 @enderror  w-full border border-gray-300 p-2 rounded focus:ring-green-200 focus:border-green-200">

                @error('tanggal')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500 text-center"><span class="font-medium">Oops!</span>
                        {{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="qty" class="block font-bold">Jumlah (QTY)</label>
                <input type="number" name="qty" id="qty"
                    class="w-full border border-gray-300 p-2 rounded focus:ring-green-200 focus:border-green-200"
                    min="1">
            </div>

            <button type="submit" class="mt-6 bg-secondary-color text-white py-2 px-4 rounded">Simpan</button>
        </form>
    </div>
@endsection
