<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePaulPatreonRegister extends Migration
{
    public function up()
    {
        Schema::create('paul_patreon_register', function($table)
        {
            $table->engine = 'InnoDB';
            $table->text('api_key')->nullable();
            $table->text('client_id')->nullable();
            $table->increments('id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('paul_patreon_register');
    }
}
