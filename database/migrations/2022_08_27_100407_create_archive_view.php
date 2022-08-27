<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW view_archive_data AS
            SELECT a.id, a.barcode_number, c.name AS condition_name, a.rack_location, t.name AS type, a.sk_number, a.name, a.kelurahan, u.name AS user, ue.name AS edited_by, a.created_at
                FROM archives a LEFT JOIN conditions c 
                ON a.condition_id = c.id
                LEFT JOIN types t
                ON a.type_id = t.id
                LEFT JOIN users u
                ON a.user_id = u.id
                LEFT JOIN users ue
                ON a.edited_by = ue.id
                ORDER BY
                created_at DESC
            SQL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `view_archive_data`;
            SQL;
    }
};
