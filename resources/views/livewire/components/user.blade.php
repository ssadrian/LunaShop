<div class="sm:relative"
     x-data="{
         linesVisible: @entangle('linesVisible')
     }">

    <x-jet-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="grid w-16 h-16 transition border-l border-gray-100 lg:border-l-transparent hover:opacity-75"
                    x-on:click="linesVisible = !linesVisible">
                <span class="sr-only">User</span>

                <span class="place-self-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                </span>
            </button>
        </x-slot>

        <x-slot name="content">
            @auth
                <x-jet-dropdown-link href="{{ route('dashboard') }}">
                    {{ __('Dashboard') }}
                </x-jet-dropdown-link>

                <div class="border-t border-gray-100"></div>

                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-jet-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-jet-dropdown-link>
                </form>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-jet-dropdown-link>
                @endif

                <!-- Team Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-jet-dropdown-link
                    href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                    {{ __('Team Settings') }}
                </x-jet-dropdown-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                        {{ __('Create New Team') }}
                    </x-jet-dropdown-link>
                @endcan

                <div class="border-t border-gray-100"></div>

                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>

                @foreach (Auth::user()->allTeams() as $team)
                    <x-jet-switchable-team :team="$team"/>
                @endforeach

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-jet-dropdown-link>
                @endif

            @else
                <form method="GET" action="{{ route('login') }}" x-data>
                    <x-jet-dropdown-link href="{{ route('login') }}"
                                         @click.prevent="$root.submit();">
                        {{ __('Log In') }}
                    </x-jet-dropdown-link>
                </form>

                <form method="GET" action="{{ route('register') }}" x-data>
                    <x-jet-dropdown-link href="{{ route('register') }}"
                                         @click.prevent="$root.submit();">
                        {{ __('Register') }}
                    </x-jet-dropdown-link>
                </form>
            @endauth
        </x-slot>
    </x-jet-dropdown>
</div>
