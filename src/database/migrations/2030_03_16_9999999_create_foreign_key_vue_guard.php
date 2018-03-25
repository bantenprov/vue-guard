<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyVueGuard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {               
        Schema::table('workflow_guards', function(Blueprint $table){
            $table->foreign('workflow_id')
            ->references('id')
            ->on('workflows')
            ->onDelete('set null')
            ->onUpdate('restrict');
        });
        Schema::table('workflow_guards', function(Blueprint $table){
            $table->foreign('transition_id')
            ->references('id')
            ->on('workflow_transition')
            ->onDelete('set null')
            ->onUpdate('restrict');
        });
        Schema::table('workflow_guards', function(Blueprint $table){
            $table->foreign('permission_id')
            ->references('id')
            ->on('permissions')
            ->onDelete('set null')
            ->onUpdate('restrict');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workflow_guards', function(Blueprint $table) {
            $table->dropForeign('workflow_guards_workflow_id_foreign');         
        });
        Schema::table('workflow_guards', function(Blueprint $table) {
            $table->dropForeign('workflow_guards_transition_id_foreign');         
        });
        Schema::table('workflow_guards', function(Blueprint $table) {
            $table->dropForeign('workflow_guards_permission_id_foreign');         
        });
    }
}
