@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 h-screen">
        <h2 class="text-center font-bold text-3xl">MASTER ASSET TOKO</h2>

        <div class="mt-10">
            @session('success_login')
                <div id="alert-border-3"
                    class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success_login') }}
                    </div>
                </div>
            @endsession



            <a type="submit" href="{{ route('page_create') }}"
                class="text-white mt-10 w-48 block  bg-secondary-color cursor-pointer  focus:ring-4 focus:outline-none focus:ring-green-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">+
                TAMBAH</a>


            @if (count($assets) > 0)
                <table class="table-auto w-full text-center border-collapse border border-slate-500 mt-4 ">
                    <thead>
                        <tr>
                            <th class="border border-slate-600">No</th>
                            <th class="border border-slate-600">Kode </th>
                            <th class="border border-slate-600">Nama </th>
                            <th class="border border-slate-600">Tanggal Beli</th>
                            <th class="border border-slate-600">Harga Beli</th>
                            <th class="border border-slate-600">Status</th>
                            <th class="border border-slate-600">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assets as $asset)
                            <tr>
                                <td class="border border-slate-600">{{ $loop->iteration }}</td>
                                <td class="border border-slate-600">{{ $asset->kodeasset }}</td>
                                <td class="border border-slate-600">{{ $asset->namaasset }}</td>
                                <td class="border border-slate-600">{{ $asset->tglbeli }}</td>
                                <td class="border border-slate-600">Rp. {{ number_format($asset->hrgbeli) }}</td>
                                <td class="border border-slate-600">{{ $asset->aktif == 'Y' ? 'Aktif' : 'Tidak Aktif' }}
                                </td>
                                <td class="border border-slate-600 ">
                                    <a href="{{ route('page_edit', $asset->id) }}" class="text-yellow-300 font-bold">E</a>
                                    <form action="{{ route('destroy_asset', $asset->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 font-bold"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data asset {{ $asset->namaasset }} ini?')">X</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="mt-10">Data Master asset tidak ada...</h1>
            @endif

        </div>

    </div>

    <script>
        const alert = document.getElementById('alert-border-3');
        setTimeout(() => {
            alert.style.display = 'none';
        }, 3000);
    </script>
@endsection
