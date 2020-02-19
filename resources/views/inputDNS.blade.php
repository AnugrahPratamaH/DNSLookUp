@extends('welcome')

@section('input')
<div class="w-full max-w-xl">
  <form class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4" method="POST" action="/DNSLookUp/namaDNS">
    <div class="m-4">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br>
      @endif
      <input type="hidden" name="_token" value="{{csrf_token() }}">
      <input class="shadow appearance-none border rounded w-9/12 mx-3 py-2 px-2 text-gray-700 leading-normal focus:outline-none focus:shadow-outline" id="input_dns" 
    type="text" placeholder="Domain Names or IP Address. . ." name="domain" value="{{old('domain')}}">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-md focus:outline-none focus:shadow-outline" type="submit">
        Search
      </button>
    </div>
  </form>
  <p class="text-center text-gray-500 text-xs">
    &copy;2020 Acme Corp. All rights reserved.
  </p>
</div>
@endsection