@extends('layouts.app')
@section('title', 'Edit Asset Masuk')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h2 class="text-center font-bold text-3xl">Edit Asset Masuk: {{ $assetMasuk->asset->namaasset }}</h2>

        <form action="{{ route('assetmasuk.update', $assetMasuk->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            <div>
                <label for="kodeasset" class="block font-bold">Kode Asset</label>
                <select name="kodeasset_display" id="kodeasset_display" class=" w-full border border-gray-300 p-2 rounded"
                    disabled>
                    @foreach ($assets as $asset)
                        <option value="{{ $asset->kodeasset }}"
                            {{ $asset->kodeasset === $assetMasuk->kodeasset ? 'selected' : '' }}>
                            {{ $asset->kodeasset }} - {{ $asset->namaasset }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="kodeasset" value="{{ $assetMasuk->kodeasset }}">
            </div>

            <div class="mt-4">
                <label for="tanggal" class="block font-bold">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal"
                    class="@error('tanggal') border-red-500 border-2 @enderror  w-full border border-gray-300 p-2 rounded focus:ring-green-200 focus:border-green-200"
                    value="{{ $assetMasuk->tanggal }}">

                @error('tanggal')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500 text-center"><span class="font-medium">Oops!</span>
                        {{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="qty" class="block font-bold">Jumlah (QTY)</label>
                <input type="number" name="qty" id="qty"
                    class="@error('qty') border-red-500 border-2 @enderror  w-full border border-gray-300 p-2 rounded focus:ring-green-200 focus:border-green-200"
                    value="{{ $assetMasuk->qty }}" min="1">

                @error('qty')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500 text-center"><span class="font-medium">Oops!</span>
                        {{ $message }}</p>
                @enderror
            </div>


            <div class="flex gap-x-5 items-center">
                <button type="submit"
                    class="mt-6 bg-secondary-color text-white py-2 px-4 rounded hover:bg-slate-600 transition-all duration-500">Simpan</button>
                <a href="{{ route('assetmasuk.index') }}"
                    class="mt-6 bg-secondary-color py-2 px-4 rounded text-white hover:bg-slate-600 transition-all duration-500">Kembali</a>
            </div>


        </form>
    </div>
@endsection
