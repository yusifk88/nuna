<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('wedding_contributions', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger("wedding_id");
            $table->string("name");
            $table->string("email");
            $table->string("transaction_id");
            $table->string("phone_number");
            $table->double("amount");
            $table->text("checkout_token");
            $table->text("message")->nullable();
            $table->index("wedding_id");
            $table->boolean("success")->default(false);
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
        Schema::dropIfExists('wedding_contributions');
    }
}
