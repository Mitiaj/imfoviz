<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('charts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dashboard_id');
            $table->unsignedBigInteger('dataset_id');

            $table->timestamps();

            $table->foreign(['dashboard_id'])
                ->references('id')
                ->on('dashboards')
                ->cascadeOnDelete();

            $table->foreign(['dataset_id'])
                ->references('id')
                ->on('datasets')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('charts')) {
            Schema::table('charts', function (Blueprint $table) {
                $table->dropForeign(['dataset_id']);
                $table->dropForeign(['dashboard_id']);
            });
        }
        Schema::dropIfExists('charts');
    }
};
