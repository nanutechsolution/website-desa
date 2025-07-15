{{-- resources/views/admin/vision_mission/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Visi & Misi Desa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                            <ul class="mt-3 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.vision-mission.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="vision_text" class="block text-sm font-medium text-gray-700 mb-2">Visi</label>
                            <textarea name="vision_text" id="vision_text" rows="3"
                                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('vision_text') border-red-500 @enderror"
                                placeholder="Masukkan Visi Desa">{{ old('vision_text', $vm->vision_text ?? '') }}</textarea>
                            @error('vision_text')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Misi</label>
                            <div id="mission-points-container" class="space-y-3">
                                @forelse (old('mission_points', $vm->mission_points ?? []) as $index => $point)
                                    <div class="flex items-center space-x-2 mission-point-item">
                                        <input type="text" name="mission_points[]"
                                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('mission_points.' . $index) border-red-500 @enderror"
                                            placeholder="Masukkan poin misi ke-{{ $index + 1 }}"
                                            value="{{ $point }}">
                                        <button type="button"
                                            class="remove-mission-point-btn text-red-600 hover:text-red-900 text-sm">Hapus</button>
                                    </div>
                                @empty
                                    <div class="flex items-center space-x-2 mission-point-item">
                                        <input type="text" name="mission_points[]"
                                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            placeholder="Masukkan poin misi ke-1">
                                        <button type="button"
                                            class="remove-mission-point-btn text-red-600 hover:text-red-900 text-sm">Hapus</button>
                                    </div>
                                @endforelse
                            </div>
                            @error('mission_points')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('mission_points.*')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <button type="button" id="add-mission-point-btn"
                                class="mt-3 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Tambah Poin Misi
                            </button>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const container = document.getElementById('mission-points-container');
                const addButton = document.getElementById('add-mission-point-btn');

                let missionPointCount = container.children.length;
                if (missionPointCount === 0) {
                    addMissionPointField(); // Ensure at least one field if starting empty
                }


                function addMissionPointField() {
                    missionPointCount++;
                    const div = document.createElement('div');
                    div.classList.add('flex', 'items-center', 'space-x-2', 'mission-point-item');
                    div.innerHTML = `
                        <input type="text" name="mission_points[]"
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan poin misi ke-${missionPointCount}">
                        <button type="button" class="remove-mission-point-btn text-red-600 hover:text-red-900 text-sm">Hapus</button>
                    `;
                    container.appendChild(div);
                }

                function removeMissionPointField(event) {
                    if (event.target.classList.contains('remove-mission-point-btn')) {
                        const item = event.target.closest('.mission-point-item');
                        if (container.children.length > 1) { // Prevent deleting all fields
                            item.remove();
                        } else {
                            // Optionally, clear the field instead of removing if it's the last one
                            item.querySelector('input').value = '';
                        }
                        updatePlaceholders(); // Update numbering after removal
                    }
                }

                function updatePlaceholders() {
                    Array.from(container.children).forEach((item, index) => {
                        item.querySelector('input').placeholder = `Masukkan poin misi ke-${index + 1}`;
                    });
                }


                addButton.addEventListener('click', addMissionPointField);
                container.addEventListener('click', removeMissionPointField); // Use event delegation

                updatePlaceholders(); // Initial numbering update
            });
        </script>
    @endpush
</x-app-layout>
