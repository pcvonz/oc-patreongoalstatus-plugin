<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePaulPatreonSystemSettings3 extends Migration
{
    public function up()
    {
        Schema::table('paul_patreon_system_settings', function($table)
        {
            $table->string('amount_cents');
        });
    }
    
    public function down()
    {
        Schema::table('paul_patreon_system_settings', function($table)
        {
            $table->dropColumn('amount_cents');
        });
    }
}
