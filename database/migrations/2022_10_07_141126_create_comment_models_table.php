<?php

use App\Models\ArticleModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentModelsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comment_models', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('comment_value');
            $table->string('commentator_name');
            $table->foreignIdFor(ArticleModel::class)
                ->references('id')
                ->on('article_models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('comments');
    }

}
