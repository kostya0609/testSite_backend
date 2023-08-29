<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLSiteAnswers extends Migration {
    public function up(){
        Schema::create('l_site_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id');
            $table->string('answer')->nullable();
            $table->boolean('right')->nullable();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('l_site_answers');
    }
};

