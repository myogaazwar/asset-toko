<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Asset Toko')</title>
    @vite('resources/css/app.css')

</head>

<body>
    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-96 h-screen transition-transform -translate-x-full sm:translate-x-0">
        <div class="h-full flex flex-col justify-between pb-8 px-3 text-center pt-10 bg-main-color">
            <div>
                <h1 class="text-4xl font-bold font-serif">APLIKASI ASSET TOKO</h1>
                @auth
                    <div class="mt-10">
                        <h1 class="text-lg font-semibold">Assalamualaikum, @if (Auth::user()->role === 'MANAGER')
                                Manager
                            @endif

                            @if (Auth::user()->role === 'ADMIN')
                                Admin
                            @endif {{ Auth::user()->name }}
                        </h1>


                        <div class="w-full flex flex-col gap-y-5 mt-10">

                            @if (Auth::user()->role !== 'MANAGER')
                                <a href="{{ route('dashboard_index') }}"
                                    class="{{ Route::is('dashboard_index') || Route::is('page_create') || Route::is('page_edit') ? 'bg-slate-700' : '' }} bg-secondary-color text-white w-full py-2 rounded-lg hover:bg-slate-700 transition-all duration-300">Master
                                    Asset</a>
                            @endif

                            <a href="{{ route('assetmasuk.index') }}"
                                class="{{ Route::is('assetmasuk.*') ? 'bg-slate-700' : '' }} bg-secondary-color text-white w-full py-2 rounded-lg hover:bg-slate-700 transition-all duration-300">Asset
                                Masuk</a>
                        </div>
                    </div>
                @endauth
            </div>

            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="mt-10 text-lg w-full bg-red-600 text-white py-2 rounded-lg">Keluar</button>

                </form>
            @endauth
        </div>
    </aside>

    <div class="sm:ml-96 overflow-auto">
        @yield('content')
        <div class="w-full text-center py-5">
            <footer class="footer">
                <p>Copyright © Aplikasi Asset Toko Yoga. All rights reserved.</p>
            </footer>
        </div>
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

</body>



</html>
