@extends('welcome')

@section('input')
<div class="w-full max-w-xl pt-16">
  <form class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-3" id="form" method="POST" action="/DNSLookUp/checkDNS">
    @if (count($errors) > 0)
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error_input)
                                        <li>{{ $error_input }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
    <div class="m-4">
      <table>
        <tr>
          <td class="w-full">
            <input type="hidden" name="_token" value="  {{ csrf_token() }}">
            <input class="shadow appearance-none border rounded w-11/12 mx-3 py-2 px-2 text-gray-700 leading-normal focus:outline-none focus:shadow-outline"
    id="input_dns" type="text" placeholder="Domain Names . . ." name="domain" value="{{old('domain')}}">
          </td>
          <td>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline" type="submit">
             Search
            </button>
          </td>
        </tr>
      </table>
    </div>
  </form>
  <!-- <p class="text-center text-gray-500 text-xs">
    &copy;2020 Acme Corp. All rights reserved.
  </p> -->
</div>
@endsection



