<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('category', function (Blueprint $table) {
        $table->softDeletes(); // tạo cột deleted_at
    });
}

public function down()
{
    Schema::table('category', function (Blueprint $table) {
        $table->dropColumn('deleted_at');
    });
}
};
