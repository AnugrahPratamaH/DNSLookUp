@extends('welcome')

@section('input')
<div class="w-full max-w-xl">
  <form class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4" id="form" method="post" action="#" >
    <div class="m-4">
      <input class="shadow appearance-none border rounded w-9/12 mx-3 py-2 px-2 text-gray-700 leading-normal focus:outline-none focus:shadow-outline" id="input_dns" type="text" placeholder="Domain Names or IP Address. . .">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-md focus:outline-none focus:shadow-outline" type="button">
        Search
      </button>
    </div>
  </form>
  <!-- <p class="text-center text-gray-500 text-xs">
    &copy;2020 Acme Corp. All rights reserved.
  </p> -->
</div>

<script>
    $(document).ready(function() {
        $.validator.addMethod('validUrl', function(value, element) {
            var url = $.validator.methods.url.bind(this);
            return url(value, element) || url('http://' + value, element);
        }, 'Please enter a valid URL');

        $("#form").validate({
            rules: {
                "url": {
                    validUrl: true // <-- change this
                }
            },
            submitHandler: function(form) {
                alert('valid form submitted'); // for demo
                return false; // for demo
            }
        });
    });
</script>
@endsection



