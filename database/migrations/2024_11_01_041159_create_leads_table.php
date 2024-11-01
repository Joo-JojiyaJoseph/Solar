<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('branch');
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('landmark')->nullable();
            $table->string('contact_number');
            $table->string('alternate_number')->nullable();
            $table->string('email')->nullable();
            $table->string('service');
            $table->string('sub_service')->nullable();
            $table->text('comments')->nullable();
            $table->text('status')->default("new");
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
        Schema::dropIfExists('leads');
    }
}
