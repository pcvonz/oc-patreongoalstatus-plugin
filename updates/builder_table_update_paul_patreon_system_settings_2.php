<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePaulPatreonSystemSettings2 extends Migration
{
    public function up()
    {
        Schema::table('paul_patreon_system_settings', function($table)
        {
            $table->string('patreon_url');
        });
    }
    
    public function down()
    {
        Schema::table('paul_patreon_system_settings', function($table)
        {
            $table->dropColumn('patreon_url');
        });
    }
}
