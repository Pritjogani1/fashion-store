<x-layout>
<section class="bg-gray-100 py-16 px-6">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Image Section -->
        <div>
            <img src="{{Vite::asset('resources/images/fashionstore.jpeg')}}" alt="Fashion Store" class="rounded-lg shadow-lg w-full">
        </div>
        
        
        <!-- Introduction Section -->
        <div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">About FashionStore</h2>
            <p class="text-gray-600 text-lg">FashionStore is your premier destination for the latest fashion trends, offering exclusive collections and timeless styles. Our mission is to empower individuals through fashion, making luxury and comfort accessible to everyone.</p>
            <p class="mt-4 text-gray-600 text-lg">We believe that fashion is more than clothing; it's an expression of personality, confidence, and culture. Our designs are inspired by the latest global trends, crafted with passion, and tailored for perfection.</p>
            <blockquote class="mt-6 text-lg italic text-pink-600 font-semibold">“Fashion is the armor to survive the reality of everyday life.” – Bill Cunningham</blockquote>
        </div>
    </div>
    
    <!-- Our Mission Section -->
    <div class="mt-16 text-center max-w-4xl mx-auto">
        <h3 class="text-3xl font-bold text-gray-900">Our Mission</h3>
        <p class="mt-4 text-gray-600 text-lg">To redefine fashion by blending style, comfort, and sustainability. We strive to inspire confidence and self-expression through carefully curated fashion that speaks to every individual’s unique style.</p>
        <blockquote class="mt-6 text-lg italic text-pink-600 font-semibold">“Style is a way to say who you are without having to speak.” – Rachel Zoe</blockquote>
    </div>
    
    <!-- Why Choose Us -->
    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-center max-w-7xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h4 class="text-xl font-semibold text-gray-900">Exclusive Designs</h4>
            <p class="text-gray-600 mt-2">Our pieces are crafted to stand out, ensuring you always make a statement.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h4 class="text-xl font-semibold text-gray-900">Premium Quality</h4>
            <p class="text-gray-600 mt-2">We use the finest materials to ensure comfort, durability, and luxury.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h4 class="text-xl font-semibold text-gray-900">Sustainability</h4>
            <p class="text-gray-600 mt-2">Committed to eco-friendly practices, we make fashion with a purpose.</p>
        </div>
    </div>
</section>
</x-layout>
