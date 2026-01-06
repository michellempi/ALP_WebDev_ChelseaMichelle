<footer class="bg-white border-t border-gray-100 mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-8">

            <!-- Logo & Description -->
            <div>
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img
                        src="https://raw.githubusercontent.com/Grcllch02/Aset-AFL-3-Webprog/refs/heads/main/MEGARIA%20SPORT%20LOGO.png"
                        class="h-10 w-auto"
                        alt="Megaria Sport Logo"
                    >
                </a>
                <p class="mt-4 text-sm text-gray-600 max-w-sm">
                    Megaria Sport menyediakan perlengkapan olahraga berkualitas
                    untuk mendukung performa terbaik Anda.
                </p>
            </div>

            <!-- Footer Navigation -->
            <div class="grid grid-cols-2 gap-8 sm:grid-cols-3">
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 tracking-wide uppercase">
                        Menu
                    </h3>
                    <ul class="mt-4 space-y-3">
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('catalogue.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Catalogue
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('carts.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Cart
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-900 tracking-wide uppercase">
                        Account
                    </h3>
                    <ul class="mt-4 space-y-3">
                        <li>
                            <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Orders
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('address-books.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Addresses
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Profile
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-900 tracking-wide uppercase">
                        Support
                    </h3>
                    <ul class="mt-4 space-y-3">
                        <li class="text-sm text-gray-600">
                            Instagram: @megaria.sport
                        </li>
                        <li class="text-sm text-gray-600">
                            Email: support@megariasport.com
                        </li>
                        <li class="text-sm text-gray-600">
                            Phone: +62 812 3456 7890
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <p class="text-center text-sm text-gray-500">
                © {{ date('Y') }} Megaria Sport. All rights reserved.
            </p>
        </div>
    </div>
</footer>
