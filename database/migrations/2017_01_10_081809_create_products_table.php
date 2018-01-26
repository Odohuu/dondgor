<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->integer('ptype_id')->unsigned()->index();
            $table->foreign('ptype_id')
                ->references('id')
                ->on('ptypes')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->string('slug')->unique();
            $table->string('pcode', 32)->unique();
            $table->enum('state', ['active', 'deactive','sold_out']);
            $table->float('rating_cache', 2, 1);
            $table->Integer('rating_count');
            $table->string('name');
            $table->text('description');
            $table->string('size', 32);
            $table->Integer('weight');
            $table->decimal('price', 8, 2);
            $table->tinyInteger('quantity');
            $table->string('variations');
            
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
        Schema::dropIfExists('products');
    }
}
