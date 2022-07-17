<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->integer('barcode_number');
            $table->string('rack_location')->nullable();
            $table->foreignId('type_id')->nullable()->constrained()->nullOnDelete();
            $table->string('sk_number')->nullable();
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kab_kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->foreignId('right_type_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('scan_status_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('physical_status_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('condition_id')->nullable()->constrained()->nullOnDelete();
            $table->text('description')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
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
        Schema::dropIfExists('archives');
    }
};
