<html>
    <head>
         <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
         @vite('resources/css/app.css')
         <div class="md:shadow-2xl/10 shadow-2xs bg-white" x-data="{open : false}">
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
                            <li class="hidden text-sm md:text-xl sm:block">Register</li>
                            <li class="hidden text-xl pl-5 md:pr-5 sm:block">Login</li>
                         @else
                            <li class="hidden text-sm md:text-xl sm:block">My Account</li>
                        @endif
                    </ul>  
                </div>     
            </div>
        <div x-show="open" class="pl-2">
            @if(!Auth::user())
                <a href=""><h1 class="pt-3 border-b border-gray-200">Register</h1></a>
                <a href=""><h1>Login</h1></a>
            @else
                <a href=""><h1 class="pt-3 border-b border-gray-200">My Account</h1></a>
            @endif
         </div>
        </div>
    </head>
    <body>
        
    </body>
</html>