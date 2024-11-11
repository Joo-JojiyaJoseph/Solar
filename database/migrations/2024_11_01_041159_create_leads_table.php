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
            $table->string('lead_date');
            $table->string('branch');
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('landmark')->nullable();
            $table->string('contact_number');
            $table->string('alternate_number')->nullable();
            $table->string('alternate_number1')->nullable();
            $table->string('email')->nullable();
            $table->string('service');
            $table->text('comments')->nullable();
            $table->text('referance')->nullable();
            $table->text('tech_comments')->nullable();
            $table->text('status')->default("new");
            $table->text('technician')->nullable();
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
