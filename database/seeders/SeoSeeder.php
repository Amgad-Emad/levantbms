<?php

namespace Database\Seeders;

use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

/**
 * Per-page SEO defaults derived from seo-aeo-analysis-levantbms.xlsx.
 *
 * Strategy: lead with the MOIC Professional Body credential (the unique
 * authority signal no competitor holds), the Bahrain Financial Harbour
 * location, and the 20+ year track record — on every page.
 */
class SeoSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'default' => [
                'title' => ['en' => 'LevantBMS — Licensed Business Setup in Bahrain', 'ar' => 'ليفانت — تأسيس الأعمال المرخّص في البحرين'],
                'description' => [
                    'en' => 'MOIC-Licensed Professional Body since 2003. Company formation, CR registration, corporate advisory and CBB approvals from Bahrain Financial Harbour. 20+ years.',
                    'ar' => 'مكتب معتمد من وزارة الصناعة والتجارة منذ 2003. تأسيس الشركات والسجل التجاري والاستشارات والموافقات من مرفأ البحرين المالي. أكثر من 20 عامًا.',
                ],
                'keywords' => ['en' => 'business setup bahrain, company formation bahrain, MOIC licensed consultant bahrain', 'ar' => 'تأسيس الأعمال البحرين، تأسيس الشركات البحرين، مكتب معتمد'],
            ],
            'home' => [
                'title' => ['en' => 'Licensed Business Setup in Bahrain — MOIC Professional Body', 'ar' => 'تأسيس الأعمال المرخّص في البحرين — مكتب معتمد'],
                'description' => [
                    'en' => 'MOIC-Licensed Professional Body since 2003 handling company setup, CR registration, IPOs and Central Bank of Bahrain approvals from inside Bahrain Financial Harbour. 20+ years.',
                    'ar' => 'مكتب معتمد من وزارة الصناعة والتجارة منذ 2003 لتأسيس الشركات والسجل التجاري والاكتتابات وموافقات مصرف البحرين المركزي من مرفأ البحرين المالي. أكثر من 20 عامًا.',
                ],
                'keywords' => ['en' => 'business setup bahrain, company formation bahrain, company registration bahrain, commercial registration bahrain, moic licensed business consultant bahrain', 'ar' => 'تأسيس الأعمال في البحرين، تأسيس شركة في البحرين، السجل التجاري البحرين'],
            ],
            'about' => [
                'title' => ['en' => 'About LevantBMS — 20+ Years, MOIC Professional Body', 'ar' => 'عن ليفانت — أكثر من 20 عامًا، مكتب معتمد'],
                'description' => [
                    'en' => 'A Bahrain Financial Harbour consultancy recognized by the Ministry of Industry & Commerce. Twenty years guiding founders, banks and family enterprises.',
                    'ar' => 'استشارات في مرفأ البحرين المالي معتمدة من وزارة الصناعة والتجارة. عشرون عامًا في إرشاد المؤسسين والبنوك والشركات العائلية.',
                ],
                'keywords' => ['en' => 'business consultancy bahrain, moic professional body, levantbms about', 'ar' => 'استشارات الأعمال البحرين، مكتب معتمد'],
            ],
            'services' => [
                'title' => ['en' => 'Company Setup & Corporate Advisory in Bahrain | LevantBMS', 'ar' => 'تأسيس الشركات والاستشارات في البحرين | ليفانت'],
                'description' => [
                    'en' => 'Company formation, CR changes, corporate governance, restructuring, IPO advisory and private placement — filed by an MOIC-authorized Professional Body.',
                    'ar' => 'تأسيس الشركات وتعديلات السجل والحوكمة وإعادة الهيكلة واستشارات الاكتتاب والطرح الخاص — يقدّمها مكتب معتمد من وزارة الصناعة والتجارة.',
                ],
                'keywords' => ['en' => 'company formation bahrain, cr registration bahrain, ipo advisory bahrain, corporate governance services bahrain, company restructuring bahrain', 'ar' => 'تأسيس الشركات البحرين، السجل التجاري، استشارات الاكتتاب'],
            ],
            'partners' => [
                'title' => ['en' => 'Global Partners & Platforms | LevantBMS Bahrain', 'ar' => 'الشركاء العالميون والمنصات | ليفانت'],
                'description' => [
                    'en' => 'The vendors and regulated platforms LevantBMS plugs into your business — from HR systems to trading infrastructure, with the relationships behind them.',
                    'ar' => 'المنصات والشركاء المنظَّمون الذين يدمجهم ليفانت في أعمالك — من أنظمة الموارد البشرية إلى بنية التداول.',
                ],
                'keywords' => ['en' => 'levantbms partners bahrain, business platforms bahrain', 'ar' => 'شركاء ليفانت، منصات الأعمال البحرين'],
            ],
            'gallery' => [
                'title' => ['en' => 'Our Office at Bahrain Financial Harbour | LevantBMS', 'ar' => 'مكتبنا في مرفأ البحرين المالي | ليفانت'],
                'description' => [
                    'en' => 'Inside LevantBMS — our Bahrain Financial Harbour office, the harbour, and the team, directly opposite the Ministry of Industry & Commerce.',
                    'ar' => 'من داخل ليفانت — مكتبنا في مرفأ البحرين المالي والفريق، مقابل وزارة الصناعة والتجارة مباشرة.',
                ],
                'keywords' => ['en' => 'levantbms office bahrain financial harbour', 'ar' => 'مكتب ليفانت مرفأ البحرين المالي'],
            ],
            'faqs' => [
                'title' => ['en' => 'Bahrain Company Formation FAQs — Costs, Ownership, Timelines', 'ar' => 'الأسئلة الشائعة حول تأسيس الشركات في البحرين'],
                'description' => [
                    'en' => 'Answers from an MOIC-licensed Professional Body: how long CR registration takes, what it costs, 100% foreign ownership, local sponsor rules and more.',
                    'ar' => 'إجابات من مكتب معتمد: مدة تسجيل السجل التجاري وتكلفته، التملك الأجنبي الكامل، شروط الكفيل المحلي والمزيد.',
                ],
                'keywords' => ['en' => 'cost of company formation bahrain, can foreigners own 100% company bahrain, how long company registration bahrain, do i need a local partner bahrain', 'ar' => 'تكلفة تأسيس شركة البحرين، التملك الأجنبي الكامل البحرين'],
            ],
            'blog' => [
                'title' => ['en' => 'Bahrain Business & Company Formation Insights | LevantBMS', 'ar' => 'رؤى تأسيس الأعمال والشركات في البحرين | ليفانت'],
                'description' => [
                    'en' => 'Field notes from a licensed Bahrain consultancy on company formation, regulation, costs and doing business in the Kingdom.',
                    'ar' => 'ملاحظات من استشارات بحرينية مرخّصة حول تأسيس الشركات والتنظيم والتكاليف وممارسة الأعمال في المملكة.',
                ],
                'keywords' => ['en' => 'how to register a company in bahrain, cost of company formation in bahrain, steps to start business in bahrain', 'ar' => 'كيفية تسجيل شركة في البحرين، خطوات بدء عمل في البحرين'],
            ],
            'contact' => [
                'title' => ['en' => 'Contact LevantBMS — Bahrain Financial Harbour', 'ar' => 'تواصل مع ليفانت — مرفأ البحرين المالي'],
                'description' => [
                    'en' => 'Talk to an MOIC-licensed consultant. WhatsApp, call or visit our Bahrain Financial Harbour office — usually a same-working-day reply from a senior consultant.',
                    'ar' => 'تواصل مع مستشار من مكتب معتمد. واتساب أو اتصال أو زيارة مكتبنا في مرفأ البحرين المالي — رد عادةً خلال يوم العمل.',
                ],
                'keywords' => ['en' => 'contact levantbms, business consultant bahrain contact', 'ar' => 'تواصل ليفانت، مستشار أعمال البحرين'],
            ],
        ];

        foreach ($pages as $page => $data) {
            SeoMeta::updateOrCreate(
                ['page' => $page],
                [
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'keywords' => $data['keywords'],
                    'robots' => 'index, follow',
                ]
            );
        }
    }
}
