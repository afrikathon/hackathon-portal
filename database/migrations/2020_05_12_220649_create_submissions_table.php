<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('team_id')->unique();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('problem')->nullable();
            $table->text('solution')->nullable();
            $table->text('built_with')->nullable();
            $table->text('instruction')->nullable();
            $table->string('demo_link')->nullable();
            $table->string('video_link')->nullable();
            $table->string('photos')->nullable();
            $table->string('deck')->nullable();
            $table->string('design_thinking')->nullable();
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
        Schema::dropIfExists('submissions');
    }
}
