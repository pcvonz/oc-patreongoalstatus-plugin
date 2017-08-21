<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePaulPatreonApi extends Migration
{
    public function up()
    {
        Schema::create('paul_patreon_register', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('api_key')->nullable();
            $table->string('client_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('paul_patreon_register');
    }
}
