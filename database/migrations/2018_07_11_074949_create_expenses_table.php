<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('period_id')->unsigned();
            $table->integer('budget_id')->unsigned();

            $table->integer('approver_id')->unsigned()->index();
            $table->string('priority',50);
            $table->decimal('price');
            $table->decimal('outside');

            $table->string('subject');
            $table->text('description');
            $table->text('file');
            $table->enum('status',['Approved','Denied','Pending','Closed']);
            $table->longText('comments');

            $table->timestamps();


            //Foreign Key

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
