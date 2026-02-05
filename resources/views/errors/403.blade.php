@extends('layouts.layoutpublic')

@section('content')
<section class="w-full px-6 py-16 bg-gray-100">
    <div class="container mx-auto max-w-3xl">
        <div class="bg-white shadow rounded-xl p-10 text-center space-y-4">
            <p class="text-sm font-semibold tracking-widest text-gray-500">403</p>
            <h1 class="text-3xl font-bold text-gray-900">Toegang geweigerd</h1>
            <p class="text-gray-700">Je hebt geen toegang tot deze pagina. Log in met een account dat toestemming heeft of keer terug naar de startpagina.</p>
            <p class="text-gray-500 text-sm">User is not logged in.</p>
            <div class="flex flex-wrap justify-center gap-3 pt-4">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-md bg-gray-900 text-white hover:bg-gray-800">Naar home</a>
                @guest
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-800 hover:bg-gray-50">Login</a>
                @if(Route::has('register'))
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-md border border-gray-300 text-gray-800 hover:bg-gray-50">Registreren</a>
                @endif
                @endguest
            </div>
        </div>
    </div>
</section>
@endsection