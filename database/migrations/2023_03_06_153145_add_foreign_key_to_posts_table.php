<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //PRIMA CREIAMO LA COLONNA
            $table->unsignedBigInteger('category_id') //<--- QUESTO COINCIDE CON.....
            ->nullable()
            ->after('id');

            //CREO LA FOREIGN KEY
            $table->foreign('category_id')  // <----- QUESTO
                ->references('id')  //NOME DELLA COLONNA A CUI FA RIFERIMENTO
                ->on('categories')  // E DI QUALE TABELLA APPARTIENE
                ->onDelete('set null'); //DICIAMO ESPLICITAMENTE DI SETTARE A NULL LA COLONNA NEL CASO IN CUI CANCELLASSIMO LA CATEGORIA
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //1. step
            $table->dropForeign('posts_category_id_foreign'); //DROPPA NELLA TABELLA POSTS LA COLONNA CATEGORY_ID CHE è LA FOREIGN
            // 2.step
            $table->dropColumn('category_id');
        });
    }
};
