<nav x-data="{ open: false }"
     class="sticky top-0 z-50 bg-white/85 backdrop-blur border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT --}}
            <div class="flex items-center gap-8">

                {{-- LOGO (ROLE-AWARE DASHBOARD) --}}
                @auth
                    <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('dashboard') }}"
                       class="flex items-center gap-3">
                        <x-application-logo class="block h-9 w-auto fill-current text-primary" />
                        <span class="hidden sm:block font-bold text-gray-900">
                            Laravel Ecommerce
                        </span>
                    </a>
                @else
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <x-application-logo class="block h-9 w-auto fill-current text-primary" />
                        <span class="hidden sm:block font-bold text-gray-900">
                            Laravel Ecommerce
                        </span>
                    </a>
                @endauth

                {{-- DESKTOP NAV --}}
                @auth
                <div class="hidden sm:flex items-center gap-1">

                    {{-- DASHBOARD (ROLE-AWARE) --}}
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}"
                           class="{{ request()->routeIs('admin.dashboard') ? 'link-nav-active' : 'link-nav' }}">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}"
                           class="{{ request()->routeIs('dashboard') ? 'link-nav-active' : 'link-nav' }}">
                            Dashboard
                        </a>
                    @endif

                    {{-- ADMIN NAV --}}
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('users.index') }}"
                           class="{{ request()->routeIs('users.*') ? 'link-nav-active' : 'link-nav' }}">
                            Users
                        </a>

                        <a href="{{ route('categories.index') }}"
                           class="{{ request()->routeIs('categories.*') ? 'link-nav-active' : 'link-nav' }}">
                            Categories
                        </a>

                        <a href="{{ route('items.index') }}"
                           class="{{ request()->routeIs('items.*') ? 'link-nav-active' : 'link-nav' }}">
                            Items
                        </a>

                        <a href="{{ route('orders.index') }}"
                           class="{{ request()->routeIs('orders.index') ? 'link-nav-active' : 'link-nav' }}">
                            Orders
                        </a>
                    @else
                    {{-- USER NAV --}}
                        <a href="{{ route('shop.index') }}"
                           class="{{ request()->routeIs('shop.*') ? 'link-nav-active' : 'link-nav' }}">
                            Shop
                        </a>

                        <a href="{{ route('categories.collections') }}"
                           class="{{ request()->routeIs('categories.collections') ? 'link-nav-active' : 'link-nav' }}">
                            Collections
                        </a>

                        <a href="{{ route('cart.index') }}"
                           class="relative {{ request()->routeIs('cart.*') ? 'link-nav-active' : 'link-nav' }}">
                            Cart
                            @if(session('cart_count'))
                                <span
                                    class="absolute -top-1 -right-2 bg-red-500 text-white text-xs rounded-full px-1">
                                    {{ session('cart_count') }}
                                </span>
                            @endif
                        </a>

                        <a href="{{ route('orders.my-order') }}"
                           class="{{ request()->routeIs('orders.my-order') ? 'link-nav-active' : 'link-nav' }}">
                            My Orders
                        </a>
                    @endif
                </div>
                @endauth
            </div>

            {{-- RIGHT --}}
            @auth
            <div class="hidden sm:flex items-center gap-3">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-gray-200 bg-white hover:border-primary/40 transition">
                            <span class="font-medium text-gray-800">
                                {{ auth()->user()->name }}
                            </span>
                            <svg class="h-4 w-4 text-gray-500"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            {{-- MOBILE TOGGLE --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="p-2 rounded-xl text-gray-600 hover:text-primary hover:bg-gray-100">
                    ☰
                </button>
            </div>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    @auth
    <div :class="{ 'block': open, 'hidden': !open }"
         class="hidden sm:hidden border-t border-gray-200 bg-white/95">

        <div class="px-4 py-3 space-y-1">

            {{-- DASHBOARD (ROLE-AWARE) --}}
            <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('dashboard') }}"
               class="block link-nav">
                Dashboard
            </a>

            @if(auth()->user()->is_admin)
                <a href="{{ route('users.index') }}" class="block link-nav">Users</a>
                <a href="{{ route('categories.index') }}" class="block link-nav">Categories</a>
                <a href="{{ route('items.index') }}" class="block link-nav">Items</a>
                <a href="{{ route('orders.index') }}" class="block link-nav">Orders</a>
            @else
                <a href="{{ route('shop.index') }}" class="block link-nav">Shop</a>
                <a href="{{ route('categories.collections') }}" class="block link-nav">Collections</a>
                <a href="{{ route('cart.index') }}" class="block link-nav">Cart</a>
                <a href="{{ route('orders.my-order') }}" class="block link-nav">My Orders</a>
            @endif

            <a href="{{ route('profile.edit') }}" class="block link-nav">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left link-nav">Log Out</button>
            </form>
        </div>
    </div>
    @endauth
</nav>
