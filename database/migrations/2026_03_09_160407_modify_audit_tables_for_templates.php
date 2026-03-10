<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->foreignId('template_id')->nullable()->constrained('audit_templates')->nullOnDelete();
        });

        Schema::table('audit_questions', function (Blueprint $table) {
            $table->foreignId('template_id')->nullable()->constrained('audit_templates')->cascadeOnDelete();
            $table->foreignId('pillar_id')->nullable()->constrained('audit_pillars')->cascadeOnDelete();
            $table->string('question_type')->default('scale_1_to_5');
            $table->string('level')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->dropForeign(['template_id']);
            $table->dropColumn('template_id');
        });

        Schema::table('audit_questions', function (Blueprint $table) {
            $table->dropForeign(['template_id']);
            $table->dropForeign(['pillar_id']);
            $table->dropColumn(['template_id', 'pillar_id', 'question_type']);
            $table->string('level')->nullable(false)->change();
        });
    }
};
