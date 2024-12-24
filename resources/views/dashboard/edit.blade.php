@extends('layouts.app')

@section('title', 'Edit Asset - ' . $asset->namaasset)

@section('content')

    <div class="flex flex-col h-screen items-center justify-start w-full">

        <div class="w-full  max-w-7xl py-10">
            <h2 class="text-center text-2xl font-bold">EDIT ASSET: {{ $asset->namaasset }}</h2>
            <form action="{{ route('update_asset', $asset->id) }}" method="POST"class="w-full mx-auto w-full mt-10 px-8">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <div class="flex items-center">
                        <label for="nama_asset" class="w-32 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Asset</label>
                        <input type="text" id="nama_asset" name="nama_asset"
                            value="{{ old('nama_asset', $asset->namaasset) }}"
                            class="@error('nama_asset') border-red-500 border-2 @enderror shadow-sm  border-2 border-black text-gray-900 text-sm focus:ring-green-200 focus:border-green-200 block w-full p-2.5 " />
                    </div>
                    @error('nama_asset')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500 text-center"><span
                                class="font-medium">Oops!</span>
                            {{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <div class="flex items-center">
                        <label for="tgl_beli" class="w-32 text-sm font-medium text-gray-900 dark:text-white">Tgl
                            Beli</label>
                        <input type="date" id="tgl_beli" name="tgl_beli" value="{{ old('tgl_beli', $asset->tglbeli) }}"
                            class="@error('tgl_beli') border-red-500 border-2 @enderror shadow-sm  border-2 border-black text-gray-900 text-sm focus:ring-green-200 focus:border-green-200 block w-full p-2.5 " />
                    </div>
                    @error('tgl_beli')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500 text-center"><span
                                class="font-medium">Oops!</span>
                            {{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-5">
                    <div class="flex items-center">
                        <label for="harga_beli" class="w-32 text-sm font-medium text-gray-900 dark:text-white">Harga
                            Beli</label>
                        <input type="number" id="harga_beli" name="harga_beli"
                            value="{{ old('harga_beli', $asset->hrgbeli) }}"
                            class="@error('harga_beli') border-red-500 border-2 @enderror shadow-sm  border-2 border-black text-gray-900 text-sm focus:ring-green-200 focus:border-green-200 block w-full p-2.5 " />
                    </div>
                    @error('harga_beli')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500 text-center"><span
                                class="font-medium">Oops!</span>
                            {{ $message }}</p>
                    @enderror
                </div>



                <div class="mb-5 flex items-center">
                    <label for="aktif" class="w-32 text-sm font-medium text-gray-900 dark:text-white">Aktif</label>
                    <select type="number" id="aktif" name="aktif"
                        class="shadow-sm border-2 border-black text-gray-900 text-sm focus:ring-green-200 focus:border-green-200 block w-full p-2.5 "
                        required>
                        <option value="">--Pilih Status Asset--</option>
                        <option value="Y" {{ old('aktif', $asset->aktif) == 'Y' ? 'selected' : '' }}>AKTIF</option>
                        <option value="N" {{ old('aktif', $asset->aktif) == 'N' ? 'selected' : '' }}>TIDAK</option>
                    </select>
                </div>


                <div class="flex items-center justify-center gap-x-8 mt-10">
                    <button type="submit"
                        class="text-black w-48 bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-green-200 font-bold rounded-lg text-sm px-5 py-2.5 text-center ">SIMPAN</button>

                    <a href="{{ route('dashboard_index') }}"
                        class="text-black w-48 bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-green-200 font-bold rounded-lg text-sm px-5 py-2.5 text-center ">KEMBALI</a>
                </div>

            </form>

        </div>


    </div>
@endsection
