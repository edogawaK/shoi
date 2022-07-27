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
        Schema::create('category', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('category_name',100);
            $table->unsignedInteger('category_parent')->nullable();
            $table->integer('category_status')->default(1);

            $table->foreign('category_parent')->references('category_id')->on('category');
        });

        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name',100);
            $table->double('product_price');
            $table->double('product_cost');
            $table->text('product_avt',1000);
            $table->dateTime('product_date')->useCurrent();
            $table->double('product_point')->default(5);
            $table->integer('product_status')->default(1);
            $table->unsignedInteger('category_id');
            $table->text('product_description',1000);
            $table->integer('product_amount');
            $table->integer('product_sold')->default(0);

            $table->foreign('category_id')->references('category_id')->on('category');
        });

        Schema::create('image', function (Blueprint $table) {
            $table->increments('image_id');
            $table->text('image_link',1000);
            $table->unsignedInteger('product_id');

            $table->foreign('product_id')->references('product_id')->on('product');
        });

        Schema::create('size', function (Blueprint $table) {
            $table->increments('size_id');
            $table->string('size_name',100);
            $table->integer('size_status')->default(1);
        });

        Schema::create('user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_name',100);
            $table->string('user_email',100);
            $table->string('user_password',1000);
            $table->string('user_address',1000);
            $table->string('user_phone',10);
            $table->integer('user_point')->default(100);
            $table->integer('user_status')->default(1);
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->increments('admin_id');
            $table->string('admin_name',100);
            $table->string('admin_email',100);
            $table->string('admin_password',1000);
            $table->integer('admin_role')->default(1);
            $table->integer('admin_status')->default(1);
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->increments('cart_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('size_id');
            $table->integer('cart_amount');

            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('product_id')->references('product_id')->on('product');
            $table->foreign('size_id')->references('size_id')->on('size');
        });
        
        Schema::create('order', function (Blueprint $table) {
            $table->increments('order_id');
            $table->double('order_total');
            $table->dateTime('order_date')->useCurrent();
            $table->integer('order_status')->default(1);
            $table->unsignedInteger('user_id');

            $table->foreign('user_id')->references('user_id')->on('user');
        });

        Schema::create('detail', function (Blueprint $table) {
            $table->increments('detail_id');
            $table->unsignedInteger('order_id');            
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('size_id');
            $table->integer('detail_amount');

            $table->foreign('order_id')->references('order_id')->on('order');
            $table->foreign('product_id')->references('product_id')->on('product');
            $table->foreign('size_id')->references('size_id')->on('size');
        });

        Schema::create('product_size', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('size_id');
            $table->integer('amount');

            $table->primary(['product_id','size_id']);
            $table->foreign('product_id')->references('product_id')->on('product');
            $table->foreign('size_id')->references('size_id')->on('size');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('size');
        Schema::dropIfExists('voucher');
        Schema::dropIfExists('order_detail');
        Schema::dropIfExists('order');
        Schema::dropIfExists('cart');
        Schema::dropIfExists('product');
        Schema::dropIfExists('category');
        Schema::dropIfExists('sale');
        Schema::dropIfExists('user');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('image');
        Schema::dropIfExists('cart');
        Schema::enableForeignKeyConstraints();
    }
};
