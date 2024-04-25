<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique()->after('password'); // Добавляет уникальный столбец email после столбца password
        });
    
    }
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email'); // Удаляет столбец email
        });
    }
}
