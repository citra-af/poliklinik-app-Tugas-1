<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Poliklinik' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">

    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content flex flex-col">
            
            <div class="navbar bg-base-100 border-b px-8 min-h-[64px]">
                <div class="flex-1"></div>

                <div class="flex-none flex items-center gap-3">
                    <div class="flex flex-col items-end justify-center leading-tight">
                        <span class="text-xs font-bold text-gray-800">Pengguna</span>
                        <span class="text-[10px] text-gray-400">admin</span>
                    </div>
                    <div class="avatar placeholder flex items-center">
                        <div class="bg-primary text-primary-content rounded-full w-10 h-10 flex items-center justify-center border border-primary/20">
                            <span class="text-sm font-bold">U</span>
                        </div>
                    </div>
                </div>
            </div>

            <main class="p-8 min-h-screen">
                {{ $slot }}
            </main>

            <footer class="p-4 bg-base-100 text-base-content border-t text-xs text-gray-400">
                <aside>
                    <p>Copyright © 2026 — All rights reserved by <span class="text-primary font-bold">Poliklinik</span></p>
                </aside>
            </footer>
        </div> 

        <div class="drawer-side shadow-xl">
            <label for="my-drawer-2" class="drawer-overlay"></label> 
            <div class="menu p-0 w-72 min-h-full bg-[#2D3EAF] text-white flex flex-col">
                
                <div class="flex-1 mt-6">
                    @include('components.partials.sidebar')
                </div>

                <div class="p-4 border-t border-white/10">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-error btn-block text-white gap-2 rounded-xl font-bold shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>