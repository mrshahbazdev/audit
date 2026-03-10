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
            // ── REVENUE / UMSATZ ─────────────────────────────────────
            [
                'pillar' => 'Umsatz',
                'question' => 'The required monthly revenue is defined and realistically planned.',
                'description' => 'Revenue Requirement: Does the business have a clearly defined monthly revenue target based on actual cost structure and market reality?',
                'recommendation' => 'Define a specific monthly revenue goal based on fixed costs + profit margin target. Break it down to weekly targets and review it every month with your team.',
            ],
            [
                'pillar' => 'Umsatz',
                'question' => 'Suitable prospects are reached continuously.',
                'description' => 'Lead Quality: Does the company have a reliable, active system for consistently attracting qualified prospects — not just occasional campaigns?',
                'recommendation' => 'Build a consistent lead generation engine (e.g., content marketing, outbound outreach, referral program). The emphasis is on CONTINUOUS, not one-off campaigns.',
            ],
            [
                'pillar' => 'Umsatz',
                'question' => 'A sufficient share of leads is converted into customers.',
                'description' => 'Closing Rate: Is the conversion rate from prospect to paying customer high enough to meet the planned monthly revenue goal?',
                'recommendation' => 'Analyze your sales funnel for drop-off points. Improve the offer, the sales conversation, or the follow-up process to convert a higher share of leads.',
            ],
            [
                'pillar' => 'Umsatz',
                'question' => 'Services/deliveries are provided as promised.',
                'description' => 'Delivery Reliability: Does the company consistently deliver what was sold — on time, at the agreed quality, and without cutting corners?',
                'recommendation' => 'Document your delivery/fulfillment process. Put quality checkpoints in place to ensure every client receives exactly what was promised.',
            ],
            [
                'pillar' => 'Umsatz',
                'question' => 'Customers meet payment and cooperation obligations.',
                'description' => 'Contract Compliance: Do customers pay on time and cooperate as required so the service can be completed smoothly?',
                'recommendation' => 'Introduce clear payment terms and enforceable contracts. Set up automated payment reminders and define client onboarding steps for smooth cooperation.',
            ],

            // ── PROFIT / GEWINN ───────────────────────────────────────
            [
                'pillar'         => 'Gewinn',
                'question'       => 'Existing liabilities are systematically reduced; no risky new debt.',
                'description'    => 'Debt Management: Is the company actively reducing debt and avoiding new liabilities that could threaten business stability?',
                'recommendation' => 'Create a debt reduction plan with monthly targets. Before taking on any new financing, evaluate the predictable ROI to ensure it is not risky speculation.',
            ],
            [
                'pillar'         => 'Gewinn',
                'question'       => 'Contribution margins are healthy and actively improved.',
                'description'    => 'Margin: Are the margins on products/services high enough to cover overhead and generate real profit — and is the team actively working to improve them?',
                'recommendation' => 'Calculate the contribution margin per product/service line. Identify your lowest-margin offerings and either reprice, restructure, or discontinue them.',
            ],
            [
                'pillar'         => 'Gewinn',
                'question'       => 'Customers make repeat purchases regularly.',
                'description'    => 'Repeat Purchases: Does the business have strong repeat purchase behavior, indicating genuine customer satisfaction and long-term value?',
                'recommendation' => 'Track repeat purchase rate monthly. Implement a loyalty or subscription model and use targeted follow-up communication to bring customers back.',
            ],
            [
                'pillar'         => 'Gewinn',
                'question'       => 'Investments are made selectively for predictable returns.',
                'description'    => 'Investment Logic: Are business investments made based on clear ROI calculations rather than impulse or trend-following?',
                'recommendation' => 'Before any significant investment, create a simple ROI forecast. Compare expected return vs. cost and establish a minimum payback period rule for all spending.',
            ],
            [
                'pillar'         => 'Gewinn',
                'question'       => 'Liquidity reserves cover several months of costs.',
                'description'    => 'Reserves: Does the company maintain a financial buffer sufficient to cover multiple months of operating costs in case of revenue disruption?',
                'recommendation' => 'Set a target to maintain 3-6 months of operating expenses in a liquid reserve. Automate a monthly percentage transfer of revenue into a dedicated reserve account.',
            ],

            // ── ORDER / ORDNUNG ───────────────────────────────────────
            [
                'pillar'         => 'Ordnung',
                'question'       => 'Bottlenecks and waste are continuously identified and reduced.',
                'description'    => 'Process Efficiency: Does the team actively look for inefficiencies in workflows and take measurable action to eliminate them on an ongoing basis?',
                'recommendation' => 'Run a monthly process audit. Map your core workflows and identify the single biggest bottleneck. Eliminate or automate one waste point per month.',
            ],
            [
                'pillar'         => 'Ordnung',
                'question'       => 'Tasks are assigned according to strengths and competencies.',
                'description'    => 'Role Fit: Are roles designed so that each person works primarily in their area of strength, leading to higher quality output and greater fulfillment?',
                'recommendation' => 'Conduct a strengths assessment for all team members. Reassign recurring tasks to those best suited for them. Review role fit quarterly.',
            ],
            [
                'pillar'         => 'Ordnung',
                'question'       => 'The directly affected people can solve problems independently.',
                'description'    => 'Outcome Ownership: Are employees empowered and capable of resolving issues within their domain without always escalating to management?',
                'recommendation' => 'Define clear decision-making boundaries per role. Train team members in structured problem-solving. Celebrate autonomous decisions to reinforce the behavior.',
            ],
            [
                'pillar'         => 'Ordnung',
                'question'       => 'Processes function even when key individuals are absent.',
                'description'    => 'Substitutability: Are all critical processes documented and shared so the business does not grind to a halt when a key person is unavailable?',
                'recommendation' => 'Document all critical processes in a shared SOP library. Cross-train at least one backup person for every key function in the business.',
            ],
            [
                'pillar'         => 'Ordnung',
                'question'       => 'The company consistently delivers high quality and builds reputation.',
                'description'    => 'Professional Quality: Is quality control embedded in the delivery process so that every client experience reinforces a reputation for excellence?',
                'recommendation' => 'Define quality standards for each deliverable. Implement a post-delivery review checklist and track client satisfaction scores to systematically improve.',
            ],

            // ── IMPACT / EINFLUSS ─────────────────────────────────────
            [
                'pillar'         => 'Einfluss',
                'question'       => 'Customers achieve noticeable improvements beyond the transaction.',
                'description'    => 'Customer Transformation: Does the company create measurable, meaningful change in its customers\' lives or businesses — not just fulfill a transaction?',
                'recommendation' => 'Define the transformation your service creates. Collect before/after data or testimonials from clients and use this evidence to sharpen your positioning.',
            ],
            [
                'pillar'         => 'Einfluss',
                'question'       => 'Employees are motivated by purpose and mission.',
                'description'    => 'Mission Driver: Are team members genuinely driven by the company\'s mission — beyond just their paycheck — fueling higher performance and retention?',
                'recommendation' => 'Clarify and communicate your company\'s mission and impact story. Connect each role to the bigger purpose in regular team meetings and onboarding materials.',
            ],
            [
                'pillar'         => 'Einfluss',
                'question'       => 'Employees\' personal goals align with the company vision.',
                'description'    => 'Goal Alignment: Are individual employees\' career and personal goals understood and deliberately aligned with the company\'s direction?',
                'recommendation' => 'Conduct quarterly 1-on-1s that include personal goal discovery. Create development paths that serve both the company\'s needs and the employee\'s ambitions.',
            ],
            [
                'pillar'         => 'Einfluss',
                'question'       => 'Critical and positive feedback is actively sought and used.',
                'description'    => 'Feedback Culture: Does the organization have formal mechanisms to gather honest internal and external feedback, and does leadership act on it?',
                'recommendation' => 'Implement quarterly NPS surveys for customers and anonymous pulse surveys for employees. Create a feedback review agenda item in leadership meetings.',
            ],
            [
                'pillar'         => 'Einfluss',
                'question'       => 'Cooperations (including with competitors) improve the customer experience.',
                'description'    => 'Partner Network: Has the company built cross-industry or even cross-competitor partnerships that create additional value for customers?',
                'recommendation' => 'Map the customer journey and identify where complementary partners could improve the experience. Reach out to 3 potential partners this quarter with a co-value proposal.',
            ],

            // ── LEGACY / VERMÄCHTNIS ──────────────────────────────────
            [
                'pillar'         => 'Vermächtnis',
                'question'       => 'Customers support the company long-term and recommend it.',
                'description'    => 'Customer Community: Do customers evolve into long-term advocates who actively refer others — forming a self-reinforcing community around the brand?',
                'recommendation' => 'Launch a referral or ambassador program. Create exclusive community spaces (events, groups) for loyal clients that reinforce belonging and advocacy.',
            ],
            [
                'pillar'         => 'Vermächtnis',
                'question'       => 'Leadership transitions are planned and practiced.',
                'description'    => 'Succession Planning: Is there a documented, tested plan for leadership handover so the business can thrive beyond the current founders or key leaders?',
                'recommendation' => 'Identify and develop 1-2 internal successors for each key leadership role. Create structured mentoring and gradually delegate increasing levels of responsibility.',
            ],
            [
                'pillar'         => 'Vermächtnis',
                'question'       => 'People engage out of conviction — internally and externally.',
                'description'    => 'Voluntary Supporters: Does the company attract people — employees, customers, and partners — who engage genuinely out of belief in the mission, not just obligation?',
                'recommendation' => 'Articulate your WHY clearly. Share your mission story publicly. Create opt-in community experiences that attract passionate people who want to co-create your future.',
            ],
            [
                'pillar'         => 'Vermächtnis',
                'question'       => 'Regular alignment with a long-term vision.',
                'description'    => 'Quarterly Focus: Does the leadership team regularly review and align all activities with the long-term company vision on a structured quarterly basis?',
                'recommendation' => 'Implement a quarterly planning rhythm (e.g., OKRs). Hold a dedicated quarterly review and planning session to align the team and reset priorities.',
            ],
            [
                'pillar'         => 'Vermächtnis',
                'question'       => 'The organization continuously learns and improves systemically.',
                'description'    => 'Continuous Adaptation: Is the company built to learn — with feedback loops, retrospectives, and improvement processes embedded in how it operates?',
                'recommendation' => 'Build a culture of systematic learning: monthly retrospectives, post-mortems on failures, and a shared knowledge base. Track one key improvement initiative per quarter.',
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
