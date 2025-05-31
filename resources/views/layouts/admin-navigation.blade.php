<div class="min-w-fit">
    <!-- Sidebar backdrop (mobile only) -->
    <div
        class="fixed inset-0 bg-gray-900/30 z-40 lg:hidden transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'"
        aria-hidden="true"
        x-cloak
    ></div>

    <!-- Sidebar -->
    <aside
        id="sidebar"
        class="fixed lg:static z-40 left-0 top-0 h-full lg:h-[100dvh] w-64 bg-gray-800 p-4 border-r border-gray-700/60 flex flex-col transition-transform duration-200 ease-in-out
            transform max-lg:-translate-x-64
            lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : 'max-lg:-translate-x-64'"
        @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false"
        x-data="{ sidebarOpen: false }"
    >
        <!-- Sidebar header -->
        <div class="flex justify-between mb-10 pr-3 sm:px-2">
            <!-- Close button (mobile only) -->
            <button class="lg:hidden text-gray-500 hover:text-gray-400" @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>
            <!-- Logo -->
            <a class="block" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('assets/img/logo-sispak-dkph.png') }}" alt="SISPAK-DKPH Logo" class="h-12 w-auto">
            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8 flex-1">
            <div>
                <h3 class="text-xs uppercase text-gray-400 font-semibold pl-3">Menu Admin</h3>
                <ul class="mt-3 space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="truncate">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kerusakan.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.kerusakan.*') ? 'bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="truncate">Kerusakan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gejala.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.gejala.*') ? 'bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span class="truncate">Gejala</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="{{ route('admin.pertanyaan.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.pertanyaan.*') ? 'bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                            <span class="truncate">Pertanyaan</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="{{ route('admin.history.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.history.*') ? 'bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="truncate">History</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg {{ request()->routeIs('admin.user.*') ? 'bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="truncate">User</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Logout -->
        <div class="mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>
</div>
