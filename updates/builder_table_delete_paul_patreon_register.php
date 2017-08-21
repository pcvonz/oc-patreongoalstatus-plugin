<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeletePaulPatreonRegister extends Migration
{
    public function up()
    {
        Schema::dropIfExists('paul_patreon_register');
    }
    
    public function down()
    {
        Schema::create('paul_patreon_register', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('api_key')->nullable();
            $table->text('client_id')->nullable();
            $table->text('access_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->smallInteger('goal_percentage')->nullable();
        });
    }
}
