@extends('layouts.app')
@section('title', 'Asset Masuk')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 h-screen px-4">
        <h2 class="text-center font-bold text-3xl">ASSET MASUK</h2>



        <div class="mt-10">
            @session('success_added_asset_masuk')
                <div id="alert-border-success"
                    class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success_added_asset_masuk') }}
                    </div>
                </div>
            @endsession

            @session('success_updated_asset_masuk')
                <div id="alert-border-success"
                    class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success_updated_asset_masuk') }}
                    </div>
                </div>
            @endsession


            @if (Auth::user()->role !== 'MANAGER')
                <a type="submit" href="{{ route('assetmasuk.create') }}"
                    class="text-white mt-10 w-48 block  bg-secondary-color cursor-pointer  focus:ring-4 focus:outline-none focus:ring-green-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">+
                    TAMBAH ASSET MASUK</a>
            @endif


            @if (count($asset_masuk) > 0)
                <table class="table-auto w-full text-center border-collapse border border-slate-500 mt-4">
                    <thead>
                        <tr>
                            <th class="border border-slate-600">No</th>
                            <th class="border border-slate-600">Kode </th>
                            <th class="border border-slate-600">Tanggal </th>
                            <th class="border border-slate-600">Nama Asset</th>
                            <th class="border border-slate-600">QTY</th>
                            <th class="border border-slate-600">Harga Satuan</th>
                            <th class="border border-slate-600">Harga Total</th>
                            <th class="border border-slate-600">Status</th>
                            <th class="border border-slate-600">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asset_masuk as $assetmasuk)
                            <tr>
                                <td class="border border-slate-600">{{ $loop->iteration }}</td>
                                <td class="border border-slate-600">{{ $assetmasuk->kodemasuk }}</td>
                                <td class="border border-slate-600">{{ $assetmasuk->tanggal }}</td>
                                <td class="border border-slate-600">{{ $assetmasuk->asset->namaasset }}</td>
                                <td class="border border-slate-600">{{ $assetmasuk->qty }}</td>
                                <td class="border border-slate-600">
                                    Rp.{{ number_format($assetmasuk->asset->hrgbeli) }}
                                </td>
                                <td class="border border-slate-600 ">
                                    Rp. {{ number_format($assetmasuk->hrgtotal) }}
                                </td>
                                <td
                                    class="border border-slate-600 @if ($assetmasuk->statusmasuk === 'APPROVED') text-green-500 font-bold @else text-red-500 font-bold @endif ">
                                    {{ $assetmasuk->statusmasuk }}
                                </td>
                                <td class="border border-slate-600 ">
                                    @if (Auth::user()->role !== 'MANAGER')
                                        <a href="{{ route('assetmasuk.edit', $assetmasuk->id) }}"
                                            class="text-yellow-300 font-bold">E</a>
                                    @endif

                                    @if (Auth::user()->role === 'MANAGER' || Auth::user()->role === 'ADMIN')
                                        @if ($assetmasuk->statusmasuk === 'PROCESS')
                                            <form action="{{ route('approve_assetmasuk', $assetmasuk->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="text-blue-400 font-bold"
                                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui data asset masuk: {{ $assetmasuk->asset->namaasset }} ini?')">A</button>
                                            </form>
                                        @endif
                                    @endif

                                    @if (Auth::user()->role !== 'MANAGER')
                                        <form action="{{ route('assetmasuk.destroy', $assetmasuk->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 font-bold"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data asset masuk: {{ $assetmasuk->asset->namaasset }} ini?')">X</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <h1 class="mt-10">Data Asset masuk tidak ada...</h1>
            @endif

        </div>

    </div>

    <script>
        const alert = document.getElementById('alert-border-success');
        setTimeout(() => {
            alert.style.display = 'none';
        }, 3000);
    </script>
@endsection
