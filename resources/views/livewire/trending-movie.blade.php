<div>
    
    <div class="px-4 py-4 sm:px-6 w-full grid grid-cols-2 gap-x-8">
        <div class="flex items-center gap-x-4">
            <p class="text-xl font-bold">Trending</p>
            <ul class="flex gap-x-2">
                <li>
                    <x-input id="trendingtoday" type="radio" wire:model.live="trending" value="day" class="hidden peer" required/>
                    <label for="trendingtoday" class="font-semibold border border-gray-200 w-32 flex items-center justify-center bg-white rounded-full px-3 py-1 my-3 hover:bg-sky-950 cursor-pointer dark:hover:text-gray-300 dark:border-sky-950 dark:peer-checked:text-green-500 peer-checked:text-blue-600 peer-checked:bg-sky-950 hover:text-gray-600 hover:bg-gray-100 dark:text-sky-950 dark:bg-white dark:hover:bg-sky-950">
                        Today
                    </label>
                </li>
                <li>
                    <x-input id="trendingweek" type="radio" wire:model.live="trending" value="week" class="hidden peer"/>
                    <label for="trendingweek" class="font-semibold border border-gray-200 w-32 flex items-center justify-center bg-white rounded-full px-3 py-1 my-3 hover:bg-sky-950 cursor-pointer dark:hover:text-gray-300 dark:border-sky-950 dark:peer-checked:text-green-500 peer-checked:text-blue-600 peer-checked:bg-sky-950 hover:text-gray-600 hover:bg-gray-100 dark:text-sky-950 dark:bg-white dark:hover:bg-sky-950">
                        This week
                    </label>
                </li>
            </ul>
        </div>
        <div class="w-1/2 justify-self-end">
            <x-input type="text" wire:model.live="search" class="block w-full" placeholder="Search movie by name..."/>
        </div>
    </div>
    <div class="bg-gray-200 bg-opacity-25 px-4 py-16 sm:px-6 lg:px-8 grid grid-cols-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-6 xl:gap-x-8">
        @forelse($movies as $movie)
            <div class="group relative shadow-md rounded-md" wire:key="{{ $movie->id }}" wire:loading.class="opacity-50">
                <a href="{{ route('movies.show', ['id' => $movie->id ]) }}">
                    <div class="inline-block aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75">
                        <img src="https://image.tmdb.org/t/p/w220_and_h330_face{{ $movie->poster_path }}" alt="" class="inline-block h-full w-full object-cover object-center lg:h-full lg:w-full">
                    </div>
                                <div class="my-4 relative">
                                    <div class="rounded-full absolute h-12 w-12 left-2 -top-12 bg-sky-950">
                                        <div class="flex items-center justify-center h-full w-full">
                                            <span class="text-white text-sm font-semibold">{{ $movie->vote_average }}<sup class="text-xs">%</sup></span>
                                        </div>
                                    </div>
                                    <div class="px-3 pt-2">
                                        <h3 class="text-sm text-gray-700">
                                            <a href="#">
                                                <span aria-hidden="true" class="absolute inset-0"></span>
                                                {{ $movie->title }}
                                            </a>
                                        </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $movie->release_date }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="flex items-center justify-center text-xl py-4 text-zinc-600 col-span-6">
                <span>No movies found...</span>
            </div>
        @endforelse
    </div>
    <!-- Pagination -->
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        {{ $movies->links() }}
    </div>
</div>
