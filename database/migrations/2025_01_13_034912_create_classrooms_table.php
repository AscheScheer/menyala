<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('class_name'); // Nama kelas
            $table->foreignId('teacher_id') // Foreign Key untuk teacher
                ->constrained('teachers') // Merujuk ke tabel teachers
                ->onDelete('cascade') // Hapus data classroom jika teacher dihapus
                ->onUpdate('cascade'); // Update FK jika data teacher diubah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
}
