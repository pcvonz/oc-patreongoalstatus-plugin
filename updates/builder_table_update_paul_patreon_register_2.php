<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePaulPatreonRegister2 extends Migration
{
    public function up()
    {
        Schema::table('paul_patreon_register', function($table)
        {
            $table->smallInteger('goal_percentage');
        });
    }
    
    public function down()
    {
        Schema::table('paul_patreon_register', function($table)
        {
            $table->dropColumn('goal_percentage');
        });
    }
}
