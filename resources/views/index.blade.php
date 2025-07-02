<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

         @php
    $isProduction = app()->environment('production');
    $manifestPath = $isProduction ? '../kasir.vecode.my.id/build/manifest.json' : public_path('build/manifest.json');
 @endphp
 
  @if ($isProduction && file_exists($manifestPath))
   @php
    $manifest = json_decode(file_get_contents($manifestPath), true);
   @endphp
    <link rel="stylesheet" href="{{ config('app.url') }}/build/{{ $manifest['resources/css/app.css']['file'] }}">
    <script type="module" src="{{ config('app.url') }}/build/{{ $manifest['resources/js/app.js']['file'] }}"></script>
  @else
    @viteReactRefresh
    @vite(['resources/js/app.js', 'resources/css/app.css'])
  @endif
 
         <div class="md:shadow-xl/2 shadow-2xs bg-white" x-data="{open : false}">
            <div class="flex justify-between">
                 <div class="flex md:hidden items-center justify-items-center ">
                    <button @click="open = !open" class="pl-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                    </button>
                    
                </div>
                <h1 class="font-bold md:text-4xl md:p-5 p-3">AkuKasir.com</h1>
                <div class="flex items-center justify-items-center">
                    <ul class="flex justify-between">
                        @if(!Auth::user())
                            <a href="{{ route('RegisterUi') }}"><li class="hidden text-sm md:text-xl sm:block">Register</li></a>
                             <a href="{{ route('LoginUi') }}"><li class="hidden text-xl pl-5 md:pr-5 sm:block">Login</li></a>
                         @else
                            <a href="{{ route('Dashboard') }}"><li class="hidden text-xl pl-5 md:pr-5 sm:block">My Account</li></a>
                        @endif
                    </ul>  
                </div>     
            </div>
        <div x-show="open" class="pl-2">
            @if(!Auth::user())
                <a href="{{ route('RegisterUi') }}"><h1 class="pt-3 border-b border-gray-200">Register</h1></a>
                <a href="{{ route('RegisterUi') }}"><h1>Login</h1></a>
            @else
                <a href="{{ route('Dashboard') }}"><h1 class="pt-3 border-b border-gray-200">My Account</h1></a>
            @endif
         </div>
        </div>
    </head>
    <body class="">
        <div class="flex mt-40">
            <div>
        <h1 class="font-bold text-4xl mt-10 ml-10">AkuKasir.com</h1>
        <p class="ml-10 mt-5 text-xl">Sebuah platform dimana setiap pengguna dapat menjalankan aplikasi dengan aman, nyaman dan ringan </p>
        <div class="ml-10 mt-10">
        <a href="{{ route('LoginUi') }}"><button class="text-2xl border border-black rounded-4xl p-3">Cobain Sekarang!</button></a>
        </div>
        </div>
        
            <img src="{{ asset("asset/kasir.png") }}" alt="" class="mt-10 ml-50  w-128 h-96 items-center justify-items-center">
        
        </div>
    </body>
</html>