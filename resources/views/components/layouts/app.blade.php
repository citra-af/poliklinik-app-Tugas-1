<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Poliklinik' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 antialiased overflow-x-hidden">

    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content flex flex-col min-h-screen">
            {{-- Navbar --}}
            <div class="navbar bg-base-100 border-b px-8 min-h-[64px] sticky top-0 z-10">
                <div class="flex-1 lg:hidden">
                    <label for="my-drawer-2" class="btn btn-ghost drawer-button">
                        <i class="fas fa-bars"></i>
                    </label>
                </div>
                <div class="flex-1 hidden lg:block"></div>
                <div class="flex-none flex items-center gap-3">
                    <div class="flex flex-col items-end justify-center leading-tight">
                        <span class="text-xs font-bold text-gray-800">{{ Auth::user()->name ?? 'Pengguna' }}</span>
                        <span class="text-[10px] text-gray-400 capitalize">{{ Auth::user()->role ?? 'admin' }}</span>
                    </div>
                    <div class="avatar placeholder">
                        <div class="bg-primary text-primary-content rounded-full w-10 h-10 flex items-center justify-center">
                            <span class="text-sm font-bold">{{ substr(Auth::user()->name ?? 'U', 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <main class="p-8 flex-1">
                {{ $slot }}
            </main>

            <footer class="p-4 bg-base-100 text-base-content border-t text-xs text-center text-gray-400">
                <p>Copyright © 2026 — <span class="text-primary font-bold">Poliklinik</span></p>
            </footer>
        </div> 

        {{-- Sidebar Section --}}
        <div class="drawer-side z-20">
            <label for="my-drawer-2" class="drawer-overlay"></label> 
            
            {{-- Bagian ini dikunci h-screen dan overflow-hidden agar tidak bisa di-scroll --}}
            <div class="w-72 h-screen bg-[#2D3EAF] text-white flex flex-col overflow-hidden">
                
                {{-- Area Menu Atas --}}
                <div class="flex-1 overflow-y-auto">
                    @include('components.partials.sidebar')
                </div>

                {{-- Tombol Logout Merah di Paling Bawah (Pindah ke app.blade.php) --}}
                <div class="p-4 border-t border-white/10 bg-[#2D3EAF]">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-lg transition-all duration-200 border-none">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>