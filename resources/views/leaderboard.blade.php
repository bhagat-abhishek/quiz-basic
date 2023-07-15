<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="container mx-auto">
                        <table class="min-w-full bg-white">
                            <!-- Table headers -->
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-200">Name</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-200">Score</th>
                                    <!-- Add more table headers as needed -->
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                <!-- Table rows -->
                                @forelse ($leaderboards as $leaderboard)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-center">
                                            {{ $leaderboard->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-center">
                                            {{ $leaderboard->score }}</td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                        <!-- Pagination -->

                        <div class="py-4">
                            {{ $leaderboards->links() }}
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</x-app-layout>
