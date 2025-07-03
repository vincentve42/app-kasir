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
 
      
      <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
     <body x-data="{open : false}">
            
        
      <div class="flex sm:hidden justify-between items-center justify-items-center" >
      <div>
        <button @click="open = !open">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="size-10 pl-2">
        <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        </button>
      </div>
      <div>
        
        

      </div>
    </div>
      <div class="" x-show="open">
            <ul>
                <a href="{{ route('Dashboard') }}"><li class="pt-2 pl-3 border-b border-gray-300">Dashboard</li></a>
                <a href="{{ route('ProductUi') }}"><li class="pt-2 pl-3 border-b border-gray-300">Product</li></a>
                <a href="{{ route('SalesUi')  }}"><li class="pt-2 pl-3 border-b border-gray-300">Sales</li></a>
                <a href="{{ route('CashierUi')  }}"><li class="pt-2 pl-3 border-b border-gray-300">Kasir</li></a>
                
            </ul>
      </div>
      <div class="fixed pt-8 top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-gray-50">
    
        <ul>
          <li class="text-2xl justify-self-center font-bold">AkuKasir.com</li>
          <a href="{{ route('Dashboard') }}"><li class="justify-self-center pt-3"><img src="{{ asset("asset/logo.png")  }}" alt="" class="w-32"></li></a>
          <a href="{{ route('Dashboard') }}"><li class="pl-10 pt-5 text-xl font-bold">Dashboard</li></a>
          <a href="{{ route('ProductUi')  }}"><li class="pl-10 pt-5 text-xl font-bold">Product</li></a>
          <a href="{{ route('SalesUi')  }}"><li class="pl-10 pt-5 text-xl font-bold">Sales</li></a>
          <a href="{{ route('CashierUi')  }}"><li class="pl-10 pt-5 text-xl font-bold">Kasir</li></a>
          
        </ul>
      </div>
      <div class="p-6 ">
        <div id="judul">
          <h1 class="text-2xl font-bold">Dashboard</h1>
        </div>
        <div class="grid sm:grid-cols-4 gap-3 grid-cols-2 justify-self-center sm:pt-10">
            <div class="shadow-xl sm:w-64 sm:h-64">
                <h1 class="text-xl p-5 font-bold justify-self-center">Product</h1>
                <div class="pt-5 justify-self-center rounded-full bg-yellow-100 w-16 h-16">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 justify-self-center text-yellow-700">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>

                </div>
                <div class="pt-10 justify-self-center">
                    <h1 class="font-bold text-xl">{{ $bro['productcount'] }}</h1>
                </div>
                <div class="pt-1 justify-self-center">
                    <h1 class="text-gray-300">Registered</h1>
                </div>
            </div>
            <div class="shadow-xl sm:w-64  sm:h-64">
                <h1 class="text-xl p-5 font-bold justify-self-center sm:text-xs">Omset</h1>
                <div class="pt-5 justify-self-center rounded-full bg-green-100 w-16 h-16">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 justify-self-center">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
              </svg>


                </div>
                <div class="pt-10 justify-self-center">
                    <h1 class="font-bold text-xl">Rp.{{ number_format($bro['total'], 2,',','.') }}</h1>
                </div>
                <div class="pt-1 justify-self-center">
                    <h1 class="text-gray-300">Terjual</h1>
                </div>
            </div>
            <div class="shadow-xl sm:w-64  sm:h-64">
                <h1 class="text-xl p-5 font-bold sm:text-sm justify-self-center">Top 1 Product</h1>
                <div class="pt-5 justify-self-center rounded-full bg-red-100 w-16 h-16">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 justify-self-center text-red-700">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
</svg>


                </div>
                <div class="pt-10 justify-self-center">
                    <h1 class="font-bold text-xl">{{ $bro['most_sold'] }}</h1>
                </div>
                <div class="pt-1 justify-self-center">
                    <h1 class="text-gray-300">Product</h1>
                </div>
            </div>
            <div class="shadow-xl sm:w-64  sm:h-64">
                <h1 class="text-xl p-5 font-bold justify-self-center">Solds</h1>
                <div class="pt-5 justify-self-center rounded-full bg-indigo-100 w-16 h-16">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 justify-self-center text-indigo-700">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
</svg>


                </div>
                <div class="pt-10 justify-self-center sm:text-sm">
                    <h1 class="font-bold text-xl">{{ $bro['totals'] }}</h1>
                </div>
                <div class="pt-1 justify-self-center">
                    <h1 class="text-gray-300">Terjual</h1>
                </div>
            </div>
            
            </div>
            
        </div>
        <div class="flex justify-center">
          
          <div class="p-5 text-xl sm:mt-30 sm:ml-20 w-156 sm:w-156 shadow-xl sm:h-100">
              <h1 class="justify-self-center">Most Product Sold</h1>
              <div class="pt-10">
               <x-chartjs-component :chart="$chart" />
              </div>
          </div>
        </div>
      </div>
      <script>
        
       
      </script>
    </body>
</html>