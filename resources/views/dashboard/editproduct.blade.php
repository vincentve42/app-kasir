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
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <ul>
          <li class="text-2xl justify-self-center font-bold">AkuKasir.com</li>
          <a href="{{ route('Dashboard') }}"><li class="justify-self-center pt-3"><img src="{{ asset("asset/logo.png")  }}" alt="" class="w-32"></li></a>
          <a href="{{ route('Dashboard') }}"><li class="pl-10 pt-5 text-xl font-bold">Dashboard</li></a>
          <a href="{{ route('ProductUi')  }}"><li class="pl-10 pt-5 text-xl font-bold">Product</li></a>
          <a href="{{ route('SalesUi')  }}"><li class="pl-10 pt-5 text-xl font-bold">Sales</li></a>
          <a href="{{ route('CashierUi')  }}"><li class="pl-10 pt-5 text-xl font-bold">Kasir</li></a>
          
        </ul>
      </div>
      <div class="fixed pt-8 top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-gray-50">
    
        <ul>
          <li class="text-2xl justify-self-center font-bold">AkuKasir.com</li>
          <li class="justify-self-center pt-3"><img src="{{ asset("asset/logo.png")  }}" alt="" class="w-32"></li>
          <li class="pl-10 pt-5 text-xl font-bold">Dashboard</li>
          <li class="pl-10 pt-5 text-xl font-bold">Product</li>
          <li class="pl-10 pt-5 text-xl font-bold">Sales</li>
          <li class="pl-10 pt-5 text-xl font-bold">Settings</li>
        </ul>
      </div>
    <div class="p-6 sm:ml-64 " x-data="{productopen : true, addproduct : false, productbutton : true}">
        <div class="flex sm:justify-between">
            <h1 class="pl-3 sm:text-2xl sm:font-bold">Product List</h1>
            
            
        </div>
        <div class="pt-5">
            <div class="flex justify-end">
                <input type="text" placeholder="Search" class="border-b border-gray-300">
            </div>
        </div>
        
        <div class="sm:mt-10 sm:w-390 sm:h-200 shadow-xl mt-5">
            
            <form x-show="addproduct" action="{{ route('AddProduct') }}" method="post">
                @csrf
                <h1 class="p-6 font-bold text-xl">Add Product</h1>
                <div class="pl-6 pt-2">
                    <input type="text" name="judul" placeholder="Judul" class="border-b border-black text-xl  ">
                </div>
                   <div class="pl-6 pt-5">
                    <input type="text" name="image" placeholder="Link Image" class="border-b border-black text-xl ">
                </div>
                    <div class="pl-6 pt-5">
                    <input type="number" name='price' placeholder="Price" class="border-b border-black text-xl ">
                    <div class="pl-1 pt-5">
                        <button  @click="productopen = !productopen; addproduct = !addproduct; productbutton = !productbutton" type="submit" class="border rounded-2xl border-black p-2">Proceed</button>
                    </div>
                </div>

                
            </form>
            <div class="md:flex md:justify-between">
            <form x-show="productopen" class="md:ml-15 ml-5" action=""> 
                
            <table>
            <tr class="border-b border-gray-300 mt-4">
                <th class="md:p-5 sm:p-1 md:text-base text-xs">Id Produk</th>
                <th class="md:p-5 p-1 md:text-base text-xs">Nama Produk</th>
                <th class="md:p-5 p-1 md:text-base text-xs">Gambar Produk</th>
                <th class="md:p-5 p-1 md:text-base text-xs ">Harga Produk</th>
                <th class="md:p-5 p-1 md:text-base text-xs">
                    
                </th>
                <th class="p-5">
                    
                </th>
            </tr>
           
    
            <tr class="p-3 border-b border-gray-300">
                <td class="text-center">{{$single_product->id}}</td>
                <td class="p-1 text-center md:text-xs">{{ $single_product->judul }}</td>
                <td class="p-1 text-center md:text-xs"><img src="{{asset($single_product->image)}}" alt="" class="text-center w-14 h-14 md:w-32 md:h-32  justify-self-center"></td>
                <td class="p-1 text-left">Rp.{{ number_format("$single_product->price",2,",",".") }}</td>
                <td class="p-1 text-center pr-2"><a href="{{ route('DeleteConfirm', ['id' => $single_product->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-center text-red-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg></a>
                </td>
                <td class="p-1 pr-2 text-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                </td>
            </tr>
            </div>
            </table>
            
            </form>
            <form action="{{ route('EditProduct', ['id' => $single_product->id]) }}" enctype="multipart/form-data" class="md:border-l md:border-gray-300 md:pl-20 pl-5 md:mr-85 md:mt-0 mt-20" method="post">
                
                @csrf
                 <h1 class="md:p-6 md:text-base text-xs p-3 font-bold">Edit Product</h1>
                <div class="pl-6 pt-2">
                    <input type="text" name="judul" placeholder="Judul" class="border-b border-black w-100">
                </div>
                   <div class="ml-6 mt-5  bg-gray-50 rounded-4xl sm:w-72 w-72">
                    <input type="file" name="image" placeholder="Link Image" class="text-center justify-self-center items-center justify-items-center md:p-10 p-10 font-bold">
                </div>
                    <div class="pl-6 pt-10">
                    <input type="number" name='price' placeholder="Price" class="border-b border-black">
                    <div class="pl-1 pt-10 pb-5">
                        <button type="submit" class="border rounded-2xl border-black p-2">Proceed</button>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </div>
            </form>
            </div>
        </div>
   
   </body>
</html>