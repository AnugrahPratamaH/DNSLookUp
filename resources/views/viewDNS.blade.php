@extends('main')

@section('view')

    <div class="w-10/12">
        <div class="bg-blue-200 rounded-md px-8 pt-6 pb-8 mb-4">
            <div class="m-2">
                <p class="text-red-700 font-bold text-2xl mb-2">Matamerah.com</p>
                <button class="bg-white hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    Whois
                </button>
                <button class="bg-white hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    DNS Records
                </button>
                <button class="bg-white hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    Diagnostics
                </button>
            </div>
        </div>
        <p class="text-center text-gray-500 text-xs">
            &copy;2020 Acme Corp. All rights reserved.
        </p>
    </div>

@endsection