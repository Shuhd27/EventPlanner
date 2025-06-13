<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <main class="mt-10">
        {{-- Meldingen --}}
        @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white p-4 rounded shadow-lg z-50">
            {{ session('success') }}
        </div>
        @endif

        @if(!empty($error))
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50">
            <div class="bg-red-500 text-white px-8 py-4 rounded shadow-lg max-w-md text-center">
                {{ $error }}
            </div>
        </div>
        @endif




        {{-- Header --}}
        <section class="w-full">
            <div class="bg-[#838383] w-1/3 p-4 rounded-r-lg">
                <h3 class="text-2xl text-white text-end">
                    Events beheren
                </h3>
            </div>
        </section>

        {{-- Tabel --}}
        <section class="my-10">
            <table class="bg-[#FFF8E6] rounded-2xl w-11/12 m-auto text-[#4F4F4F] text-sm">
                <thead class="bg-[#CEEFC1]">
                    <tr>
                        <th class="border-r-2 border-[#D0D0D0] p-2">Titel</th>
                        <th class="border-r-2 border-[#D0D0D0] p-2">Beschrijving</th>
                        <th class="border-r-2 border-[#D0D0D0]">Datum</th>
                        <th class="border-r-2 border-[#D0D0D0]">Locatie</th>
                        <th class="border-r-2 border-[#D0D0D0]">Wijzigen</th>
                        <th>Verwijderen</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($events))
                    <tr>
                        <td colspan="6" class="bg-[#F88080] text-center py-4">
                            Geen events gevonden.
                        </td>
                    </tr>
                    @else
                    @foreach($events as $event)
                    <tr>
                        <td class="p-2 border-t-2 border-[#D0D0D0]">{{ $event->title }}</td>
                        <td class="p-2 border-t-2 border-l-2 border-[#D0D0D0]">{{ \Illuminate\Support\Str::limit($event->description, 50) }}</td>
                        <td class="p-2 border-t-2 border-l-2 border-[#D0D0D0]">{{ $event->date }}</td>
                        <td class="p-2 border-t-2 border-l-2 border-[#D0D0D0]">{{ $event->location }}</td>
                        <td class="p-2 border-t-2 border-l-2 border-[#D0D0D0] text-center">
                            <a href="{{ route('events.edit', $event->id) }}" class="block bg-[#9BC8F2] text-white rounded px-2 py-1">
                                Wijzigen
                            </a>
                        </td>
                        <td class="p-2 border-t-2 border-l-2 border-[#D0D0D0] text-center">
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit event wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-[#F88080] text-white rounded px-3 py-1 text-sm">
                                    Verwijderen
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>

            </table>
        </section>

        {{-- Toevoegen knop --}}
        <div class="w-full flex justify-center my-6">
            <a href="{{ route('events.create') }}" class="bg-[#B5D2AA] text-white text-xl px-6 py-3 rounded shadow">
                Event toevoegen
            </a>
        </div>

        {{-- Paginatie (optioneel als je paginate gebruikt) --}}
        {{-- <section>
            {{ $events->links() }}
        </section> --}}
    </main>
</x-app-layout>