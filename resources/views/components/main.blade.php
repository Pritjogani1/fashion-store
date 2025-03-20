<body class="bg-gray-100 text-gray-900 ">
    <!-- Hero Section -->
    <section class="relative w-full h-screen bg-cover bg-center" style="background-image: url('https://www.shutterstock.com/image-photo/modern-fashion-store-front-downtown-600nw-2215294089.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white text-center">
            <h1 class="text-6xl font-extrabold drop-shadow-lg">Discover Your Unique Style</h1>
            <p class="text-lg mt-4 max-w-3xl">"Fashion is the art of self-expression. Wear what makes you feel confident and alive."</p>
            <a href="#collections" class="mt-6 px-8 py-4 bg-white text-gray-900 font-semibold rounded-full shadow-md hover:bg-gray-200 transition">Shop Now</a>
        </div>
    </section>

    



    <!-- Trending Collections -->
    <section id="collections" class="py-16 px-6 text-center">
        <h2 class="text-5xl font-bold">Trending Collections</h2>
        <p class="mt-4 text-lg max-w-2xl mx-auto">Explore the latest fashion trends that redefine elegance and style.</p>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative group overflow-hidden rounded-lg shadow-lg">
                <img src="{{Vite::asset('resources/images/men.jpg')}}" alt="Fashion Collection" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                    <a href="{{ route('men') }}" class="px-6 py-3 bg-white text-gray-900 font-semibold rounded-full shadow-md">View Collection</a>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-lg shadow-lg">
                <img src="{{Vite::asset('resources/images/women.jpeg')}}" alt="Fashion Collection" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                    <a href="{{ route('women') }}" class="px-6 py-3 bg-white text-gray-900 font-semibold rounded-full shadow-md">View Collection</a>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-lg shadow-lg">
                <img src="{{Vite::asset('resources/images/child.jpeg')}}" alt="Fashion Collection" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                    <a href="{{ route('children') }}" class="px-6 py-3 bg-white text-gray-900 font-semibold rounded-full shadow-md">View Collection</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Fashion Inspiration Section -->
    <section class="py-16 bg-gray-200 text-center">
        <h2 class="text-5xl font-bold">Fashion Inspiration</h2>
        <p class="mt-4 text-lg max-w-2xl mx-auto">"Style is something each of us already has, all we need to do is find it." – Diane von Furstenberg</p>
        <div class="mt-12 flex flex-wrap justify-center gap-8">
            <img src="{{Vite::asset('resources/images/inspiration1.jpeg')}}" class="rounded-lg shadow-md w-80">
            <img src="{{Vite::asset('resources/images/inspiration2.jpg')}}" class="rounded-lg shadow-md w-80">

        </div>
    </section>



</body>