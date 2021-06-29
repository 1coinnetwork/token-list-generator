<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetworksTable extends Migration
{
    public function up()
    {
        Schema::create('networks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('chainid');
            $table->string('name');
            $table->string('rpc_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
