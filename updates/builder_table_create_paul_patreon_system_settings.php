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
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->integer('completed_percentage')->nullable();
            $table->string('client_secret')->nullable();
            $table->integer('refresh_time')->nullable();
            $table->integer('time_since_last_update')->nullable();
            $table->string('api_key')->nullable();
            $table->string('client_id')->nullable();
            $table->integer('amount_cents')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('paul_patreon_system_settings');
    }
}
