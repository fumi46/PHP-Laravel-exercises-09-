<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilehistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {                    // ↓テーブル名
        Schema::create('profilehistories', function (Blueprint $table) {  
            $table->increments('id');
            $table->integer('profile_id'); //外部キー。単数形にする。
            $table->string('edited_at');
            
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
        Schema::dropIfExists('profilehistories');
    }
}
