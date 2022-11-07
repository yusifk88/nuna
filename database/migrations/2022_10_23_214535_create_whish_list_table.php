<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhishListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wish_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("wedding_id");
            $table->string("name");
            $table->string("type");
            $table->longText("description")->nullable();
            $table->longText("img_url")->nullable();
            $table->double("target_amount")->default(0);
            $table->double("amount_contributed")->default(0);
            $table->boolean("visible")->default(true);
            $table->softDeletes();
            $table->index("user_id");
            $table->index("wedding_id");
            $table->foreign("user_id")->references("id")->on("users");
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
        Schema::dropIfExists('wish_list');
    }
}
