<x-layout>
    <body class="bg-gray-100">
        <div class="flex min-h-screen">
            <!-- Left Side - Registration Form -->
            <div class="w-full md:w-1/2 flex items-center justify-center p-6">
                <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Fashion Store Registration</h2>
                    
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">Full Name</label>
                            <input type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-500" placeholder="Enter your name" name="name" id="name" />
                        </div>
                        @error('name')
                            <div class="mb-4 text-red-500">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                        <div class="mb-4">
                            <label class="block text-gray-700">Email</label>
                            <input type="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-500" placeholder="Enter your email" name="email" />
                        </div>
                        @error('email')
                            <div class="mb-4 text-red-500">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                        
                        <div class="mb-4">
                            <label class="block text-gray-700">Password</label>
                           <input type="password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-500" placeholder="Enter your password" name="password" id="password" />
                        </div>
                        @error('password')
                            <div class="mb-4 text-red-500">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror

                        <div class="mb-4">
                            <label class="block text-gray-700" for="password_confirmation">Conform password</label>
                            <input type="password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-500" placeholder="Enter your password" name="password_confirmation" id="password_confirmation" />
                        </div>
                        @error('password_confirmation')
                            <div class="mb-4 text-red-500">
                                <p>{{ $message }}</p>
                            </div>              
                            @enderror

                        <div class="mb-4">
                            <label class="block text-gray-700" for="phone number">phone number</label>
                            <input type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-gray-500" placeholder="Enter your phone number" name="phone" id="phone" />

                        </div>
                        @error('phone')
                            <div class="mb-4 text-red-500">
                                <p>{{ $message }}</p>
                            </div>              
                            @enderror

                        
                       
                        
                        <button class="w-full bg-black text-white py-3 rounded-lg hover:bg-white hover:border-gray-200 hover:text-black transition duration-300">
                            Register
                        </button>
                    </form>

                    <!-- Login Link -->
                    <p class="text-sm text-gray-600 text-center mt-4">
                        Already registered? 
                        <a href="#" class="text-blue-500 font-semibold hover:underline">Login</a>
                    </p>
                </div>
            </div>

            <!-- Right Side - Image -->
            <div class="hidden md:block md:w-1/2 bg-cover bg-center" 
                 style="background-image: url('{{Vite::asset('resources/images/registerpg.jpeg')}}')">
            </div>
        </div>
    </body>
    <x-footer></x-footer>
</x-layout>
