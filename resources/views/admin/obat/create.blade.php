<x-layouts.app title="Tambah Obat">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('obat.index') }}" class="flex items-center justify-center w-9 h-9 
                  rounded-lg bg-slate-100 hover:bg-slate-200 
                  text-slate-600 transition">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>

        <h2 class="text-2xl font-bold text-slate-800">
            Tambah Obat
        </h2>
    </div>

    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-8">

            <form action="{{ route('obat.store') }}" method="POST">
                @csrf

                {{-- Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    {{-- Nama Obat --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            Nama Obat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_obat" value="{{ old('nama_obat') }}"
                            class="w-full px-4 py-2 border-2 rounded-lg
                            focus:border-primary focus:outline-none"
                            required>
                    </div>

                    {{-- Kemasan --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            Kemasan
                        </label>
                        <input type="text" name="kemasan" value="{{ old('kemasan') }}"
                            class="w-full px-4 py-2 border-2 rounded-lg
                            focus:border-primary focus:outline-none">
                    </div>

                    {{-- STOK --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stok" value="{{ old('stok', 0) }}"
                            min="0"
                            class="w-full px-4 py-2 border-2 rounded-lg
                            focus:border-primary focus:outline-none"
                            required>
                    </div>

                </div>

                {{-- Harga --}}
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">
                        Harga <span class="text-red-500">*</span>
                    </label>

                    <input type="number" name="harga" value="{{ old('harga') }}"
                        class="w-full px-4 py-2 border-2 rounded-lg
                        focus:border-primary focus:outline-none"
                        required>
                </div>

                {{-- Button --}}
                <button type="submit"
                    class="px-6 py-2 bg-primary text-white rounded-xl">
                    Simpan
                </button>

            </form>

        </div>
    </div>

</x-layouts.app>