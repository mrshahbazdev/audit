<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $levels = ['Umsatz', 'Gewinn', 'Ordnung', 'Einfluss', 'Vermächtnis'];

        $questions = [
            // Umsatz (Revenue)
            ['level' => 'Umsatz', 'question' => 'Lead Quality?', 'description' => 'How qualified are your incoming leads?'],
            ['level' => 'Umsatz', 'question' => 'Closing Rate?', 'description' => 'What is your current sales closing rate?'],
            ['level' => 'Umsatz', 'question' => 'Revenue Predictability?', 'description' => 'How accurately can you predict future revenue?'],
            ['level' => 'Umsatz', 'question' => 'Customer Reliability?', 'description' => 'Are your customers consistent and reliable?'],
            ['level' => 'Umsatz', 'question' => 'Pricing Strategy?', 'description' => 'Is your pricing optimal for your target market?'],

            // Gewinn (Profit)
            ['level' => 'Gewinn', 'question' => 'Profit Margin?', 'description' => 'How healthy is your gross and net profit margin?'],
            ['level' => 'Gewinn', 'question' => 'Cost Control?', 'description' => 'How effectively do you manage and reduce costs?'],
            ['level' => 'Gewinn', 'question' => 'Cash Flow?', 'description' => 'Is your cash flow consistently positive?'],
            ['level' => 'Gewinn', 'question' => 'ROI on Marketing?', 'description' => 'What is the return on investment for your marketing spend?'],
            ['level' => 'Gewinn', 'question' => 'Financial Buffer?', 'description' => 'Do you have sufficient reserves for unexpected events?'],

            // Ordnung (Processes / Structure)
            ['level' => 'Ordnung', 'question' => 'Standard Operating Procedures?', 'description' => 'Are your processes documented and followed?'],
            ['level' => 'Ordnung', 'question' => 'Automation Level?', 'description' => 'How well are repetitive tasks automated?'],
            ['level' => 'Ordnung', 'question' => 'Team Autonomy?', 'description' => 'Can your team operate without your constant involvement?'],
            ['level' => 'Ordnung', 'question' => 'Data Management?', 'description' => 'Is your business data organized and secure?'],
            ['level' => 'Ordnung', 'question' => 'Onboarding Process?', 'description' => 'How effectively do you train new hires?'],

            // Einfluss (Market Influence)
            ['level' => 'Einfluss', 'question' => 'Brand Recognition?', 'description' => 'How well-known is your brand in your industry?'],
            ['level' => 'Einfluss', 'question' => 'Market Share?', 'description' => 'What is your share of the target market?'],
            ['level' => 'Einfluss', 'question' => 'Thought Leadership?', 'description' => 'Are you seen as an authority in your field?'],
            ['level' => 'Einfluss', 'question' => 'Customer Retention?', 'description' => 'How loyal are your customers over time?'],
            ['level' => 'Einfluss', 'question' => 'Strategic Partnerships?', 'description' => 'Do you have strong alliances that drive growth?'],

            // Vermächtnis (Legacy / Brand Impact)
            ['level' => 'Vermächtnis', 'question' => 'Company Culture?', 'description' => 'Is your work environment positive and aligned with your values?'],
            ['level' => 'Vermächtnis', 'question' => 'Social Impact?', 'description' => 'Does your business positively impact the community?'],
            ['level' => 'Vermächtnis', 'question' => 'Long-term Vision?', 'description' => 'Do you have a clear plan for the next 10+ years?'],
            ['level' => 'Vermächtnis', 'question' => 'Succession Planning?', 'description' => 'Is there a plan for leadership transition?'],
            ['level' => 'Vermächtnis', 'question' => 'Employee Fulfillment?', 'description' => 'Are your team members fulfilled and growing?'],
        ];

        DB::table('audit_questions')->insert($questions);

        // Create a test organization and user
        $orgId = DB::table('organizations')->insertGetId([
            'name' => 'Test Organization',
            'industry' => 'Tech',
            'size' => '10-50',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'organization_id' => $orgId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
