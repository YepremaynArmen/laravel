<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActionsColumnToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('actions')->after('name'); // Добавляет уникальный столбец actions после столбца name
        });
    
    }
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('actions'); // Удаляет столбец email
        });
    }
}
