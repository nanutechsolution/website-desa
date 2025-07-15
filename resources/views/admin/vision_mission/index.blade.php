{{-- resources/views/admin/vision_mission/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visi & Misi Desa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Sukses!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Detail Visi & Misi</h3>
                        <a href="{{ route('admin.vision-mission.edit') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit Visi & Misi
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                            <h4 class="text-xl font-bold text-gray-800 mb-4 text-center">Visi</h4>
                            <p class="text-gray-700 italic text-center">
                                "{{ $vm->vision_text ?? 'Visi belum ditetapkan.' }}"
                            </p>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                            <h4 class="text-xl font-bold text-gray-800 mb-4 text-center">Misi</h4>
                            @if ($vm && count($vm->mission_points) > 0)
                                <ul class="list-disc list-inside text-gray-700 space-y-2">
                                    @foreach ($vm->mission_points as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-700 text-center">Misi belum ditetapkan.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
