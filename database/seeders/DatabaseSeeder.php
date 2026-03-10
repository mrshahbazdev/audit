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
        // ============================================================
        // 1. Create the DEFAULT "Business Maturity Pyramid" Template
        //    This is the official 5-pillar / 25-question system.
        //    It is locked and serves as the ALWAYS-AVAILABLE baseline.
        // ============================================================

        $templateId = DB::table('audit_templates')->insertGetId([
            'name' => 'Business Maturity Pyramid',
            'description' => 'The official 5-category, 25-question assessment framework that evaluates a company from the bottom to the top of the Business Maturity Pyramid: Umsatz → Gewinn → Ordnung → Einfluss → Vermächtnis.',
            'created_by' => null, // System default, not owned by any user
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ============================================================
        // 2. Create the 5 Pillars (Categories) of the Pyramid
        // ============================================================
        $pillars = [
            [
                'name' => 'Umsatz',
                'description' => 'Revenue — The foundation of the pyramid. Evaluates how reliably and predictably the business generates income.',
                'icon' => 'trending_up',
                'order' => 1,
                'target_score' => 4.0,
            ],
            [
                'name' => 'Gewinn',
                'description' => 'Profit — Evaluates whether the revenue translates into healthy, sustainable profit margins.',
                'icon' => 'account_balance',
                'order' => 2,
                'target_score' => 4.0,
            ],
            [
                'name' => 'Ordnung',
                'description' => 'Order / Structure — Evaluates the internal systems, processes, and team structures that allow the business to scale.',
                'icon' => 'grid_view',
                'order' => 3,
                'target_score' => 4.0,
            ],
            [
                'name' => 'Einfluss',
                'description' => 'Influence / Market Presence — Evaluates brand authority, customer loyalty, and market position.',
                'icon' => 'cell_tower',
                'order' => 4,
                'target_score' => 4.0,
            ],
            [
                'name' => 'Vermächtnis',
                'description' => 'Legacy — Evaluates the long-term sustainability, cultural health, and societal impact of the business.',
                'icon' => 'auto_awesome',
                'order' => 5,
                'target_score' => 4.0,
            ],
        ];

        $pillarIds = [];
        foreach ($pillars as $pillar) {
            $pillarIds[$pillar['name']] = DB::table('audit_pillars')->insertGetId([
                'template_id' => $templateId,
                'name' => $pillar['name'],
                'description' => $pillar['description'],
                'icon' => $pillar['icon'],
                'order' => $pillar['order'],
                'target_score' => $pillar['target_score'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ============================================================
        // 3. Seed the Official 25 Questions (5 per Pillar)
        // ============================================================
        $questions = [
            // ── UMSATZ (Revenue) ─────────────────────────────────────
            [
                'pillar' => 'Umsatz',
                'question' => 'How qualified and consistent is the quality of your incoming leads?',
                'description' => 'Rate the reliability and quality of your lead pipeline on a scale of 1-5.',
                'recommendation' => 'Focus on refining your targeting criteria. Use lead scoring and qualification frameworks (e.g., BANT) to filter for high-intent prospects before sales calls.',
            ],
            [
                'pillar' => 'Umsatz',
                'question' => 'What is your current sales closing rate and how consistent is it?',
                'description' => 'Evaluate how reliably your sales process converts prospects into paying customers.',
                'recommendation' => 'Implement a structured sales playbook. Train your team on objection handling and standardize your closing methodology to improve consistency.',
            ],
            [
                'pillar' => 'Umsatz',
                'question' => 'How accurately can you predict your revenue for the next 3 months?',
                'description' => 'Assess the reliability of your revenue forecasting model.',
                'recommendation' => 'Build a CRM-based pipeline with deal stages and probability weightings. Monthly forecasting reviews will dramatically improve predictability.',
            ],
            [
                'pillar' => 'Umsatz',
                'question' => 'Are your customers consistent, reliable, and do they renew or return?',
                'description' => 'Evaluate customer reliability, churn rate, and repeat purchase behavior.',
                'recommendation' => 'Launch a customer success or retention program. Regular check-ins, NPS surveys, and proactive support can dramatically reduce churn.',
            ],
            [
                'pillar' => 'Umsatz',
                'question' => 'Is your pricing strategy optimized for your target market and value delivered?',
                'description' => 'Assess whether your pricing reflects the value you provide and whether it is competitive.',
                'recommendation' => 'Conduct a value-based pricing analysis. Survey your best customers on willingness to pay and benchmark against competitors to find the optimal price point.',
            ],

            // ── GEWINN (Profit) ───────────────────────────────────────
            [
                'pillar' => 'Gewinn',
                'question' => 'How healthy are your gross and net profit margins?',
                'description' => 'Rate the overall profitability of your business operations.',
                'recommendation' => 'Conduct a detailed cost analysis. Identify your top 3 cost drivers and create an action plan to reduce them. Look for opportunities to bundle services for higher margin.',
            ],
            [
                'pillar' => 'Gewinn',
                'question' => 'How effectively do you monitor and control your operating costs?',
                'description' => 'Evaluate your cost management discipline and expense review processes.',
                'recommendation' => 'Implement a monthly P&L review process. Categorize all expenses and set clear budget limits per department to create accountability.',
            ],
            [
                'pillar' => 'Gewinn',
                'question' => 'Is your cash flow consistently positive and well-planned?',
                'description' => 'Assess whether your business maintains a healthy, predictable cash position.',
                'recommendation' => 'Create a rolling 13-week cash flow forecast. Negotiate better payment terms with suppliers and incentivize early payment from clients.',
            ],
            [
                'pillar' => 'Gewinn',
                'question' => 'What is the measurable return on investment (ROI) of your marketing spend?',
                'description' => 'Evaluate how well you track and optimize the returns from your marketing investments.',
                'recommendation' => 'Implement UTM tracking across all campaigns. Calculate Customer Acquisition Cost (CAC) per channel and allocate budget to the highest-ROI channels.',
            ],
            [
                'pillar' => 'Gewinn',
                'question' => 'Do you have sufficient financial reserves to cover 3+ months of operations?',
                'description' => 'Assess how prepared your business is to handle unexpected disruptions.',
                'recommendation' => 'Set a target to build a financial reserve equal to 3-6 months of operating expenses. Automate a monthly transfer of a fixed % of revenue into a reserve account.',
            ],

            // ── ORDNUNG (Structure / Processes) ──────────────────────
            [
                'pillar' => 'Ordnung',
                'question' => 'Are your core business processes fully documented and consistently followed?',
                'description' => 'Evaluate the maturity and adoption of your Standard Operating Procedures (SOPs).',
                'recommendation' => 'Start by documenting your top 5 most critical processes. Use tools like Loom for video SOPs or Notion for written guides. Conduct quarterly SOP reviews.',
            ],
            [
                'pillar' => 'Ordnung',
                'question' => 'How well are your repetitive and administrative tasks automated?',
                'description' => 'Assess the level of automation across your operations, sales, and marketing workflows.',
                'recommendation' => 'Map out all recurring manual tasks and identify which can be automated using tools like Zapier, Make (Integromat), or native CRM automations.',
            ],
            [
                'pillar' => 'Ordnung',
                'question' => 'Can your team operate effectively without your direct daily involvement?',
                'description' => 'Rate the autonomy and self-sufficiency of your team structure.',
                'recommendation' => 'Delegate decision-making authority by creating a Decision Rights Framework. Assign owners for each business area and hold weekly async stand-ups.',
            ],
            [
                'pillar' => 'Ordnung',
                'question' => 'Is your business data well-organized, accessible, and secure?',
                'description' => 'Evaluate your data management practices, tool stack, and security hygiene.',
                'recommendation' => 'Implement a centralized data management system. Conduct a data audit, categorize sensitive data, and ensure proper access controls and backups are in place.',
            ],
            [
                'pillar' => 'Ordnung',
                'question' => 'How effectively does your onboarding process integrate and train new team members?',
                'description' => 'Assess the quality and speed of your new hire onboarding program.',
                'recommendation' => 'Create a structured 30-60-90 day onboarding plan for new hires. Include role-specific SOPs, culture documentation, and a buddy/mentor system.',
            ],

            // ── EINFLUSS (Influence / Market Presence) ────────────────
            [
                'pillar' => 'Einfluss',
                'question' => 'How well-known and trusted is your brand within your target industry?',
                'description' => 'Evaluate your brand recognition, reputation, and recall among your target audience.',
                'recommendation' => 'Invest in consistent content marketing and PR. Publish case studies, get featured in industry media, and build strategic social proof through testimonials.',
            ],
            [
                'pillar' => 'Einfluss',
                'question' => 'What is your estimated share of your target market and is it growing?',
                'description' => 'Assess your competitive position and market penetration.',
                'recommendation' => 'Define your Total Addressable Market (TAM) and calculate your current penetration rate. Identify the top 20% of competitors and map out a strategic differentiation plan.',
            ],
            [
                'pillar' => 'Einfluss',
                'question' => 'Are you recognized as a thought leader and authority in your field?',
                'description' => 'Evaluate your presence as an expert voice through speaking, publishing, and media.',
                'recommendation' => 'Create a thought leadership strategy: publish weekly expert content, apply to speak at industry conferences, and pursue podcast or media interview opportunities.',
            ],
            [
                'pillar' => 'Einfluss',
                'question' => 'How loyal are your customers and how high is your customer lifetime value?',
                'description' => 'Assess long-term customer relationships and their impact on revenue.',
                'recommendation' => 'Launch a formal customer retention and loyalty program. Measure NPS quarterly and create exclusivity benefits for long-term customers.',
            ],
            [
                'pillar' => 'Einfluss',
                'question' => 'Do you have strong strategic partnerships that actively contribute to your growth?',
                'description' => 'Evaluate the quality and strategic value of your current partnerships and alliances.',
                'recommendation' => 'Identify 5-10 potential co-marketing or referral partners in adjacent markets. Build a structured partner program with clear incentives and co-branded material.',
            ],

            // ── VERMÄCHTNIS (Legacy) ──────────────────────────────────
            [
                'pillar' => 'Vermächtnis',
                'question' => 'Is your company culture positive, clearly defined, and consistently lived?',
                'description' => 'Assess the health, alignment, and deliberateness of your organizational culture.',
                'recommendation' => 'Document your core values and conduct a culture audit. Run quarterly anonymous employee sentiment surveys and create a culture committee to drive improvements.',
            ],
            [
                'pillar' => 'Vermächtnis',
                'question' => 'Does your business create a measurable positive impact on your community or society?',
                'description' => 'Evaluate your company\'s social and environmental responsibility efforts.',
                'recommendation' => 'Define a Social Impact Goal as part of your company strategy. Consider CSR initiatives, sustainability practices, or pro-bono work for causes aligned with your values.',
            ],
            [
                'pillar' => 'Vermächtnis',
                'question' => 'Do you have a clear, documented vision and strategic plan for the next 10+ years?',
                'description' => 'Assess the clarity and ambition of your long-term company vision and strategic roadmap.',
                'recommendation' => 'Run a Vision & Mission workshop with your leadership team. Document a 10-year BHAG (Big Hairy Audacious Goal) and translate it into 3-year, 1-year, and quarterly milestones.',
            ],
            [
                'pillar' => 'Vermächtnis',
                'question' => 'Is there a documented succession plan for key leadership roles?',
                'description' => 'Evaluate whether the business can continue and grow beyond the current leadership team.',
                'recommendation' => 'Identify high-potential internal candidates for key roles. Create individual development plans and begin a structured mentoring program for future leaders.',
            ],
            [
                'pillar' => 'Vermächtnis',
                'question' => 'Are your team members genuinely fulfilled, growing, and committed to the company\'s mission?',
                'description' => 'Assess employee fulfillment, motivation, and alignment with the company\'s long-term purpose.',
                'recommendation' => 'Implement regular 1-on-1s focused on career development. Create clear growth paths, invest in continuous learning budgets, and celebrate team achievements publicly.',
            ],
        ];

        $questionOrder = 1;
        foreach ($questions as $q) {
            DB::table('audit_questions')->insert([
                'template_id' => $templateId,
                'pillar_id' => $pillarIds[$q['pillar']],
                'level' => $q['pillar'],
                'question' => $q['question'],
                'description' => $q['description'],
                'question_type' => 'scale_1_to_5',
                'weight' => 1.0,
                'is_required' => true,
                'failure_recommendation' => $q['recommendation'],
                'options' => null,
                'depends_on_question_id' => null,
                'depends_on_answer' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $questionOrder++;
        }

        // ============================================================
        // 4. Create a demo Organization and Admin User
        // ============================================================
        $orgId = DB::table('organizations')->insertGetId([
            'name' => 'Demo Company GmbH',
            'industry' => 'Consulting',
            'size' => '10-50',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@auditpro.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'organization_id' => $orgId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
