<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-900 dark:border-gray-700">
    <!-- Menú superior -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo + nombre app -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Links principales (left side) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    {{-- Si tienes estas rutas, puedes ir habilitándolas una por una --}}
                    @if (Route::has('products.index'))
                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                            Productos
                        </x-nav-link>
                    @endif

                    @if (Route::has('clients.index'))
                        <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                            Clientes
                        </x-nav-link>
                    @endif

                    @if (Route::has('users.index'))
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                            Usuarios
                        </x-nav-link>
                    @endif

                    @if (Route::has('rols.index'))
                        <x-nav-link :href="route('rols.index')" :active="request()->routeIs('rols.*')">
                            Roles
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Parte derecha: usuario + logout -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Dropdown usuario -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4
                                       font-medium rounded-md text-gray-500 dark:text-gray-300 bg-white dark:bg-gray-800
                                       hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none
                                       transition ease-in-out duration-150">
                                <div>{{ Auth::user()->full_name ?? Auth::user()->name ?? 'Usuario' }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 
                                                 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Link perfil (opcional) -->
                            @if (Route::has('profile.edit'))
                                <x-dropdown-link :href="route('profile.edit')">
                                    Perfil
                                </x-dropdown-link>
                            @endif

                            <!-- Separador -->
                            <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

                            <!-- Cerrar sesión -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                >
                                    Cerrar sesión
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Botón menú móvil -->
            <div class="-me-2 flex items-center sm:hidden">
                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400
                           hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800
                           focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800
                           focus:text-gray-500 transition duration-150 ease-in-out"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Links principales en mobile -->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @if (Route::has('products.index'))
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                    Productos
                </x-responsive-nav-link>
            @endif

            @if (Route::has('clients.index'))
                <x-responsive-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                    Clientes
                </x-responsive-nav-link>
            @endif

            @if (Route::has('users.index'))
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    Usuarios
                </x-responsive-nav-link>
            @endif

            @if (Route::has('rols.index'))
                <x-responsive-nav-link :href="route('rols.index')" :active="request()->routeIs('rols.*')">
                    Roles
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Sección usuario + logout en mobile -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-100">
                    {{ Auth::user()->full_name ?? Auth::user()->name ?? 'Usuario' }}
                </div>
                <div class="font-medium text-sm text-gray-500 dark:text-gray-400">
                    {{ Auth::user()->email ?? '' }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                @if (Route::has('profile.edit'))
                    <x-responsive-nav-link :href="route('profile.edit')">
                        Perfil
                    </x-responsive-nav-link>
                @endif

                <!-- Cerrar sesión (mobile) -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        Cerrar sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
