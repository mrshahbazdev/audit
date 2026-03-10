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
        Schema::table('audit_pillars', function (Blueprint $table) {
            $table->decimal('target_score', 3, 1)->default(5.0)->after('icon');
        });

        Schema::table('audit_questions', function (Blueprint $table) {
            $table->decimal('weight', 4, 2)->default(1.0)->after('question_type');
            $table->boolean('is_required')->default(true)->after('weight');
            $table->text('failure_recommendation')->nullable()->after('is_required');
            $table->json('options')->nullable()->after('failure_recommendation');
            $table->foreignId('depends_on_question_id')->nullable()->after('options')->constrained('audit_questions')->nullOnDelete();
            $table->string('depends_on_answer')->nullable()->after('depends_on_question_id');
        });

        Schema::table('audit_answers', function (Blueprint $table) {
            $table->string('evidence_file_path')->nullable()->after('comment');
            $table->json('selected_options')->nullable()->after('evidence_file_path');
        });
    }

    public function down(): void
    {
        Schema::table('audit_pillars', function (Blueprint $table) {
            $table->dropColumn('target_score');
        });

        Schema::table('audit_questions', function (Blueprint $table) {
            $table->dropForeign(['depends_on_question_id']);
            $table->dropColumn([
                'weight',
                'is_required',
                'failure_recommendation',
                'options',
                'depends_on_question_id',
                'depends_on_answer'
            ]);
        });

        Schema::table('audit_answers', function (Blueprint $table) {
            $table->dropColumn(['evidence_file_path', 'selected_options']);
        });
    }
};
