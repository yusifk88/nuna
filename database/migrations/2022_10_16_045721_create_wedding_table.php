<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wedding', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("bride_name");
            $table->string("bride_phone_number")->nullable();
            $table->string("bride_email")->nullable();
            $table->string("groom_name");
            $table->string("groom_phone_number")->nullable();
            $table->string("groom_email")->nullable();
            $table->string("tag")->nullable();
            $table->string("rsv_phone_number")->nullable();
            $table->string("rsv_person")->nullable();
            $table->longText("location")->nullable();
            $table->string("coordinates")->nullable();
            $table->dateTime("date_time");
            $table->longText("photo_one")->nullable();
            $table->longText("photo_two")->nullable();
            $table->longText("photo_three")->nullable();
            $table->longText("photo_four")->nullable();
            $table->longText("zoom_link")->nullable();
            $table->longText("youtube_link")->nullable();
            $table->integer("view")->default(0);
            $table->boolean("public")->default(false);
            $table->boolean("archived")->default(false);
            $table->foreign("user_id")->references("id")->on("users");
            $table->index("user_id");
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
        Schema::dropIfExists('wedding');
    }
}
