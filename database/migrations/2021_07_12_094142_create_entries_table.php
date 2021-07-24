<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('photo');
            $table->string('nid')->unique()->nullable();
            $table->string('contact_no')->unique();
            $table->string('alternative_contact_no')->nullable();
            $table->text('mailing_address');
            $table->string('email_address')->nullable();
            $table->date('date_of_birth');
            $table->string('blood_group')->nullable();
            $table->string('marital_status')->default('Single');
            $table->string('marriage_anniversary')->nullable();
            $table->string('spouse_name')->nullable();
            $table->unsignedInteger('no_of_children')->nullable();
            $table->string('educational_qualification')->default('Others');
            $table->string('professional_status')->default('Others');
            $table->string('religion')->default('Others');
            $table->boolean('presence_of_upcoming_event')->default(0);
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
        Schema::dropIfExists('entries');
    }
}
