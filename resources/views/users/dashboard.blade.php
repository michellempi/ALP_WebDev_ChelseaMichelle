{{-- <x-app-layout> --}}
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
{{-- </x-app-layout> --}}

<x-app-layout>
    <div class="bg-slate-50">

        {{-- HERO --}}
        <section class="max-w-7xl mx-auto px-6 py-20">
            <div class="grid md:grid-cols-2 gap-12 items-center">

                {{-- TEXT --}}
                <div>
                    <span class="inline-block bg-yellow-400 text-slate-900 text-sm font-semibold px-4 py-1 rounded-full mb-4">
                        Selamat datang!
                    </span>

                    <h1 class="text-5xl font-extrabold leading-tight text-slate-900">
                        Megaria <br>
                        <span class="text-blue-600">Ragamnya,</span><br>
                        <span class="text-yellow-500">Bahagia Belanjanya</span>
                    </h1>

                    <p class="mt-6 text-lg text-slate-600 max-w-xl">
                        Supplier peralatan olahraga terpercaya untuk toko-toko di Jawa Timur dengan kualitas terjamin dan harga bersahabat.
                    </p>

                    <a href="/katalog"
                       class="inline-block mt-8 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                        Lihat Katalog
                    </a>
                </div>

                {{-- IMAGE --}}
                <div class="relative">
                    <img
                        src="https://github.com/michellempi/AFL3-Webprog/blob/main/toko.jpg?raw=true"
                        alt="Megaria Sport"
                        class="rounded-3xl shadow-2xl"
                    >
                </div>

            </div>
        </section>

        {{-- WHY US --}}
        <section class="bg-blue-700 py-20">
            <div class="max-w-7xl mx-auto px-6 text-center text-white">

                <h2 class="text-3xl font-bold mb-12">
                    Mengapa Memilih <span class="text-yellow-400">Megaria Sport?</span>
                </h2>

                <div class="grid md:grid-cols-3 gap-8">

                    <div class="bg-white/10 backdrop-blur rounded-2xl p-8 hover:-translate-y-2 transition">
                        <h3 class="text-xl font-bold mb-3">Harga Bersahabat</h3>
                        <p class="text-white/80">
                            Harga terjangkau untuk semua kalangan dengan sistem grosir.
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-2xl p-8 hover:-translate-y-2 transition">
                        <h3 class="text-xl font-bold mb-3">Variasi Produk Lengkap</h3>
                        <p class="text-white/80">
                            Bola, raket, sepatu, hingga aksesoris olahraga.
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-2xl p-8 hover:-translate-y-2 transition">
                        <h3 class="text-xl font-bold mb-3">Pelayanan Cepat & Ramah</h3>
                        <p class="text-white/80">
                            Mengutamakan kepuasan dan kenyamanan pelanggan.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        {{-- STATISTICS --}}
        <section class="bg-yellow-400 py-16">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">

                    <div>
                        <div class="text-5xl font-extrabold text-slate-900">40+</div>
                        <p class="mt-2 text-slate-800">Tahun Pengalaman</p>
                    </div>

                    <div>
                        <div class="text-5xl font-extrabold text-slate-900">100+</div>
                        <p class="mt-2 text-slate-800">Mitra Toko</p>
                    </div>

                    <div>
                        <div class="text-5xl font-extrabold text-slate-900">500+</div>
                        <p class="mt-2 text-slate-800">Produk Tersedia</p>
                    </div>

                    <div>
                        <div class="text-5xl font-extrabold text-slate-900">99%</div>
                        <p class="mt-2 text-slate-800">Kepuasan Pelanggan</p>
                    </div>

                </div>
            </div>
        </section>

    </div>
</x-app-layout>
