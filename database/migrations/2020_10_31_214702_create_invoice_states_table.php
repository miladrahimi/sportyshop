<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id');
            $table->unsignedTinyInteger('type');
            $table->json('information');
            $table->timestamps();
            $table->index(['type', 'invoice_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_states');
    }
}
