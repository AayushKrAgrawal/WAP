<html>
  <head>
    <title>Shop - Hamro Pratibha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  </head>
  <body class="bg-gray-100 text-gray-800">
    <header class="bg-white border-b border-gray-300">
      <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <div class="text-lg font-semibold">
          Hamro Pratibha
        </div>
        <nav class="space-x-4">
          <a class="text-gray-600 hover:text-gray-800" href="#">Home</a>
          <a class="text-gray-600 hover:text-gray-800" href="#">Shop</a>
          <a class="text-gray-600 hover:text-gray-800" href="#">About Us</a>
          <a class="text-gray-600 hover:text-gray-800" href="#">Return and Refund Policy</a>
        </nav>
        <div class="flex items-center space-x-4">
          <a class="text-gray-600 hover:text-gray-800" href="#">
            <i class="fas fa-search"></i> Search
          </a>
          <a class="text-gray-600 hover:text-gray-800" href="#">
            <i class="fas fa-shopping-cart"></i> 3
          </a>
          <a class="text-gray-600 hover:text-gray-800" href="#">
            <i class="fas fa-user"></i> Login
          </a>
        </div>
      </div>
    </header>

    <main class="container mx-auto py-8 px-6">
      <h1 class="text-3xl font-semibold mb-4">Shop</h1>
      <p class="text-gray-600 mb-8">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </p>

      <div class="flex flex-col lg:flex-row">
        <aside class="w-full lg:w-1/4 mb-8 lg:mb-0">
          <h2 class="text-xl font-semibold mb-4">Filters</h2>
          <a class="text-gray-600 hover:text-gray-800 mb-4 inline-block" href="#">Clear filters</a>

          <div class="mb-4">
            <h3 class="text-lg font-semibold mb-2">Categories</h3>
            <div class="space-y-2">
              <label class="flex items-center">
                <input class="form-checkbox" type="checkbox"/>
                <span class="ml-2">Hax</span>
              </label>
              <label class="flex items-center">
                <input class="form-checkbox" type="checkbox"/>
                <span class="ml-2">Kitten</span>
              </label>
              <label class="flex items-center">
                <input class="form-checkbox" type="checkbox"/>
                <span class="ml-2">Caps</span>
              </label>
              <label class="flex items-center">
                <input class="form-checkbox" type="checkbox"/>
                <span class="ml-2">Feed</span>
              </label>
            </div>
          </div>
        </aside>

        <section class="w-full lg:w-3/4">
          <div class="flex justify-between items-center mb-4">
            <div>
              <label class="text-gray-600" for="sort">Sort by:</label>
              <select class="form-select border-gray-300 rounded" id="sort">
                <option>Popular</option>
                <option>Newest</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
              </select>
            </div>
            <div class="text-gray-600">Showing 9003 Products</div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Product 1 -->
            <div class="bg-white p-4 border border-gray-300 rounded cursor-pointer">
              <img alt="Product 1" class="w-full h-48 object-cover mb-4" src="#" />
              <h3 class="text-lg font-semibold">Natural Honey Bottle</h3>
              <p class="text-gray-600">$99</p>
            </div>

            <!-- Product 2 -->
            <div class="bg-white p-4 border border-gray-300 rounded cursor-pointer">
              <img alt="Product 2" class="w-full h-48 object-cover mb-4" src="#" />
              <h3 class="text-lg font-semibold">Itar</h3>
              <p class="text-gray-600">$99</p>
            </div>

            <!-- Product 3 -->
            <div class="bg-white p-4 border border-gray-300 rounded cursor-pointer">
              <img alt="Product 3" class="w-full h-48 object-cover mb-4" src="#" />
              <h3 class="text-lg font-semibold">White Cap</h3>
              <p class="text-gray-600">$99</p>
            </div>

            <!-- Product 4 -->
            <div class="bg-white p-4 border border-gray-300 rounded cursor-pointer">
              <img alt="Product 4" class="w-full h-48 object-cover mb-4" src="#" />
              <h3 class="text-lg font-semibold">Jae Namaz</h3>
              <p class="text-gray-600">$99</p>
            </div>

            <!-- Product 5 -->
            <div class="bg-white p-4 border border-gray-300 rounded cursor-pointer">
              <img alt="Product 5" class="w-full h-48 object-cover mb-4" src="#" />
              <h3 class="text-lg font-semibold">Dates</h3>
              <p class="text-gray-600">$99</p>
            </div>

            <!-- Product 6 -->
            <div class="bg-white p-4 border border-gray-300 rounded cursor-pointer">
              <img alt="Product 6" class="w-full h-48 object-cover mb-4" src="#" />
              <h3 class="text-lg font-semibold">Miswak</h3>
              <p class="text-gray-600">$99</p>
            </div>
          </div>

          <div class="mt-8 text-center">
            <button class="bg-white border border-gray-300 text-gray-600 py-2 px-4 rounded">
              Load more products
            </button>
          </div>
        </section>
      </div>
    </main>

    <footer class="bg-white border-t border-gray-300 py-8">
      <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row justify-between items-center mb-8">
          <div class="mb-4 lg:mb-0">
            <h2 class="text-xl font-semibold mb-2">Sign up to shop with us</h2>
            <p class="text-gray-600 mb-4">Be the first to know about our special offers, news, and updates.</p>
            <div class="flex">
              <input class="form-input border-gray-300 rounded-l py-2 px-4" placeholder="Email Address" type="email" />
              <button class="bg-gray-800 text-white py-2 px-4 rounded-r">Sign Up</button>
            </div>
          </div>
          <div class="flex space-x-8">
            <div>
              <h3 class="text-lg font-semibold mb-2">Lorem Ipsum</h3>
              <ul class="text-gray-600 space-y-1">
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
              </ul>
            </div>
            <div>
              <h3 class="text-lg font-semibold mb-2">Lorem Ipsum</h3>
              <ul class="text-gray-600 space-y-1">
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
              </ul>
            </div>
            <div>
              <h3 class="text-lg font-semibold mb-2">Lorem Ipsum</h3>
              <ul class="text-gray-600 space-y-1">
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
                <li><a class="hover:text-gray-800" href="#">Lorem</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="text-center text-gray-600">
          COPYRIGHTS SITE.COM. ALL RIGHTS RESERVED
        </div>
      </div>
    </footer>
  </body>
</html>
