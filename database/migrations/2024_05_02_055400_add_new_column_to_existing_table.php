<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToExistingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
//        Schema::table('roles', function (Blueprint $table) {
//            $table->string('guard_name')->nullable(); // Замените string на нужный тип данных и new_column_name на имя новой колонки
//            $table->timestamps();
//        });        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('roles', function (Blueprint $table) {
//            $table->dropColumn('guard_name'); // Удаляет столбец email
//            $table->dropColumn(['created_at', 'updated_at']);
//        });
    }
}
