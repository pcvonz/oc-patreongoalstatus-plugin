<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePaulPatreonSystemSettings extends Migration
{
    public function up()
    {
        Schema::table('paul_patreon_system_settings', function($table)
        {
            $table->string('access_token');
            $table->string('refresh_token');
        });
    }
    
    public function down()
    {
        Schema::table('paul_patreon_system_settings', function($table)
        {
            $table->dropColumn('access_token');
            $table->dropColumn('refresh_token');
        });
    }
}
