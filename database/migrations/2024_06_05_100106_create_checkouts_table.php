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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('metode_pembayaran');
            $table->string('metode_pengiriman');
            $table->text('tujuan');
            $table->integer('total_harga_product')->default(0);
            $table->integer('biaya_pengiriman')->default(0);
            $table->timestamps();
        });

        Schema::table('add_to_carts', function (Blueprint $table) {
            $table->foreign('checkout_id', 'checkout_id_fk')->references('id')->on('checkouts')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_to_carts', function (Blueprint $table) {
            $table->dropForeign('checkout_id_fk');
        });

        Schema::dropIfExists('checkouts');

    }
};
