<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('gender');
            $table->string('name');
            $table->integer('id_no');
            $table->text('info');
            $table->date('issue');
            $table->date('expiry');
            $table->date('renewal');
            $table->date('dob');
            $table->boolean('status');
            $table->integer('company_id');
            $table->integer('certificate_level_id');
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('company_id')
//                ->references('id')
//                ->on('companies')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
