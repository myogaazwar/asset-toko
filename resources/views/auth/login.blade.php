@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="flex flex-col h-screen items-center justify-center w-full">

        <div class="w-full bg-slate-50 max-w-4xl py-10 rounded-md shadow-sm">
            <h2 class="text-center text-2xl">Login</h2>
            <form action="{{ route('login') }}" method="POST"class="max-w-2xl mx-auto w-full">
                @csrf
                <div class="mb-5">
                    <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                    <input type="number" id="nik" name="nik"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-200 focus:border-green-200 block w-full p-2.5 "
                        placeholder="Masukkan NIK" required />
                </div>


                <div class="mb-5">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="password" name="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-200 focus:border-green-200 block w-full p-2.5 "
                        placeholder="Masukkan Password" required />
                </div>

                <div class="text-sm">
                    <p>Belum punya akun? <a class="font-bold hover:text-green-500 transition-all duration-300"
                            href="{{ route('register') }}">Daftar Sekarang</a></p>

                </div>


                <button type="submit"
                    class="text-white mt-10 w-48 flex items-center justify-center mx-auto  bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Login</button>



            </form>

        </div>


    </div>
@endsection
