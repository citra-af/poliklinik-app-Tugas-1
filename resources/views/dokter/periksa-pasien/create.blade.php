<x-layouts.app title="Periksa Pasien">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('periksa-pasien.index') }}" class="inline-flex items-center justify-center w-9 h-9 
                  rounded-lg bg-slate-100 text-slate-500 
                  hover:bg-slate-200 transition">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>
        <h2 class="text-2xl font-bold text-slate-800">
            Periksa Pasien
        </h2>
    </div>

    {{-- Alert Error --}}
    @if(session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700 text-sm font-semibold">
            {{ session('error') }}
        </div>
    @endif

    {{-- Card --}}
    <div class="card bg-base-100 shadow-sm rounded-2xl border border-slate-200">
        <div class="card-body p-8">

            <form action="{{ route('periksa-pasien.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_daftar_poli" value="{{ $id }}">

                {{-- PILIH OBAT --}}
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Pilih Obat <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <select id="select-obat"
                        class="select select-bordered w-full rounded-lg border-2 px-4">
                        <option value="">-- Pilih Obat --</option>

                        @foreach ($obats as $obat)

                            @php
                                $status = 'aman';
                                if ($obat->stok <= 0) {
                                    $status = 'habis';
                                } elseif ($obat->stok <= 5) {
                                    $status = 'menipis';
                                }
                            @endphp

                            <option value="{{ $obat->id }}"
                                data-nama="{{ $obat->nama_obat }}"
                                data-harga="{{ $obat->harga }}"
                                data-stok="{{ $obat->stok }}"
                                {{ $obat->stok <= 0 ? 'disabled' : '' }}>

                                {{ $obat->nama_obat }}
                                - Rp{{ number_format($obat->harga) }}
                                (Stok: {{ $obat->stok }})

                                @if($status == 'aman')
                                    🟢
                                @elseif($status == 'menipis')
                                    🟡
                                @else
                                    🔴
                                @endif

                            </option>

                        @endforeach

                    </select>
                </div>

                {{-- OBAT TERPILIH --}}
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Obat Terpilih
                        </span>
                    </label>

                    <ul id="obat-terpilih" class="flex flex-col gap-2 mb-2 min-h-[48px]"></ul>

                    <input type="hidden" name="biaya_periksa" id="biaya_periksa" value="0">
                    <input type="hidden" name="obat_json" id="obat_json">
                </div>

                {{-- TOTAL --}}
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Total Harga
                        </span>
                    </label>

                    <div class="input input-bordered w-full rounded-lg flex items-center bg-slate-50 font-bold"
                        id="total-harga">
                        Rp 0
                    </div>
                </div>

                {{-- CATATAN --}}
                <div class="form-control mb-8">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Catatan
                            <span class="text-slate-400 font-normal">(Opsional)</span>
                        </span>
                    </label>

                    <textarea name="catatan" rows="4"
                        class="textarea textarea-bordered w-full border-2 px-4 py-2 rounded-lg resize-none"
                        placeholder="Masukkan catatan..."></textarea>
                </div>

                {{-- BUTTON --}}
                <div class="flex gap-3">
                    <button type="submit"
                        class="btn bg-[#2d4499] hover:bg-[#1e2d6b] text-white border-none rounded-lg px-6">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>

                    <a href="{{ route('periksa-pasien.index') }}"
                        class="btn btn-ghost bg-slate-100 hover:bg-slate-200 text-slate-500 rounded-lg px-6">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        const selectObat = document.getElementById('select-obat');
        const listObat = document.getElementById('obat-terpilih');
        const inputBiaya = document.getElementById('biaya_periksa');
        const inputObatJson = document.getElementById('obat_json');
        const totalHargaEl = document.getElementById('total-harga');

        let daftarObat = [];

        selectObat.addEventListener('change', () => {

            const opt = selectObat.options[selectObat.selectedIndex];

            const id = opt.value;
            const nama = opt.dataset.nama;
            const harga = parseInt(opt.dataset.harga || 0);
            const stok = parseInt(opt.dataset.stok || 0);

            if (!id) return;

            if (stok <= 0) {
                alert('Stok obat ini habis');
                return;
            }

            if (daftarObat.some(o => o.id == id)) {
                alert('Obat sudah dipilih');
                return;
            }

            daftarObat.push({ id, nama, harga, stok });

            render();
            selectObat.selectedIndex = 0;
        });

        function render() {
            listObat.innerHTML = '';
            let total = 0;

            daftarObat.forEach((obat, index) => {

                total += obat.harga;

                const li = document.createElement('li');
                li.className = "flex justify-between items-center px-4 py-2 bg-slate-50 border rounded-lg text-sm";

                li.innerHTML = `
                    <span>
                        ${obat.nama}
                        <span class="font-bold">Rp ${obat.harga.toLocaleString()}</span>
                        <span class="text-xs text-slate-500">(Stok: ${obat.stok})</span>
                    </span>

                    <button type="button"
                        onclick="hapus(${index})"
                        class="px-3 py-1 bg-red-500 text-white rounded-lg">
                        Hapus
                    </button>
                `;

                listObat.appendChild(li);
            });

            inputBiaya.value = total;
            totalHargaEl.innerText = "Rp " + total.toLocaleString();
            inputObatJson.value = JSON.stringify(daftarObat.map(o => o.id));
        }

        function hapus(index) {
            daftarObat.splice(index, 1);
            render();
        }
    </script>

</x-layouts.app>