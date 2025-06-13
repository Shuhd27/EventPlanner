<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nieuw Event</h2>
    </x-slot>

    <main class="max-w-2xl mx-auto mt-10">
        @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul>
                @foreach($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
<!-- 
        @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 transition ease-in-out duration-300">
            {{ session('success') }}
        </div>
        @endif -->


        @if(session('error'))
        <div class="mx-auto mt-4 bg-red-500 text-white w-fit px-6 py-3 rounded shadow">
            {{ session('error') }}
        </div>
        @endif


        <form action="{{ route('events.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title">Titel:</label>
                <input type="text" name="title" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label for="description">Beschrijving:</label>
                <textarea name="description" class="w-full border p-2 rounded" rows="4" required></textarea>
            </div>

            <div>
                <label for="date">Datum:</label>
                <input type="date" name="date" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label for="location">Locatie:</label>
                <input type="text" name="location" class="w-full border p-2 rounded" required>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                Toevoegen
            </button>
        </form>
    </main>
</x-app-layout>