<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('speciality_id')->nullable()->after('user_id');
            $table->string('medical_license_number')->nullable()->after('speciality_id');
        });

        DB::statement('UPDATE doctors SET speciality_id = specialty_id');
        DB::statement('UPDATE doctors SET medical_license_number = license_number');

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['specialty_id']);
            $table->dropColumn('specialty_id');
            $table->dropColumn('license_number');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->foreign('speciality_id')->references('id')->on('specialties')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('specialty_id')->nullable()->after('user_id');
            $table->string('license_number')->nullable()->after('specialty_id');
        });

        DB::statement('UPDATE doctors SET specialty_id = speciality_id');
        DB::statement('UPDATE doctors SET license_number = medical_license_number');

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['speciality_id']);
            $table->dropColumn('speciality_id');
            $table->dropColumn('medical_license_number');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->foreign('specialty_id')->references('id')->on('specialties')->nullOnDelete();
        });
    }
};
