<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        // Schema::create('schedules', function (Blueprint $table) {
        //     $table->id();
        //     $table->date('schedule_date');
        //     $table->foreignId('user_id')->constrained('users');
        //     $table->timestamps();
        // });

        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('specialty')->nullable();
            $table->timestamps();
        });

        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->date('schedule_date');
            $table->foreignId('instructor_id')->constrained('instructors');
            $table->smallInteger('lecture_number');
            // $table->dateTime('start');
            // $table->dateTime('end');
            $table->text('info')->nullable();
            $table->unsignedInteger('screen_id');
            $table->timestamps();
        });

        Schema::create('screens', function (Blueprint $table) {
            $html = '<img data-src="https://ussaudi.org/wp-content/uploads/2018/04/vision2030-saudi-arabia-Logo-PNG-icon.png" alt="" uk-img>';

            $table->unsignedInteger('id');
            $table->text('html')->default($html);
            $table->string('snapshot')->nullable();
            $table->timestamps();
        });

        Schema::create('timings', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('lecture');
            $table->boolean('morning')->comment('true: morning, false: evening');
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timings');
        Schema::dropIfExists('screens');
        Schema::dropIfExists('lectures');
        Schema::dropIfExists('instructors');
        // Schema::dropIfExists('schedules');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('users');
    }
}
