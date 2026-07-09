<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Store the AlloCore Hub connection per organization so each tenant can
     * connect its own hub account self-service (instead of a single global
     * key in .env).
     */
    public function up(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('allocore_hub_url')->nullable()->after('size');
            $table->string('allocore_api_key')->nullable()->after('allocore_hub_url');
            $table->boolean('allocore_enabled')->default(true)->after('allocore_api_key');
            $table->string('allocore_status')->nullable()->after('allocore_enabled');
            $table->timestamp('allocore_last_synced_at')->nullable()->after('allocore_status');
        });
    }

    public function down(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn([
                'allocore_hub_url',
                'allocore_api_key',
                'allocore_enabled',
                'allocore_status',
                'allocore_last_synced_at',
            ]);
        });
    }
};
