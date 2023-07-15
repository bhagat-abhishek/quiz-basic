<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (Auth::user()->scores)
                        <span class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Your Score:
                            {{ Auth::user()->scores->score }}</span>
                    @else
                        <a href="{{ route('quiz') }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Start
                            Quiz</a>
                    @endif
                    <a href="{{ route('leaderboard') }}"
                        class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-blue-600">Leaderboard</a>


                </div>

            </div>
        </div>
    </div>
</x-app-layout>
