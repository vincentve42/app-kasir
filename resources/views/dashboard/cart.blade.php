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

    <body x-data="{open : false, gg : true, carts : true}">
            
        
      <div class="flex sm:hidden justify-between items-center justify-items-center" >
      <div>
        <button @click="open = !open; gg = !gg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="size-10 pl-2">
        <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        </button>
      </div>
      <div>
        
        
         <button @click="carts = !carts; gg = !gg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-black">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
      </svg>
      </button>
          
           

        

      </div>
    </div>
      <div class="" x-show="open">
            <ul>
                <a href="{{ route('Dashboard') }}"><li class="pt-2 pl-3 border-b border-gray-300">Dashboard</li></a>
                <a href="{{ route('ProductUi') }}"><li class="pt-2 pl-3 border-b border-gray-300">Product</li></a>
                <a href="{{ route('SalesUi') }}"><li class="pt-2 pl-3 border-b border-gray-300">Sales</li></a>
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
      
      
       <div class="shadow-xl mr-15 ml-10 w-96 rounded-4xl mt-5 hidden md:block">
          <h1 class="text-xl font-bold text-center">Your Cart</h1>
          
          <div class="pt-10">
            <table>
          
            
           @if(session('cart'))
          <input type="hidden" name="" value="{{ $harga = 0 }}">
              @foreach(session('cart') as $id => $details)
              <input type="hidden" name="" value="{{ $harga += $details['price'] }}">
              <tr class="border-b border-gray-100 pt-2">
              <th class="pl-3"><img src="{{ asset($details['photo']) }}" alt="" class="w-16 h-16 justify-self-center rounded-full items-center justify-items-center"></th>
                <th class="pl-5 font-bold items-center justify-items-center text-left">{{ $details['name'] }}</h1>
                <th class="pl-5 font-bold items-center justify-items-center text-left">{{ $details['quantity'] }}</h1>
                <th class="pl-5 font-bold items-center justify-items-center text-left">Rp.{{   number_format($details['price'],2,",",".") }}</h1>
              </tr>
            
        @endforeach
        
        </table>

       
        <div class="justify-self-end font-bold pt-5 pr-4">
          <h1>Total : Rp.{{ number_format($harga,2,',','.') }}</h1>
        </div>
        <div>
          <a href="{{ route('ClearCart') }}"><h1 class="pl-5 text-red-400 font-bold">Clear Cart</h1></a>
        </div>
        <div class="justify-self-center">
          <a href="{{ route('PlaceOrder') }}"><button class=" mt-10 mb-5 p-3 font-bold text-green-400 rounded-3xl bg-green-50">Place an Order</button></a>
        </div>

        @else
            <h1 class="justify-self-center pt-30 pb-30 ">No Product in Cart</h1>
        @endif
        
      </div>
      </div>
    
    <div x-show="carts" class="justify-self-center shadow-xl mr-15 ml-10 w-96 rounded-4xl mt-5  ">
              <h1 class="text-xl font-bold text-center">Your Cart</h1>
              
              <div class="pt-10">
                <table>
              
                
              @if(session('cart'))
              <input type="hidden" name="" value="{{ $harga = 0 }}">
                  @foreach(session('cart') as $id => $details)
                  <input type="hidden" name="" value="{{ $harga += $details['price'] }}">
                  <tr class="border-b border-gray-100 pt-2">
                  <th class="pl-3"><img src="{{ asset($details['photo']) }}" alt="" class="w-16 h-16 justify-self-center rounded-full items-center justify-items-center"></th>
                    <th class="pl-5 font-bold items-center justify-items-center text-left">{{ $details['name'] }}</h1>
                    <th class="pl-5 font-bold items-center justify-items-center text-left">{{ $details['quantity'] }}</h1>
                    <th class="pl-5 font-bold items-center justify-items-center text-left">Rp.{{   number_format($details['price'],2,",",".") }}</h1>
                  </tr>
                
            @endforeach
            
            </table>

            </div>
            <div class="justify-self-end font-bold pt-5 pr-4">
              <h1>Total : Rp.{{ number_format($harga,2,',','.') }}</h1>
            </div>
            <div>
              <a href="{{ route('ClearCart') }}"><h1 class="pl-5 text-red-400 font-bold">Clear Cart</h1></a>
            </div>
            <div class="justify-self-center">
              <a href="{{ route('PlaceOrder') }}"><button class=" mt-10 mb-5 p-3 font-bold text-green-400 rounded-3xl bg-green-50">Place an Order</button></a>
            </div>

            @else
                <h1 class="justify-self-center pt-30 pb-30 ">No Product in Cart</h1>
            @endif
            
          </div>
          </div>

          </body>
  
    </html>