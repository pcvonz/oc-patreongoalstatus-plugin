<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePaulPatreonSystemSettings6 extends Migration
{
    public function up()
    {
        Schema::table('paul_patreon_system_settings', function($table)
        {
            $table->dropColumn('client_secret');
        });
    }
    
    public function down()
    {
        Schema::table('paul_patreon_system_settings', function($table)
        {
            $table->string('client_secret', 255);
        });
    }
}
