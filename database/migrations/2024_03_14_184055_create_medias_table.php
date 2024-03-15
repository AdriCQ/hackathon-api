<?php

use App\Enums\MediaEnum;
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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')
                ->constrained((new User)->getTable())
                ->cascadeOnDelete();
            $table->enum('type', [
                MediaEnum::IMAGE->name,
                MediaEnum::VIDEO->name,
            ]);
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('url');
            $table->timestamps();
        });

        Schema::table('medias', function (Blueprint $table) {
            $table->fullText(['name', 'description']);
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
