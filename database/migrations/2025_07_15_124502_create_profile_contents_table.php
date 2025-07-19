    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('profile_contents', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique(); // Contoh: 'visi', 'misi', 'sejarah', 'struktur_pemerintahan'
                $table->text('content')->nullable();
                $table->timestamps();
            });
        }
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('profile_contents');
        }
    };
