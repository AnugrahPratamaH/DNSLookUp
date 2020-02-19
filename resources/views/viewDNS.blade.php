@extends('main')

@section('view')

    <div class="w-4/5 mt-3">
        <div class="bg-blue-200 rounded-md px-8 pt-6 pb-8 mb-5">
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
        <table class="w-full border-2 rounded-xl">
            <thead >
                <tr class="bg-gray-500">
                    <th class="px-4 py-2 text-left text-xl">DNS Records for matamerah.com</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr class="bg-gray-300">
                    <th class="px-4 py-2">Host Name</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">TTL</th>
                    <th class="px-4 py-2">Priority</th>
                    <th class="px-4 py-2">Content</th>
                </tr>
            </thead>
            <tbody class="bg-gray-300">
                <tr>
                    <td class="border px-4 py-2">matamerah.com</td>
                    <td class="border px-4 py-2">SOA</td>
                    <td class="border px-4 py-2">3599</td>
                    <td class="border px-4 py-2">23</td>
                    <td class="border px-4 py-2">coco.ns.cloudflare.com dns@cloudflare.com 2033321517 10000 2400 604800 3600</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">matamerah.com</td>
                    <td class="border px-4 py-2">NS</td>
                    <td class="border px-4 py-2">121599</td>
                    <td class="border px-4 py-2">44</td>
                    <td class="border px-4 py-2">coco.ns.cloudflare.com</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">matamerah.com</td>
                    <td class="border px-4 py-2">NS</td>
                    <td class="border px-4 py-2">21599</td>
                    <td class="border px-4 py-2">30</td>
                    <td class="border px-4 py-2">coco.ns.cloudflare.com</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">matamerah.com</td>
                    <td class="border px-4 py-2">NS</td>
                    <td class="border px-4 py-2">21599</td>
                    <td class="border px-4 py-2">40</td>
                    <td class="border px-4 py-2">2606:4700:3031::6812:2703</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">matamerah.com</td>
                    <td class="border px-4 py-2">NS</td>
                    <td class="border px-4 py-2">21599</td>
                    <td class="border px-4 py-2">30</td>
                    <td class="border px-4 py-2">2606:4700:3031::6812:2703</td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection