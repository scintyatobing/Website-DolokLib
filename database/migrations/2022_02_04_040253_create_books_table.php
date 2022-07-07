<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->integer('kategori_id');
            $table->string('isbn')->unique();
            $table->string('judul');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->string('jumlah_halaman');
            $table->string('tahun_terbit');
            $table->string('foto');
            $table->enum('status',['tersedia','dipinjam']);
            $table->enum('edisi_buku',['baru','bekas']);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
        Schema::table('buku', function ($table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}
