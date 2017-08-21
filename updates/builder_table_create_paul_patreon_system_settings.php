<?php namespace Paul\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePaulPatreonSystemSettings extends Migration
{
    public function up()
    {
        Schema::create('paul_patreon_system_settings', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('api_key');
            $table->string('clien_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('paul_patreon_system_settings');
    }
}
