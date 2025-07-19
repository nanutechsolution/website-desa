<?php

namespace App\Http\Livewire;

use PowerComponents\LivewirePowerGrid\Actions\Action;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;

final class UserTable extends PowerGridComponent
{
    use WithExport;

    // Properti untuk pesan sukses (dari action)
    protected $listeners = ['userDeleted' => 'showSuccessMessage'];

    public function showSuccessMessage($message)
    {
        session()->flash('success', $message);
    }

    // Konfigurasi dasar tabel (pencarian, paginasi)
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),

            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount()
                ->showPagination(),
        ];
    }

    // Sumber data untuk tabel
    public function datasource(): Builder
    {
        return User::query();
    }

    // Mendefinisikan field-field
    public function fields(): PowerGridFields
    {
        return PowerGridFields::make()
            ->add('id')
            ->add('avatar', fn(User $user) => $user->avatar_url)
            ->add('name')
            ->add('email')
            ->add('created_at_formatted', fn(User $user) => Carbon::parse($user->created_at)->format('d M Y H:i'));
    }

    // Konfigurasi kolom
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Avatar', 'avatar')
                ->body(fn(User $user) => '<img src="' . $user->avatar_url . '" alt="' . $user->name . '" class="h-10 w-10 object-cover rounded-full">'),

            Column::make('Nama', 'name')
                ->searchable()
                ->sortable(),

            Column::make('Email', 'email')
                ->searchable()
                ->sortable(),

            Column::make('Terdaftar Pada', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Aksi'),
        ];
    }

    // Filter (opsional)
    public function filters(): array
    {
        return [];
    }

    // Aksi (tombol Edit, Hapus)
    public function actions(): array
    {
        return [
            Button::add('bulk-delete')
                ->target('')
                ->class('bg-desa-skyblue hover:bg-blue-700 text-white py-1 px-2 rounded text-xs inline-block')
                ->route('admin.users.edit', ['user' => 'id']),

            Button::add('bulk-delete')
                ->target('')
                ->class('bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded text-xs inline-block ml-2')
                ->emit('confirmDelete', ['id' => 'id'])
        ];
    }

    // Metode delete (dipanggil dari event confirmDelete)
    public function delete(int $id): void
    {
        $user = User::findOrFail($id);
        $user->delete();
        $this->dispatch('userDeleted', 'Pengguna berhasil dihapus!');
    }
}
