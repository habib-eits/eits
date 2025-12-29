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
        Schema::create('receipt_master', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('InvoiceMasterID')->nullable();
            $table->unsignedBigInteger('PartyID')->nullable();
            $table->unsignedBigInteger('UserID')->nullable();
            $table->char('ReferenceNo',100)->nullable();
            $table->char('PaymentMode',100)->nullable();
            $table->string('Description')->nullable();
            $table->decimal('Paid',15,2)->nullable();
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
        Schema::dropIfExists('receipt_master');
    }
};
