<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
 
        
       
    </head>
    <body>
        <form action="{{ route('Login') }}" method="post">
            @csrf
         <div class="justify-self-center mt-15 w-128 h-128 rounded-4xl sm:shadow-xl bg-white">
                <h1 class='text-4xl font-bold justify-self-center pt-5'>Login</h1>
                <div class="justify-self-center items-center justify-items-center pt-10 flex">
                    <input name="email" type="text" class="text-xl w-64 border border-black rounded-2xl p-2 pl-10" placeholder="Email">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 absolute mr-10  text-gray-400 pl-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>

                </div>
               <div class="justify-self-center items-center justify-items-center pt-4 flex">
                    <input name="password" type="text" class="text-xl w-64 border border-black rounded-2xl p-2 pl-10" placeholder="Password">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 absolute mr-10  text-gray-400 pl-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                    </svg>

                    
                </div>
                    
                
                
                <div class="justify-self-center pt-7">
                    <button type="submit" class="text-xl p-2 border border-black text-white bg-black rounded-2xl">Proceed</button>
                </div>
                @if(session('logs'))

                    <div class="text-red justify-self-center">
                        <p>{{ session()->get('logs') }}</p>
                    </div>
                @endif
                <div class="pt-7 justify-self-center mb-10">
                    <a href="{{ route('RegisterUi') }}"><p>Does'nt Have an Account?</p></a>
                    
                </div>
        </div>
        </form>
    </body>
</html>