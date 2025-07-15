<?php

namespace Database\Factories;

use App\Models\ServiceProcedure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceProcedureFactory extends Factory
{
    protected $model = ServiceProcedure::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        $categories = ['Kependudukan', 'Pertanahan', 'Perizinan', 'Umum', 'Lain-lain'];
        return [
            'title' => 'Prosedur ' . $title,
            'slug' => Str::slug('Prosedur ' . $title),
            'description' => $this->faker->paragraph(1),
            'steps_requirements' => '<h3>Persyaratan:</h3><ul><li>Fotokopi KTP</li><li>Fotokopi KK</li><li>Surat Pengantar RT/RW</li></ul><h3>Langkah-langkah:</h3><ol><li>Datang ke Kantor Desa</li><li>Mengisi Formulir</li><li>Menyerahkan Berkas</li><li>Menunggu Proses</li></ol><p>' . $this->faker->paragraphs(3, true) . '</p>',
            'category' => $this->faker->randomElement($categories),
            'is_published' => $this->faker->boolean(90),
            'order' => $this->faker->unique()->numberBetween(1, 10),
        ];
    }
}
