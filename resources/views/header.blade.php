<nav id="header" class="bg-gray-900 fixed w-full z-10 top-0 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-3">
        <div class="w-1/2 pl-2 md:pl-0">
            <a class="text-2xl text-red-600 no-underline hover:no-underline font-bold" href="/DNSLookUp/">
              DNScanner
            </a>
        </div>
 
        <div class="flex flex-1 md:w-1/3 justify-end md:justify-start text-white px-2">
            <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                <li class="mr-6 my-2 md:my-0"></li>
                <li class="mr-6 my-2 md:my-0"></li>
                <li class="mr-6 my-2 md:my-0"></li>
                <li class="mr-6 my-2 md:my-0"></li>
                <li class="mr-6 my-2 md:my-0"></li>
            </ul>
            <div class="relative pull-right pl-3 pr-4 md:pr-0">
                <form action="/DNSLookUp/namaDNS" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token()}}">    
                <input type="search" placeholder="Search For Domains..." class="w-full bg-gray-100 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded py-1 px-2 pl-10 appearance-none leading-normal"> 
                    <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">
                        <svg class="fill-current pointer-events-none text-gray-800 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </form>
                    </div> 
            </div>
            <!-- <span class="relative w-full">
                    <input type="search" placeholder="Search" class="w-full bg-gray-800 text-sm text-white transition border border-transparent focus:outline-none focus:border-gray-700 rounded py-1 px-2 pl-10 appearance-none leading-normal">
                    <div class="absolute search-icon" style="top: .5rem; left: .8rem;">
                        <svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </div>
                </span> -->

        </div>

    </div>
</nav>