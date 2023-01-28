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
        Schema::create('branches', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_th')->nullable();
            $table->text('address_en')->nullable();
            $table->text('address_th')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('branch_type')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('quotation_prefix')->default('QT')->nullable();
            $table->string('invoice_prefix')->default('INV')->nullable();
            $table->string('receipt_prefix')->default('RE')->nullable();
            $table->string('tax_prefix')->default('TAX')->nullable();
            $table->string('bill_prefix')->default('BILL')->nullable();
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
        Schema::dropIfExists('branches');
    }
};
