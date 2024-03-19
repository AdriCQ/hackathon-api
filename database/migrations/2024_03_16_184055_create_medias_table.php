<?php

use App\Enums\MediaEnum;
use App\Models\Analisis;
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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Analisis::class, 'analisis_id')
                ->constrained((new Analisis)->getTable())
                ->cascadeOnDelete();
            $table->enum('tipo', [
                MediaEnum::IMAGE->name,
                MediaEnum::VIDEO->name,
            ]);
            $table->string('disk')->default('public');
            $table->string('titulo')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('url');
            $table->timestamps();
        });

        Schema::table('medias', function (Blueprint $table) {
            $table->fullText(['titulo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
