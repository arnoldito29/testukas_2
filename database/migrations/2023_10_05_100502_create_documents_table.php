<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\MimeTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $cases = collect(MimeTypeEnum::cases())->pluck('value');

        Schema::create('documents', function (Blueprint $table) use ($cases) {
            $table->id();
            $table->string('name');
            $table->enum('mime_type', $cases->toArray());
            $table->integer('size');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
