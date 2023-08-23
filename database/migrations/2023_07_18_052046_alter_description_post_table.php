<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        //
        Schema::table("posts",function(Blueprint $table){
            $table->string('description')->default('das')->comment('2023 blogs')->change();
        });
    //    DB::statement("ALTER TABLE posts MODIFY COLUMN description TEXT NULL COMMENT 'Blog description'");
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
