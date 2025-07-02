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
      
        <div class="sm:mt-10 sm:ml-70 sm:w-390 sm:h-200 w-145 h-64 mt-3 ml-5 shadow-xl">
            <form action="{{ route('DeleteProduct', ['id' => $selected_product->id ]) }}" method="post">
                @csrf
            <h1 class="justify-self-center md:text-4xl font-bold text-2xl">Delete Product</h1>
            <h1 class="justify-self-center md:pt-10 pt-5 md:text-2xl text-base">Anda yakin untuk menghapus produk {{ $selected_product->judul }}</h1>
            <input type="hidden" name="id" value="{{ $selected_product->id }}">
            <div class="flex justify-center">
                <div class="md:p-5 p-5">
                    <button type="submit" class="rounded-4xl text-green-500 border border-green-400 text-2xl p-3 w-32">Ya</button>
                </div>
                <div class="md:p-5 p-5">
                     <button class="rounded-4xl text-red-500 border border-red-400 text-2xl p-3 w-32">Tidak</button>
                </div>
            </div>
        </form>
        </div>
   
   </body>
</html>