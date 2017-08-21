<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePaulPatreonRegister extends Migration
{
    public function up()
    {
        Schema::table('paul_patreon_register', function($table)
        {
            $table->text('access_token')->nullable();
            $table->text('refresh_token')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('paul_patreon_register', function($table)
        {
            $table->dropColumn('access_token');
            $table->dropColumn('refresh_token');
        });
    }
}
