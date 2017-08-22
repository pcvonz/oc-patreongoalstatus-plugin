<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePaulPatreonSystemSettings4 extends Migration
{
    public function up()
    {
        Schema::table('paul_patreon_system_settings', function($table)
        {
            $table->renameColumn('clien_id', 'client_id');
        });
    }
    
    public function down()
    {
        Schema::table('paul_patreon_system_settings', function($table)
        {
            $table->renameColumn('client_id', 'clien_id');
        });
    }
}
