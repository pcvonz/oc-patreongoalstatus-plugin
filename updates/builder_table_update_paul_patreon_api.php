<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePaulPatreonApi extends Migration
{
    public function up()
    {
        Schema::table('paul_patreon_api', function($table)
        {
            $table->renameColumn('id', 'idd');
        });
    }
    
    public function down()
    {
        Schema::table('paul_patreon_api', function($table)
        {
            $table->renameColumn('idd', 'id');
        });
    }
}
