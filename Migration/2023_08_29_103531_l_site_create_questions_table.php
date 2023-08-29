<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLSiteQuestions extends Migration {
    public function up(){
        Schema::create('l_site_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('l_site_questions');
    }
};
