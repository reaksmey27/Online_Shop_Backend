<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'mysql') return;{
            return;
        }

        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM(
            'pending','processing','shipped','delivered','completed','cancelled'
        ) DEFAULT 'pending'");
    }

    public function down(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'mysql') return;

        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM(
            'pending','processing','shipped','delivered','cancelled'
        ) DEFAULT 'pending'");
    }
};