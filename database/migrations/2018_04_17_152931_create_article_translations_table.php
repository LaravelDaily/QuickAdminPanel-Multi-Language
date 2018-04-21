<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('article_translations', function (Blueprint $table) {

            // mandatory fields
            $table->increments('id');
            $table->string('locale')->index();

            // change article to your model name
            $table->integer('article_id')->unsigned();
            $table->unique(['article_id','locale']);
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

            // add here your respective model attributes
            // which you want to be translated
            $table->string('title');
            $table->text('description');

        });
    }

    public function down()
    {
        Schema::dropIfExists('article_translations');
    }
}






