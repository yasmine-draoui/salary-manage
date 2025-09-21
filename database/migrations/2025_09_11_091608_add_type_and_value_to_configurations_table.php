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
        Schema::table('configurations', function (Blueprint $table) {
             if (!Schema::hasColumn('configurations', 'type')) {
                $table->enum('type', ['PAYMENT_DATE','APP_NAME','DEVELOPPER_NAME','ANOTHER'])
                  ->default('ANOTHER')
                  ->comment('table de configuration');
            }

            if (!Schema::hasColumn('configurations', 'value')) {
                $table->string('value');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configurations', function (Blueprint $table) {
            if (Schema::hasColumn('configurations', 'type')) {
                $table->dropColumn('type');
            }

            if (Schema::hasColumn('configurations', 'value')) {
                $table->dropColumn('value');
            }
        });
    }
};
