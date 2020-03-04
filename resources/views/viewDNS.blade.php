@extends('main')

@section('view')

<div class="container w-full mx-auto pt-8">

    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

    <!--Console Content-->

        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="mx-1">
                    <p class="text-red-600 font-bold text-2xl mb-2">{{ $data[0]['domain']}}</p>
                    <a href="/DNSLookUp/lastModify/{{ $data[0]['domain']}}">
                    <button class="bg-white active:bg-blue-700 text white hover:bg-blue-500 text-blue-700 text-sm font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded">
                        Last Modify
                    </button></a>
                    <a href="/DNSLookUp/namaDNS/{{ $data[0]['domain']}}">
                        <button class="bg-white hover:bg-blue-500 text-blue-700 text-sm font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded">
                            Check Now
                        </button>
                    </a>
                </div>
            <!--Metric Card-->
            <!-- <div class="bg-white border rounded shadow p-2">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-green-600"><i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i></div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-gray-500">Total Revenue</h5>
                        <h3 class="font-bold text-3xl">$3249 <span class="text-green-500"><i class="fas fa-caret-up"></i></span></h3>
                    </div>
                </div>
            </div> -->
            <!--/Metric Card-->
            </div>
        
        </div>

    <!--Divider-->
        <hr class="border-b-2 border-gray-400 mt-4 mb-2 mx-1">

        <div class="flex flex-row flex-wrap flex-grow mt-2">


            <div class="w-full py-3 px-1">
            <!--Table Card-->          
                <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">             
                 <thead class="text-white">   
                    @foreach ($data as $item_domain)
                        <tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                            <th class="p-3 text-left">Hostname</th>
                            <th class="p-3 text-left" width="110px">Type</th>
                            <th class="p-3 text-left" width="110px">TTL</th>
                            <th class="p-3 text-left" width="110px">Priority</th>
                            <th class="p-3 text-left" width="110px">Content</th>
                        </tr>                 
                    </thead>
                    @endforeach    
                     <tbody class="flex-1 sm:flex-none">
                        
                        @foreach ($item_domain->records as $item_records)
                            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                                <td class="border-grey-light border hover:bg-gray-100 p-3">{{$item_domain->domain}}</td>
                                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{$item_records->type}}</td>
                                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{$item_records->ttl}}</td>
                                @if ($item_records->priority != 0)
                                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{$item_records->priority}}</td>
                                @else
                                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate"></td>
                                @endif
                                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{$item_records->content}}</td>
                            </tr>
                            @endforeach 
                       
                    </tbody>
                  
                </table>
              
            <!--/table Card-->
            </div>


        </div>

    <!--/ Console Content-->

    </div>

</div>

<style>
  html,
  body {
    height: 100%;
  }

  @media (min-width: 640px) {
    table {
      display: inline-table !important;
    }

    thead tr:not(:first-child) {
      display: none;
    }
  }

  td:not(:last-child) {
    border-bottom: 0;
  }

  th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
  }
</style>

@endsection