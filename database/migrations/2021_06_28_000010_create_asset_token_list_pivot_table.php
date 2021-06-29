<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetTokenListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('asset_token_list', function (Blueprint $table) {
            $table->unsignedBigInteger('token_list_id');
            $table->foreign('token_list_id', 'token_list_id_fk_4248989')->references('id')->on('token_lists')->onDelete('cascade');
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id', 'asset_id_fk_4248989')->references('id')->on('assets')->onDelete('cascade');
        });
    }
}
