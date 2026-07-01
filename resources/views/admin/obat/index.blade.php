<x-layouts.app title="Data Obat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Data Obat
        </h2>

        <a href="{{ route('obat.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 
                  bg-primary hover:bg-primary/90 
                  text-white text-sm font-semibold 
                  rounded-xl transition">
            <i class="fas fa-plus text-xs"></i>
            Tambah Obat
        </a>
    </div>

    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="overflow-x-auto">
                <table class="table w-full">

                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                        <tr>
                            <th>Nama Obat</th>
                            <th>Kemasan</th>
                            <th>Harga</th>
                            <th>Stok</th> {{-- ✅ BARU --}}
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($obats as $obat)
                        <tr class="hover">

                            <td class="font-semibold">
                                {{ $obat->nama_obat }}
                            </td>

                            <td>
                                {{ $obat->kemasan ?? '-' }}
                            </td>

                            <td class="font-semibold">
                                Rp {{ number_format($obat->harga, 0, ',', '.') }}
                            </td>

                            {{-- STOK --}}
                           <td>
    @if($obat->stok == 0)
        <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-600">
            Habis ({{ $obat->stok }})
        </span>

    @elseif($obat->stok <= 5)
        <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
            Menipis ({{ $obat->stok }})
        </span>

    @else
        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-600">
            Aman ({{ $obat->stok }})
        </span>
    @endif
</td>

                            <td class="text-right">
                                <a href="{{ route('obat.edit', $obat->id) }}"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded">
                                    Edit
                                </a>

                                <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Hapus data?')"
                                        class="px-3 py-1 bg-red-500 text-white rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-400">
                                Belum ada data obat
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</x-layouts.app>