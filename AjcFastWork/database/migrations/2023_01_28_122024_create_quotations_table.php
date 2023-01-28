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
        Schema::create('quotations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('quote_no')->nullable();
            $table->string('quote_project_name')->nullable();
            $table->date('quote_date')->nullable();
            $table->string('quote_paid_date')->nullable();
            $table->string('quote_delivery_date')->nullable();
            $table->string('quote_stand_date')->nullable();
            $table->string('quote_remarks')->nullable();

            $table->string('quote_discount_type')->nullable();
            $table->decimal('quote_discount')->nullable();

            $table->uuid('branch_id')->nullable();
            $table->string('branch_name_en')->nullable();
            $table->string('branch_name_th')->nullable();
            $table->string('branch_address_en')->nullable();
            $table->string('branch_address_th')->nullable();
            $table->string('branch_phone')->nullable();
            $table->string('branch_fax')->nullable();
            $table->string('branch_email')->nullable();

            $table->uuid('customer_id')->nullable();
            $table->string('customer_code')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_fax')->nullable();
            $table->string('customer_contact')->nullable();
            $table->string('customer_tax_id')->nullable();

            $table->string('quoter_name')->nullable();

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
        Schema::dropIfExists('quotations');
    }
};
