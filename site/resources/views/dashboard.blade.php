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
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div>
                @if (Auth::user()->role=='1')
                <h1>Articles of:{{Auth::user()->name}}</h1>

                @foreach (Auth::user()->articles as $article)
                <h2>
                    {{$article->title}}
                </h2>
                @endforeach
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
