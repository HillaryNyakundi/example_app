<x-layout>
  <x-slot:heading>
      job Page
  </x-slot:heading>
  <h1 class="font-bold text-lg">{{ $job->title }}</h1>
  <p>
    This job pays {{ $job->salary }} per year.
  </p>

  <p class="pt-6">
    <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
  </p>
</x-layout>