<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("recipes", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("title");
            $table->text("description");
            $table->text("instructions");
            $table->integer("prep_time");
            $table->integer("cook_time");
            $table->integer("servings");
            $table->string("cuisine_type");
            $table->string("difficulty")->default("moyen");
            $table->string("image_path")->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("recipes"); }
};