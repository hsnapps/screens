<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTables1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->string('email')->nullable()->after('photo');
            $table->string('phone')->nullable()->after('email');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(0)->after('password');
            $table->string('section')->nullable()->after('is_admin');
        });

        Schema::table('screens', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone']);
        });

        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'section']);
        });

        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn(['user_id']);
        });
    }
}
