<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeletePaulPatreonApi extends Migration
{
    public function up()
    {
        Schema::dropIfExists('paul_patreon_api');
    }
    
    public function down()
    {
        Schema::create('paul_patreon_api', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('idd')->unsigned();
            $table->string('api_key', 255)->nullable();
            $table->string('client_id', 255)->nullable();
        });
    }
}
