<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePaulPatreonRegister3 extends Migration
{
    public function up()
    {
        Schema::table('paul_patreon_register', function($table)
        {
            $table->smallInteger('goal_percentage')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('paul_patreon_register', function($table)
        {
            $table->smallInteger('goal_percentage')->nullable(false)->change();
        });
    }
}
