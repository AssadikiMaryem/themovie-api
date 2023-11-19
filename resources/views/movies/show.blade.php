<x-app-layout>
    <x-slot name="header">
        <nav aria-label="Breadcrumb">
            <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <li>
                    <div class="flex items-center">
                        <a href="{{ route('movies') }}" class="mr-2 text-sm font-medium text-gray-900">Movies</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
                <li class="text-sm">
                    <a href="{{url()->current() }}" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ $movie->title }}</a>
                </li>
            </ol>
        </nav>
    </x-slot>
    <div class="mx-auto max-w-full relative lg:grid lg:max-w-full bg-cover bg-no-repeat bg-right-top" style="background-image: url('https://image.tmdb.org/t/p/original{{ $movie->backdrop_path}}')">
        <div class="absolute w-full h-full bg-gradient-to-r from-slate-800 to-slate-900 opacity-90"></div>
            <div class="p-6 relative">
                <div class="grid lg:grid-cols-8 gap-x-6 lg:px-6 flex items-center justify-center">
                    <div class="col-span-2">
                        <div class="inline-block aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75">
                            <img src="https://image.tmdb.org/t/p/w300_and_h450_bestv2{{ $movie->poster_path }}" alt="" class="inline-block h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                    </div>
                    <div class="col-span-6 pl-4 text-white">
                        <h2 class="text-5xl font-bold tracking-wide">{{ $movie->original_title }}</h2>
                        <ul class="mt-2 inline-flex list-disc list-inside text-base font-light tracking-tight">
                            <li class="mr-4">{{ $movie->release_date }}</li>
                            <li class="uppercase mr-4">({{ $movie->original_language }})</li>
                            <li>{{ $movie->runtime }}m</li>
                        </ul>
                        <div class="flex items-center">
                            <div class="my-6 rounded-full h-14 w-14 left-2 -top-12 bg-sky-950">
                                <div class="flex items-center justify-center h-full w-full">
                                    <span class="text-white text-lg font-semibold">{{ $movie->vote_average }}<sup class="text-xs">%</sup></span>
                                </div>
                            </div>
                            <p class="font-semibold pl-3">User Score</p>
                        </div>

                        <p class="italic text-slate-400 text-lg mb-4">{{ $movie->tagline }}</p>
                        <h4 class="text-2xl font-bold mb-2">Overview</h4>
                        <p class="leading-relaxed">{{ $movie->overview }}</p>
                    </div>
                </div>
            </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white py-6 px-5 grid grid-cols-4 gap-x-4">
                    <div class="col-span-1">
                        <h5>Status</h5>
                        <p class="mt-2 text-2xl tracking-tight text-gray-900">{{ $movie->status }}</p>
                    </div>
                    <div class="col-span-1">
                        <h5>Original Language</h5>
                        <p class="mt-2 text-2xl tracking-tight text-gray-900">{{ $movie->original_language }}</p>
                    </div>
                    <div class="col-span-1">
                        <h5>Budget</h5>
                        <p class="mt-2 text-2xl tracking-tight text-gray-900">${{ number_format($movie->budget, 2, ".", ",") }}</p>
                    </div>
                    <div class="col-span-1">
                        <h5>Revenue</h5>
                        <p class="mt-2 text-2xl tracking-tight text-gray-900">${{ number_format($movie->revenue, 2, ".", ",") }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
