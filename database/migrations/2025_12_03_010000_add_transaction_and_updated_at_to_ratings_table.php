<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            if (!Schema::hasColumn('ratings', 'transaction_id')) {
                $table->foreignId('transaction_id')
                    ->nullable()
                    ->after('buy_id')
                    ->constrained('transactions', 'transaction_id')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('ratings', 'updated_at')) {
                $table->timestamp('updated_at')
                    ->nullable()
                    ->after('created_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            if (Schema::hasColumn('ratings', 'transaction_id')) {
                $table->dropForeign(['transaction_id']);
                $table->dropColumn('transaction_id');
            }

            if (Schema::hasColumn('ratings', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
