<html>
    <head>
        @vite('resources/css/app.css')
       
    </head>
    <body>
        <form action="{{ route('Register')}}" method="post">
        @csrf
         <div class="justify-self-center mt-15 shadow-2xl h-128 w-128 rounded-4xl">
                <h1 class='text-4xl font-bold justify-self-center pt-5'>Register</h1>
                <div class="justify-self-center items-center justify-items-center pt-10 flex">
                    <input name="username" type="text" class="text-xl w-64 border border-black rounded-2xl p-2 pl-10" placeholder="Email">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 absolute mr-10  text-gray-400 pl-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>

                </div>
                 <div class="justify-self-center items-center justify-items-center pt-4 flex">
                    <input name="email" type="text" class="text-xl w-64 border border-black rounded-2xl p-2 pl-10" placeholder="Email">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 absolute mr-10  text-gray-400 pl-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>

                </div>
               <div class="justify-self-center items-center justify-items-center pt-4 flex">
                    <input name="password" type="password" class="text-xl w-64 border border-black rounded-2xl p-2 pl-10" placeholder="Password">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 absolute mr-10  text-gray-400 pl-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                    </svg>

                    
                </div>
                    
                
                
                <div class="justify-self-center pt-7">
                    <button type="submit" class="text-xl p-2 border border-black text-white bg-black rounded-2xl">Proceed</button>
                </div>
                <div class="pt-7 justify-self-center">
                    <p>Have An Account?</p>
                </div>
                <div class="justify-self-center">
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
        </div>
        </form>
    </body>
</html>