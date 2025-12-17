<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'must_set_password')) {
                $table->boolean('must_set_password')
                    ->after('password')
                    ->default(false);
            }

            if (! Schema::hasColumn('users', 'password_set_at')) {
                $table->timestamp('password_set_at')
                    ->nullable()
                    ->after('must_set_password');
            }
        });

        // Tandai seluruh akun Google agar wajib membuat password lokal
        DB::table('users')
            ->whereNotNull('google_id')
            ->update(['must_set_password' => true, 'password_set_at' => null]);

        // Isi cap waktu untuk akun lokal yang sudah memiliki password
        DB::table('users')
            ->whereNull('google_id')
            ->whereNull('password_set_at')
            ->update(['password_set_at' => DB::raw('NOW()')]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'password_set_at')) {
                $table->dropColumn('password_set_at');
            }

            if (Schema::hasColumn('users', 'must_set_password')) {
                $table->dropColumn('must_set_password');
            }
        });
    }
};
