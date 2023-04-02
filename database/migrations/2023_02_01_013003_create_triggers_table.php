<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triggers', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->timestamps();
        });

        DB::unprepared("
        CREATE TRIGGER log_insert_user AFTER INSERT ON users FOR EACH ROW
            BEGIN
                DECLARE desc_ text(256);
                SET desc_ = CONCAT('user ', NEW.name, ' telah di tambahkan');
                INSERT INTO triggers(`description`,`created_at`)VALUES (desc_, now());
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('triggers');
        DB::unprepared('DROP TRIGGER `log_insert_user`');
    }
};