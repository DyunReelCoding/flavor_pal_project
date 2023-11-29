<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('FlavorPal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('dashboard.search') }}" method="GET" class="mb-4 flex justify-center items-center">
                        @csrf
                        <label for="search" class="sr-only">Search</label>
                        <input type="text" name="search" id="search" placeholder="Search recipes..." class="w-1/2 border rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-2">Search</button>
                    </form>

                    @if(empty($search) && count($recipes) > 0)
                    <h2 class="text-2xl font-semibold mb-4">Recommendation</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($recipes as $recipe)
                        <div class="mb-4">
                            <div class="bg-gray-100 p-4 rounded-md">
                                <img src="{{ $recipe['strMealThumb'] }}" alt="{{ $recipe['strMeal'] }}" class="w-full h-32 object-cover cursor-pointer" data-toggle="modal" data-target="#recipeModal_{{ $recipe['idMeal'] }}">
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="recipeModal_{{ $recipe['idMeal'] }}" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel_{{ $recipe['idMeal'] }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="recipeModalLabel_{{ $recipe['idMeal'] }}">{{ $recipe['strMeal'] }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ $recipe['strMealThumb'] }}" alt="{{ $recipe['strMeal'] }}" class="w-full h-64 object-cover mb-2">
                                            <p>{{ $recipe['strInstructions'] }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark close-button" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if(count($recipes) > 0)
                    <h2 class="text-2xl font-semibold mb-4">{{ empty($search) ? 'Recommendation' : 'Search Results' }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($recipes as $recipe)
                        <div class="mb-4">
                            <div class="bg-gray-100 p-4 rounded-md">
                                <img src="{{ $recipe['strMealThumb'] }}" alt="{{ $recipe['strMeal'] }}" class="w-full h-32 object-cover cursor-pointer" data-toggle="modal" data-target="#recipeModal_{{ $recipe['idMeal'] }}">
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="recipeModal_{{ $recipe['idMeal'] }}" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel_{{ $recipe['idMeal'] }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="recipeModalLabel_{{ $recipe['idMeal'] }}">{{ $recipe['strMeal'] }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ $recipe['strMealThumb'] }}" alt="{{ $recipe['strMeal'] }}" class="w-full h-64 object-cover mb-2">
                                            <p>{{ $recipe['strInstructions'] }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @elseif(!empty($search))
                    <p>No recipes found for '{{ $search }}'.</p>
                    @endif


                </div>
            </div>
        </div>
    </div>
</x-app-layout>