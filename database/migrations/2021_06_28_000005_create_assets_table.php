<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('symbol');
            $table->string('name');
            $table->integer('decimals')->default(18);
            $table->string('contract_address');
            $table->string('logo_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
