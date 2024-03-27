<?php

use App\Models\User;
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
        Schema::create('ultrasonidos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'paciente_id')
                ->constrained((new User)->getTable())
                ->cascadeOnDelete();

            $table->string('titulo')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('secret', 8)->nullable();
            $table->timestamps();
        });

        Schema::table('ultrasonidos', function (Blueprint $table) {
            $table->fullText(['titulo', 'descripcion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ultrasonidos');
    }
};
