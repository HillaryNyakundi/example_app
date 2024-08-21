<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>

    @foreach ($jobs as $job)
        <li><strong>{{ $job['title'] }}:</strong> Pays {{ $job['salary'] }} Per year.</li>
    @endforeach
</x-layout>