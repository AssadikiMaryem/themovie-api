<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Liste les films tendance de la journée') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <p class="text-gray-500 leading-relaxed">
                        Lorem Ipsum, Lipsum, Lorem, Ipsum, Text, Generate, Generator, Facts, Information, What, Why, Where, Dummy Text, Typesetting, Printing, de Finibus, Bonorum et Malorum, de Finibus Bonorum et Malorum, Extremes of Good and Evil, Cicero, Latin, Garbled, Scrambled, Lorem ipsum dolor sit amet, dolor, sit amet.
                    </p>
                </div>
                
                <livewire:trending-movie />
                
            </div>
        </div>
    </div>
</x-app-layout>