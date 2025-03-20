<x-layout>
    <body class="bg-gray-100">
        <div class="flex min-h-screen">
            <!-- Left Side - Image -->
            <div class="hidden md:block md:w-1/2 bg-cover bg-center" 
                 style="background-image: url('{{Vite::asset('resources/images/loginpg.jpg')}}')">
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full md:w-1/2 flex items-center justify-center p-6">
                <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h2>
                  

                    <form action="\login" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">Email Address</label> 
                            <input type="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-500" 
                                   placeholder="Enter your email"name="email"  />
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        

                    

                        <div class="mb-4">
                            <label class="block text-gray-700">Password</label>
                            <input type="password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-500" name="password" 
                                   placeholder="Enter your password"  autocomplete="off"/>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror

                        <div class="flex items-center justify-between mb-4">
                            <a href="#" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
                        </div>

                        <button class="w-full bg-black text-white py-3 rounded-lg hover:bg-white hover:border-gray-200 hover:text-black transition duration-300">
                            Login
                        </button>
                    </form>

                    <p class="text-sm text-gray-600 text-center mt-4">
                        Don't have an account? 
                        <a href="#" class="text-blue-500 font-semibold hover:underline">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </body>
    <x-footer></x-footer>
</x-layout>
