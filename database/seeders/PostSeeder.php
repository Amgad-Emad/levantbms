<?php

namespace Database\Seeders;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Real LevantBMS blog posts (source: levantbms.com/blog) — all 12, bilingual.
 */
class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::query()->delete();

        foreach ($this->posts() as $i => $p) {
            Post::create([
                'slug' => $p['slug'],
                'category' => $p['category'],
                'read_minutes' => $p['read'],
                'is_featured' => $p['featured'] ?? false,
                'is_published' => true,
                'published_at' => Carbon::parse($p['date']),
                'title' => ['en' => $p['title_en'], 'ar' => $p['title_ar']],
                'excerpt' => ['en' => $p['excerpt_en'], 'ar' => $p['excerpt_ar']],
                'body' => ['en' => $p['body_en'], 'ar' => $p['body_ar']],
                'position' => $i,
            ]);
        }
    }

    protected function posts(): array
    {
        // Blogs 7, 8 & 9 share the same "15 reasons to invest" content on the source site.
        [$invest15En, $invest15Ar] = $this->invest15();

        return [
            [
                'slug' => 'top-business-management-consultancy-in-bahrain',
                'category' => 'Guides', 'read' => 8, 'featured' => true, 'date' => '2025-09-16',
                'title_en' => 'Top Business Management Consultancy in Bahrain',
                'title_ar' => 'أفضل استشارات إدارة الأعمال في البحرين',
                'excerpt_en' => 'Setting up a company is only the beginning. Here is how business management consultancy helps Bahraini firms manage operations, stay compliant, and sustain growth.',
                'excerpt_ar' => 'تأسيس الشركة ليس سوى البداية. إليك كيف تساعد استشارات إدارة الأعمال الشركات في البحرين على إدارة عملياتها والامتثال واستدامة النمو.',
                'body_en' => <<<'HTML'
<p>Bahrain has become a dynamic hub for entrepreneurs and investors across the GCC. Setting up a company is only the beginning — the real challenge is managing operations, building resilience, and sustaining growth in a competitive market. This is where business management consultancy comes in.</p>
<h2>Why businesses need more than just setup</h2>
<p>Common post-setup challenges include inefficient processes that reduce profitability, struggles with compliance and regulatory updates, weak financial planning, and difficulty scaling into new sectors or markets.</p>
<h2>The role of business management consultancy in Bahrain</h2>
<ul>
<li><strong>Strategic planning &amp; execution</strong> — turning big-picture goals into actionable roadmaps with measurable KPIs.</li>
<li><strong>Operational efficiency</strong> — streamlining workflows, reducing costs, and enhancing productivity for SMEs and corporations.</li>
<li><strong>Governance &amp; compliance</strong> — strengthening internal controls, risk management, and audit readiness to meet MOIC and CBB standards.</li>
<li><strong>Financial forecasting &amp; performance management</strong> — budgeting, forecasting, and dashboard reporting for better decision-making.</li>
<li><strong>Market expansion &amp; feasibility</strong> — evidence-based analysis to support expansion into new industries or regions.</li>
</ul>
<h2>How consultants drive growth</h2>
<ul>
<li><strong>Startups:</strong> scalable models, investor-ready governance, and stronger financial planning.</li>
<li><strong>SMEs:</strong> cash-flow controls, digital reporting tools, and process improvements.</li>
<li><strong>Corporations:</strong> compliance frameworks, transformation projects, and improved governance.</li>
</ul>
<h2>The consultancy process</h2>
<p>Discovery &amp; assessment → strategy roadmap → implementation support → ongoing advisory.</p>
<h2>Why LevantBMS</h2>
<p>23+ years of experience, local insight paired with global expertise, tailored solutions for businesses of every size, technology-driven insights, and end-to-end support.</p>
<h2>Frequently asked questions</h2>
<h3>Are management consultants worth it?</h3>
<p>Yes — they provide expert guidance and help you achieve sustainable growth.</p>
<h3>Which is the best consultancy in Bahrain?</h3>
<p>LevantBMS, with 23+ years of legal and corporate experience.</p>
<h3>Do SMEs need consultancy?</h3>
<p>Yes — structured processes, better forecasting, and compliance support.</p>
<h3>Can consultancy help with compliance?</h3>
<p>Yes — consultants strengthen governance and reporting systems.</p>
<h3>What results should I expect?</h3>
<p>Clear KPIs, stronger processes, better financial visibility, and improved long-term growth.</p>
HTML,
                'body_ar' => <<<'HTML'
<p>أصبحت البحرين مركزًا حيويًا لرواد الأعمال والمستثمرين في منطقة الخليج. وتأسيس الشركة ليس سوى البداية — أما التحدي الحقيقي فهو إدارة العمليات وبناء المرونة واستدامة النمو في سوق تنافسية. وهنا يأتي دور استشارات إدارة الأعمال.</p>
<h2>لماذا تحتاج الشركات إلى ما هو أبعد من التأسيس</h2>
<p>من التحديات الشائعة بعد التأسيس: العمليات غير الفعّالة التي تقلّل الربحية، وصعوبة مواكبة الامتثال والتحديثات التنظيمية، وضعف التخطيط المالي، وصعوبة التوسّع إلى قطاعات أو أسواق جديدة.</p>
<h2>دور استشارات إدارة الأعمال في البحرين</h2>
<ul>
<li><strong>التخطيط الاستراتيجي والتنفيذ</strong> — تحويل الأهداف الكبرى إلى خطط عملية بمؤشرات أداء قابلة للقياس.</li>
<li><strong>الكفاءة التشغيلية</strong> — تبسيط سير العمل وخفض التكاليف وتعزيز الإنتاجية للشركات الصغيرة والكبيرة.</li>
<li><strong>الحوكمة والامتثال</strong> — تعزيز الضوابط الداخلية وإدارة المخاطر والجاهزية للتدقيق وفق معايير الوزارة والمصرف المركزي.</li>
<li><strong>التنبؤ المالي وإدارة الأداء</strong> — إعداد الموازنات والتنبؤات وتقارير لوحات المؤشرات لاتخاذ قرارات أفضل.</li>
<li><strong>التوسّع في السوق ودراسات الجدوى</strong> — تحليل قائم على الأدلة لدعم التوسّع في صناعات أو مناطق جديدة.</li>
</ul>
<h2>كيف يقود المستشارون النمو</h2>
<ul>
<li><strong>الشركات الناشئة:</strong> نماذج قابلة للتوسّع، وحوكمة جاهزة للمستثمرين، وتخطيط مالي أقوى.</li>
<li><strong>الشركات الصغيرة والمتوسطة:</strong> ضبط التدفقات النقدية، وأدوات تقارير رقمية، وتحسين العمليات.</li>
<li><strong>الشركات الكبرى:</strong> أطر امتثال، ومشاريع تحوّل، وحوكمة محسّنة.</li>
</ul>
<h2>مسار العمل الاستشاري</h2>
<p>الاكتشاف والتقييم ← خارطة الطريق الاستراتيجية ← دعم التنفيذ ← الاستشارة المستمرة.</p>
<h2>لماذا ليفانت</h2>
<p>أكثر من 23 عامًا من الخبرة، ورؤية محلية مقترنة بخبرة عالمية، وحلول مصمّمة لكل الأحجام، ورؤى مدعومة بالتقنية، ودعم شامل من البداية إلى النهاية.</p>
<h2>الأسئلة الشائعة</h2>
<h3>هل تستحق الاستعانة بمستشاري الإدارة؟</h3>
<p>نعم — فهم يقدّمون إرشادًا متخصصًا ويساعدونك على تحقيق نمو مستدام.</p>
<h3>ما أفضل جهة استشارية في البحرين؟</h3>
<p>ليفانت، بخبرة قانونية ومؤسسية تتجاوز 23 عامًا.</p>
<h3>هل تحتاج الشركات الصغيرة والمتوسطة إلى استشارات؟</h3>
<p>نعم — عمليات منظَّمة، وتنبؤ أفضل، ودعم في الامتثال.</p>
<h3>هل تساعد الاستشارات في الامتثال؟</h3>
<p>نعم — يعزّز المستشارون أنظمة الحوكمة وإعداد التقارير.</p>
<h3>ما النتائج المتوقعة؟</h3>
<p>مؤشرات أداء واضحة، وعمليات أقوى، ووضوح مالي أفضل، ونمو طويل الأمد محسّن.</p>
HTML,
            ],

            [
                'slug' => 'how-to-invest-in-bahrain-investment-advice-in-bahrain',
                'category' => 'Investment', 'read' => 11, 'date' => '2025-08-26',
                'title_en' => 'How to Invest in Bahrain — Investment Advice in Bahrain',
                'title_ar' => 'كيف تستثمر في البحرين — نصائح استثمارية في البحرين',
                'excerpt_en' => 'Central location, competitive costs, and a modern regulatory framework make Bahrain one of the Gulf\'s most welcoming destinations for global investors.',
                'excerpt_ar' => 'الموقع المركزي والتكاليف التنافسية والإطار التنظيمي الحديث تجعل البحرين من أكثر وجهات الخليج ترحيبًا بالمستثمرين العالميين.',
                'body_en' => <<<'HTML'
<p>Bahrain is one of the Gulf's most welcoming destinations for global investors, offering a central location, competitive costs, and a modern regulatory framework. LevantBMS provides professional investment advice aligned with Bahrain's Vision 2030.</p>
<h2>Why Bahrain is attractive</h2>
<ul>
<li>100% foreign ownership available in most sectors.</li>
<li>No personal income tax and no general corporate income tax (except oil &amp; gas).</li>
<li>10% VAT only mandatory if annual turnover exceeds BD 37,500.</li>
</ul>
<h2>Investment incentives snapshot</h2>
<ul>
<li>100% foreign ownership in most sectors.</li>
<li>No personal or corporate income tax (outside oil &amp; gas).</li>
<li>Free zones with customs exemptions and streamlined logistics.</li>
<li>Tamkeen workforce subsidies for training and hiring.</li>
<li>US–Bahrain Free Trade Agreement and GCC market access.</li>
</ul>
<h2>Key sectors for investment</h2>
<ul>
<li><strong>Financial services &amp; fintech</strong> — the oldest financial hub in the Gulf.</li>
<li><strong>ICT &amp; software</strong> — cloud-friendly regulations and regional demand.</li>
<li><strong>Logistics &amp; advanced manufacturing</strong> — central Gulf location advantage.</li>
<li><strong>Tourism, retail &amp; luxury</strong> — rising purchasing power.</li>
<li><strong>Real estate &amp; hospitality</strong> — ongoing market expansion.</li>
</ul>
<h2>Why professional investment advice matters</h2>
<p>Compliance, market-entry planning, financial structuring, and risk management — handled correctly from day one.</p>
<h2>Risks &amp; mitigation</h2>
<p>Regulatory updates and Bahrainization quotas are the main considerations. LevantBMS mitigates these by pre-clearing with regulators and preparing compliance-ready documentation.</p>
<h2>Regulatory pillars</h2>
<ul>
<li><strong>MOIC</strong> — licensing.</li>
<li><strong>Central Bank of Bahrain</strong> — regulated companies.</li>
<li><strong>EDB</strong> — investor intelligence.</li>
<li><strong>Tamkeen</strong> — workforce support.</li>
</ul>
<h2>How LevantBMS supports investors</h2>
<ul>
<li>Market-entry strategy and entity structuring.</li>
<li>Regulatory mapping for sector-specific licenses.</li>
<li>Banking, tax compliance, and KYC preparation.</li>
<li>Access to Tamkeen, free zones, and FTA benefits.</li>
<li>Talent, workforce, and LMRA compliance.</li>
<li>An ongoing compliance calendar for CR renewals, VAT filings, and board obligations.</li>
</ul>
<h2>Due-diligence checklist</h2>
<ul>
<li>Correct activity licenses.</li>
<li>Beneficial-ownership documentation.</li>
<li>VAT systems in place.</li>
<li>Contracts compliant with Bahraini law.</li>
<li>Awareness of sector-specific requirements.</li>
</ul>
<h2>Frequently asked questions</h2>
<h3>Is Bahrain safe for foreign investors?</h3>
<p>Yes — political and economic stability with transparent regulatory frameworks.</p>
<h3>What incentives exist?</h3>
<p>100% ownership, no income tax, free-zone exemptions, Tamkeen subsidies, and the US–Bahrain FTA.</p>
<h3>Can I repatriate profits?</h3>
<p>Yes — full repatriation with no capital controls.</p>
<h3>Bahrain vs. Dubai or Riyadh?</h3>
<p>Bahrain has lower operating costs and faster licensing; Dubai and Riyadh offer larger market size.</p>
<h3>What risks should I prepare for?</h3>
<p>Banking KYC delays, Bahrainization quotas, and OECD Pillar Two reforms.</p>
HTML,
                'body_ar' => <<<'HTML'
<p>البحرين من أكثر وجهات الخليج ترحيبًا بالمستثمرين العالميين، إذ تجمع بين موقع مركزي وتكاليف تنافسية وإطار تنظيمي حديث. وتقدّم ليفانت استشارات استثمارية احترافية متوافقة مع رؤية البحرين 2030.</p>
<h2>لماذا البحرين جاذبة</h2>
<ul>
<li>تملّك أجنبي بنسبة 100% في معظم القطاعات.</li>
<li>لا ضريبة دخل على الأفراد ولا ضريبة دخل عامة على الشركات (باستثناء النفط والغاز).</li>
<li>ضريبة قيمة مضافة 10% إلزامية فقط إذا تجاوز الدوران السنوي 37,500 دينار.</li>
</ul>
<h2>لمحة عن حوافز الاستثمار</h2>
<ul>
<li>تملّك أجنبي 100% في معظم القطاعات.</li>
<li>لا ضريبة دخل على الأفراد أو الشركات (خارج النفط والغاز).</li>
<li>مناطق حرة بإعفاءات جمركية ولوجستيات ميسّرة.</li>
<li>دعم «تمكين» للتدريب والتوظيف.</li>
<li>اتفاقية التجارة الحرة بين البحرين والولايات المتحدة، والوصول إلى سوق الخليج.</li>
</ul>
<h2>أبرز قطاعات الاستثمار</h2>
<ul>
<li><strong>الخدمات المالية والتقنية المالية</strong> — أقدم مركز مالي في الخليج.</li>
<li><strong>تقنية المعلومات والبرمجيات</strong> — تنظيمات صديقة للحوسبة السحابية وطلب إقليمي.</li>
<li><strong>اللوجستيات والتصنيع المتقدّم</strong> — ميزة الموقع المركزي في الخليج.</li>
<li><strong>السياحة والتجزئة والكماليات</strong> — قوة شرائية متنامية.</li>
<li><strong>العقارات والضيافة</strong> — توسّع مستمر في السوق.</li>
</ul>
<h2>لماذا تهمّ الاستشارة الاستثمارية الاحترافية</h2>
<p>الامتثال، وتخطيط دخول السوق، والهيكلة المالية، وإدارة المخاطر — تُدار بالشكل الصحيح من اليوم الأول.</p>
<h2>المخاطر وسبل التخفيف</h2>
<p>التحديثات التنظيمية ونسب البحرنة هما الاعتباران الرئيسيان. وتخفّفهما ليفانت عبر التنسيق المسبق مع الجهات التنظيمية وإعداد مستندات جاهزة للامتثال.</p>
<h2>الركائز التنظيمية</h2>
<ul>
<li><strong>وزارة الصناعة والتجارة</strong> — الترخيص.</li>
<li><strong>مصرف البحرين المركزي</strong> — الشركات الخاضعة للرقابة.</li>
<li><strong>مجلس التنمية الاقتصادية</strong> — معلومات المستثمرين.</li>
<li><strong>تمكين</strong> — دعم القوى العاملة.</li>
</ul>
<h2>كيف تدعم ليفانت المستثمرين</h2>
<ul>
<li>استراتيجية دخول السوق وهيكلة الكيان.</li>
<li>رسم خريطة تنظيمية للتراخيص الخاصة بكل قطاع.</li>
<li>الخدمات المصرفية والامتثال الضريبي وإعداد متطلبات «اعرف عميلك».</li>
<li>الوصول إلى مزايا «تمكين» والمناطق الحرة واتفاقية التجارة الحرة.</li>
<li>الامتثال المتعلق بالكفاءات والقوى العاملة وهيئة تنظيم سوق العمل.</li>
<li>تقويم امتثال مستمر لتجديد السجلات وإقرارات ضريبة القيمة المضافة والتزامات المجلس.</li>
</ul>
<h2>قائمة العناية الواجبة</h2>
<ul>
<li>تراخيص الأنشطة الصحيحة.</li>
<li>توثيق الملكية المستفيدة.</li>
<li>أنظمة ضريبة القيمة المضافة جاهزة.</li>
<li>عقود متوافقة مع القانون البحريني.</li>
<li>الوعي بمتطلبات كل قطاع.</li>
</ul>
<h2>الأسئلة الشائعة</h2>
<h3>هل البحرين آمنة للمستثمرين الأجانب؟</h3>
<p>نعم — استقرار سياسي واقتصادي مع أطر تنظيمية شفافة.</p>
<h3>ما الحوافز المتاحة؟</h3>
<p>تملّك 100%، ولا ضريبة دخل، وإعفاءات المناطق الحرة، ودعم «تمكين»، واتفاقية التجارة الحرة مع الولايات المتحدة.</p>
<h3>هل يمكنني تحويل الأرباح للخارج؟</h3>
<p>نعم — تحويل كامل دون قيود على رأس المال.</p>
<h3>البحرين مقابل دبي أو الرياض؟</h3>
<p>للبحرين تكاليف تشغيل أقل وترخيص أسرع؛ بينما توفّر دبي والرياض حجم سوق أكبر.</p>
<h3>ما المخاطر التي ينبغي الاستعداد لها؟</h3>
<p>تأخّر إجراءات «اعرف عميلك» المصرفية، ونسب البحرنة، وإصلاحات الركيزة الثانية لمنظمة التعاون الاقتصادي والتنمية.</p>
HTML,
            ],

            [
                'slug' => 'how-to-incorporate-a-company-in-bahrain-guide-2025',
                'category' => 'Company Setup', 'read' => 9, 'date' => '2025-08-23',
                'title_en' => 'How to Incorporate a Company in Bahrain — 2025 Guide',
                'title_ar' => 'كيفية تأسيس شركة في البحرين — دليل 2025',
                'excerpt_en' => 'Incorporating in Bahrain means creating a legally recognized entity under the Commercial Companies Law. Here are the requirements, entity types, costs and timelines.',
                'excerpt_ar' => 'يعني التأسيس في البحرين إنشاء كيان معترف به قانونًا وفق قانون الشركات التجارية. إليك المتطلبات وأنواع الكيانات والتكاليف والمدد الزمنية.',
                'body_en' => <<<'HTML'
<p>Incorporating in Bahrain means creating a legally recognized entity that complies with the Kingdom's Commercial Companies Law. LevantBMS handles all the legal and regulatory steps on your behalf.</p>
<h2>Requirements to incorporate</h2>
<ul>
<li>Passport copies for shareholders and directors.</li>
<li>Proposed trade name(s).</li>
<li>A business-activities list aligned with the Bahrain activity taxonomy.</li>
<li>Articles / Memorandum of Association drafted to local law.</li>
<li>A Bahrain address / lease.</li>
<li>Board resolution / power of attorney (for corporate shareholders).</li>
</ul>
<h2>Types of companies</h2>
<table>
<thead><tr><th>Entity</th><th>Ownership</th><th>Capital</th><th>Liability</th><th>Best for</th></tr></thead>
<tbody>
<tr><td>WLL (LLC)</td><td>1–50 shareholders, 100% foreign allowed</td><td>Flexible (≥ BD 50/share)</td><td>Limited</td><td>SMEs, consultancy, trading</td></tr>
<tr><td>BSC (Closed/Public)</td><td>Public/private shareholders</td><td>BD 250k–1m+</td><td>Limited</td><td>Large firms, IPOs, joint ventures</td></tr>
<tr><td>Branch</td><td>100% foreign-owned</td><td>No capital</td><td>Parent liable</td><td>Multinational expansions</td></tr>
<tr><td>Partnership</td><td>2+ partners</td><td>No minimum</td><td>Unlimited</td><td>Professional / legal services</td></tr>
</tbody>
</table>
<h2>Sijilat workflow</h2>
<p>Reserve trade name → match activities to the MOIC taxonomy → draft &amp; notarize MOA/AOA → upload to Sijilat &amp; pay fees → receive CR → obtain regulator approvals.</p>
<h2>Costs &amp; timelines</h2>
<p>Government fees depend on entity type and the number of activities. Typical timeline: 1–4 weeks for a WLL; longer for regulated activities.</p>
<h2>Visas</h2>
<ul>
<li><strong>Investor visa</strong> — for owners/directors.</li>
<li><strong>Employment visas</strong> — for staff.</li>
<li><strong>Dependent visas</strong> — for families.</li>
</ul>
<h2>Banking &amp; KYC</h2>
<p>You will need the CR, MOA/AOA, lease, shareholder passports, and a board resolution. Timeline: 1 day to 1 week — longer for foreign-heavy structures or regulated sectors. Key banks include BBK, NBB and Al Salam Bank.</p>
<h2>Frequently asked questions</h2>
<h3>Can foreigners own 100%?</h3><p>Yes.</p>
<h3>How long does incorporation take?</h3><p>1–4 weeks for WLLs; longer for regulated sectors.</p>
<h3>Which banking documents are required?</h3><p>CR, MOA/AOA, lease, passports, and board resolutions.</p>
<h3>Do I need a local sponsor?</h3><p>Not typically.</p>
<h3>Is there a nationality requirement?</h3><p>None.</p>
<h3>Is physical presence required?</h3><p>No — LevantBMS handles all steps with a power of attorney; investors must attend in person only for opening the bank account.</p>
HTML,
                'body_ar' => <<<'HTML'
<p>يعني التأسيس في البحرين إنشاء كيان معترف به قانونًا يمتثل لقانون الشركات التجارية في المملكة. وتتولّى ليفانت جميع الخطوات القانونية والتنظيمية نيابةً عنك.</p>
<h2>متطلبات التأسيس</h2>
<ul>
<li>صور جوازات سفر المساهمين والمديرين.</li>
<li>الاسم (الأسماء) التجارية المقترحة.</li>
<li>قائمة الأنشطة التجارية متوافقة مع تصنيف الأنشطة في البحرين.</li>
<li>عقد التأسيس والنظام الأساسي مصاغَين وفق القانون المحلي.</li>
<li>عنوان/عقد إيجار في البحرين.</li>
<li>قرار مجلس/توكيل (لمساهمي الشركات).</li>
</ul>
<h2>أنواع الشركات</h2>
<table>
<thead><tr><th>الكيان</th><th>الملكية</th><th>رأس المال</th><th>المسؤولية</th><th>الأنسب لـ</th></tr></thead>
<tbody>
<tr><td>ذ.م.م (WLL)</td><td>من 1 إلى 50 مساهمًا، تملّك أجنبي 100% مسموح</td><td>مرن (≥ 50 دينار/سهم)</td><td>محدودة</td><td>الشركات الصغيرة والاستشارات والتجارة</td></tr>
<tr><td>مساهمة (مقفلة/عامة)</td><td>مساهمون عامون/خاصون</td><td>250 ألف – مليون+ دينار</td><td>محدودة</td><td>الشركات الكبرى والاكتتابات والمشاريع المشتركة</td></tr>
<tr><td>فرع</td><td>مملوك أجنبيًا 100%</td><td>بدون رأس مال</td><td>الشركة الأم مسؤولة</td><td>توسّعات الشركات متعددة الجنسيات</td></tr>
<tr><td>شراكة</td><td>شريكان أو أكثر</td><td>بدون حد أدنى</td><td>غير محدودة</td><td>الخدمات المهنية/القانونية</td></tr>
</tbody>
</table>
<h2>مسار «سجلّات»</h2>
<p>حجز الاسم التجاري ← مطابقة الأنشطة مع تصنيف الوزارة ← صياغة وتوثيق عقد التأسيس والنظام الأساسي ← الرفع على «سجلّات» ودفع الرسوم ← استلام السجل التجاري ← الحصول على موافقات الجهات التنظيمية.</p>
<h2>التكاليف والمدد الزمنية</h2>
<p>تعتمد الرسوم الحكومية على نوع الكيان وعدد الأنشطة. المدة المعتادة: من أسبوع إلى أربعة أسابيع للشركة ذ.م.م؛ وأطول للأنشطة الخاضعة للرقابة.</p>
<h2>التأشيرات</h2>
<ul>
<li><strong>تأشيرة المستثمر</strong> — للمالكين/المديرين.</li>
<li><strong>تأشيرات العمل</strong> — للموظفين.</li>
<li><strong>تأشيرات المرافقين</strong> — للعائلات.</li>
</ul>
<h2>الخدمات المصرفية و«اعرف عميلك»</h2>
<p>ستحتاج إلى السجل التجاري وعقد التأسيس والنظام الأساسي وعقد الإيجار وجوازات المساهمين وقرار المجلس. المدة: من يوم إلى أسبوع — وأطول للهياكل ذات الملكية الأجنبية الكثيفة أو القطاعات الخاضعة للرقابة. ومن أبرز البنوك: BBK وNBB ومصرف السلام.</p>
<h2>الأسئلة الشائعة</h2>
<h3>هل يمكن للأجانب التملّك 100%؟</h3><p>نعم.</p>
<h3>كم يستغرق التأسيس؟</h3><p>من أسبوع إلى أربعة أسابيع للشركات ذ.م.م؛ وأطول للقطاعات الخاضعة للرقابة.</p>
<h3>ما المستندات المصرفية المطلوبة؟</h3><p>السجل التجاري وعقد التأسيس والنظام الأساسي وعقد الإيجار والجوازات وقرارات المجلس.</p>
<h3>هل أحتاج إلى كفيل محلي؟</h3><p>ليس عادةً.</p>
<h3>هل هناك شرط للجنسية؟</h3><p>لا يوجد.</p>
<h3>هل يلزم الحضور الشخصي؟</h3><p>لا — تتولّى ليفانت جميع الخطوات بموجب توكيل؛ ويُطلب حضور المستثمر شخصيًا فقط لفتح الحساب البنكي.</p>
HTML,
            ],

            [
                'slug' => 'how-to-start-a-business-in-bahrain-the-2025-guide',
                'category' => 'Company Setup', 'read' => 10, 'date' => '2025-08-20',
                'title_en' => 'How to Start a Business in Bahrain — The 2025 Guide',
                'title_ar' => 'كيف تبدأ عملًا في البحرين — دليل 2025',
                'excerpt_en' => '100% foreign ownership, digital setup via Sijilat, low taxes and direct access to a $2-trillion GCC economy — why Bahrain works for founders.',
                'excerpt_ar' => 'تملّك أجنبي 100%، وتأسيس رقمي عبر «سجلّات»، وضرائب منخفضة، ووصول مباشر إلى اقتصاد خليجي يتجاوز تريليوني دولار — لماذا تناسب البحرين المؤسسين.',
                'body_en' => <<<'HTML'
<h2>Why Bahrain works for founders</h2>
<ul>
<li>100% foreign ownership in most sectors — no local partner required.</li>
<li>Digital setup via the Sijilat portal — faster and less bureaucratic.</li>
<li>No personal income tax, 10% VAT, and no corporate tax outside oil &amp; gas.</li>
<li>Lower operating costs than Dubai or Doha.</li>
<li>Direct access to Saudi Arabia and a $2-trillion+ GCC economy.</li>
</ul>
<h2>Growth sectors</h2>
<ul>
<li><strong>FinTech Sandbox</strong> (run by the CBB) — for blockchain, payments and open-banking startups.</li>
<li><strong>ICT &amp; cloud</strong> — liberalized telecoms and strong data infrastructure for SaaS and AI.</li>
<li><strong>Logistics &amp; manufacturing</strong> and <strong>tourism &amp; retail</strong>.</li>
</ul>
<h2>The founder's ongoing compliance checklist</h2>
<ul>
<li>Maintain a corporate bank account with minimum balances.</li>
<li>File VAT returns on time (mandatory above BD 37,500 annually).</li>
<li>Renew the Commercial Registration (CR) annually.</li>
<li>Track LMRA visas and Bahrainization quotas.</li>
<li>Run compliant payroll and HR per Bahraini labor regulations.</li>
<li>Stay updated on global reforms (OECD Pillar Two).</li>
</ul>
<h2>Taxes &amp; VAT (2025)</h2>
<p>10% VAT, mandatory above BD 37,500; no corporate tax (except oil &amp; gas).</p>
<h2>The clear setup path</h2>
<p>Choose company structure → apply for CR via Sijilat → secure office lease → set up banking &amp; compliance → final licenses.</p>
<h2>Cost advantage</h2>
<p>Up to a 48% total cost advantage versus regional peers for operating a financial-services firm with a tech hub (EY, 2025).</p>
<h2>Bahrain vs. other hubs</h2>
<ul>
<li><strong>vs. UAE:</strong> a lower cost base — especially for financial-tech hubs — while keeping regional access.</li>
<li><strong>vs. Saudi Arabia:</strong> KSA offers larger market scale; Bahrain offers speed-to-license and ownership flexibility.</li>
</ul>
<h2>Frequently asked questions</h2>
<h3>How long does it take to start a business?</h3><p>2–4 weeks for a WLL; longer for regulated sectors.</p>
<h3>What are typical setup costs?</h3><p>CR fees (BD 196), notarization, plus an office lease.</p>
<h3>Can I run remotely with a Bahrain CR?</h3><p>Yes, but a physical local address is required.</p>
<h3>How does LMRA affect foreign hiring?</h3><p>It sets visa quotas and requires Bahrainization compliance and medical clearance.</p>
HTML,
                'body_ar' => <<<'HTML'
<h2>لماذا تناسب البحرين المؤسسين</h2>
<ul>
<li>تملّك أجنبي 100% في معظم القطاعات — دون حاجة إلى شريك محلي.</li>
<li>تأسيس رقمي عبر بوابة «سجلّات» — أسرع وأقل بيروقراطية.</li>
<li>لا ضريبة دخل على الأفراد، وضريبة قيمة مضافة 10%، ولا ضريبة شركات خارج النفط والغاز.</li>
<li>تكاليف تشغيل أقل من دبي أو الدوحة.</li>
<li>وصول مباشر إلى السعودية واقتصاد خليجي يتجاوز تريليوني دولار.</li>
</ul>
<h2>قطاعات النمو</h2>
<ul>
<li><strong>البيئة التجريبية للتقنية المالية</strong> (يديرها المصرف المركزي) — للبلوك تشين والمدفوعات والشركات الناشئة في الخدمات المصرفية المفتوحة.</li>
<li><strong>تقنية المعلومات والحوسبة السحابية</strong> — اتصالات محرّرة وبنية بيانات قوية للبرمجيات كخدمة والذكاء الاصطناعي.</li>
<li><strong>اللوجستيات والتصنيع</strong> و<strong>السياحة والتجزئة</strong>.</li>
</ul>
<h2>قائمة الامتثال المستمرة للمؤسس</h2>
<ul>
<li>الاحتفاظ بحساب بنكي للشركة بأرصدة دنيا.</li>
<li>تقديم إقرارات ضريبة القيمة المضافة في موعدها (إلزامية فوق 37,500 دينار سنويًا).</li>
<li>تجديد السجل التجاري سنويًا.</li>
<li>متابعة تأشيرات هيئة تنظيم سوق العمل ونسب البحرنة.</li>
<li>تشغيل رواتب وموارد بشرية متوافقة مع قوانين العمل البحرينية.</li>
<li>مواكبة الإصلاحات العالمية (الركيزة الثانية لمنظمة التعاون الاقتصادي والتنمية).</li>
</ul>
<h2>الضرائب وضريبة القيمة المضافة (2025)</h2>
<p>ضريبة قيمة مضافة 10% إلزامية فوق 37,500 دينار؛ ولا ضريبة شركات (باستثناء النفط والغاز).</p>
<h2>مسار التأسيس الواضح</h2>
<p>اختيار هيكل الشركة ← طلب السجل التجاري عبر «سجلّات» ← تأمين عقد المكتب ← إعداد الخدمات المصرفية والامتثال ← التراخيص النهائية.</p>
<h2>ميزة التكلفة</h2>
<p>ميزة تكلفة إجمالية تصل إلى 48% مقارنةً بالنظراء الإقليميين لتشغيل شركة خدمات مالية مع مركز تقني (EY، 2025).</p>
<h2>البحرين مقابل المراكز الأخرى</h2>
<ul>
<li><strong>مقابل الإمارات:</strong> قاعدة تكلفة أقل — خاصةً لمراكز التقنية المالية — مع الحفاظ على الوصول الإقليمي.</li>
<li><strong>مقابل السعودية:</strong> توفّر السعودية حجم سوق أكبر؛ بينما توفّر البحرين سرعة في الترخيص ومرونة في الملكية.</li>
</ul>
<h2>الأسئلة الشائعة</h2>
<h3>كم يستغرق بدء العمل؟</h3><p>من أسبوعين إلى أربعة أسابيع للشركة ذ.م.م؛ وأطول للقطاعات الخاضعة للرقابة.</p>
<h3>ما تكاليف التأسيس المعتادة؟</h3><p>رسوم السجل التجاري (196 دينارًا) والتوثيق، إضافةً إلى عقد المكتب.</p>
<h3>هل يمكنني العمل عن بُعد بسجل تجاري بحريني؟</h3><p>نعم، لكن يلزم وجود عنوان محلي فعلي.</p>
<h3>كيف تؤثّر هيئة تنظيم سوق العمل في التوظيف الأجنبي؟</h3><p>تحدّد حصص التأشيرات وتتطلّب الامتثال للبحرنة والفحص الطبي.</p>
HTML,
            ],

            [
                'slug' => 'company-setup-in-bahrain-steps-costs-and-requirements',
                'category' => 'Company Setup', 'read' => 7, 'date' => '2025-08-16',
                'title_en' => 'Company Setup in Bahrain — Steps, Costs and Requirements',
                'title_ar' => 'تأسيس شركة في البحرين — الخطوات والتكاليف والمتطلبات',
                'excerpt_en' => 'A transparent breakdown of the main setup steps and indicative government costs — plus how LevantBMS handles formation, visas, banking and compliance.',
                'excerpt_ar' => 'تفصيل شفّاف لخطوات التأسيس الرئيسية والتكاليف الحكومية التقديرية — وكيف تتولّى ليفانت التأسيس والتأشيرات والخدمات المصرفية والامتثال.',
                'body_en' => <<<'HTML'
<h2>How setup works (main steps)</h2>
<ol>
<li>Choose the business activity and structure.</li>
<li>Reserve a trade name and submit documents via the Sijilat portal.</li>
<li>Obtain the Commercial Registration (CR) from MOIC.</li>
<li>Secure an office lease and open a corporate bank account.</li>
<li>Apply for investor or employee visas through LMRA.</li>
</ol>
<h2>Cost snapshot</h2>
<table>
<thead><tr><th>Item</th><th>Approximate cost (BD)</th></tr></thead>
<tbody>
<tr><td>MOIC CR fees (3 activities)</td><td>~196</td></tr>
<tr><td>Additional activity fee</td><td>+100 each</td></tr>
<tr><td>Notarization and POA</td><td>~155</td></tr>
<tr><td>Chamber of Commerce annual fee</td><td>16</td></tr>
<tr><td>Municipality annual fee</td><td>10</td></tr>
</tbody>
</table>
<h2>LevantBMS services for company formation</h2>
<ul>
<li><strong>Company-formation assistance</strong> — choosing the structure, handling paperwork, ensuring compliance.</li>
<li><strong>Investor-visa processing</strong> — meeting all LMRA requirements.</li>
<li><strong>Bank-account opening</strong> — assistance with leading Bahraini banks.</li>
<li><strong>Ongoing compliance support</strong> — legal updates, advisory, and regulatory adherence.</li>
</ul>
<h2>Why choose LevantBMS</h2>
<ul>
<li>Expert knowledge of Bahrain's business landscape.</li>
<li>End-to-end services: CR, visas, and banking.</li>
<li>Tailored solutions for specific business goals.</li>
<li>Client-centric, dedicated support.</li>
</ul>
HTML,
                'body_ar' => <<<'HTML'
<h2>كيف يتم التأسيس (الخطوات الرئيسية)</h2>
<ol>
<li>اختيار النشاط التجاري والهيكل.</li>
<li>حجز اسم تجاري وتقديم المستندات عبر بوابة «سجلّات».</li>
<li>الحصول على السجل التجاري من وزارة الصناعة والتجارة.</li>
<li>تأمين عقد مكتب وفتح حساب بنكي للشركة.</li>
<li>تقديم طلب تأشيرات المستثمر أو الموظفين عبر هيئة تنظيم سوق العمل.</li>
</ol>
<h2>لمحة عن التكاليف</h2>
<table>
<thead><tr><th>البند</th><th>التكلفة التقريبية (دينار)</th></tr></thead>
<tbody>
<tr><td>رسوم السجل التجاري (3 أنشطة)</td><td>~196</td></tr>
<tr><td>رسوم نشاط إضافي</td><td>+100 لكل نشاط</td></tr>
<tr><td>التوثيق والتوكيل</td><td>~155</td></tr>
<tr><td>الرسم السنوي لغرفة التجارة</td><td>16</td></tr>
<tr><td>الرسم البلدي السنوي</td><td>10</td></tr>
</tbody>
</table>
<h2>خدمات ليفانت لتأسيس الشركات</h2>
<ul>
<li><strong>المساعدة في التأسيس</strong> — اختيار الهيكل وإنجاز الأوراق وضمان الامتثال.</li>
<li><strong>معالجة تأشيرة المستثمر</strong> — استيفاء جميع متطلبات هيئة تنظيم سوق العمل.</li>
<li><strong>فتح الحساب البنكي</strong> — المساعدة لدى أبرز البنوك البحرينية.</li>
<li><strong>دعم الامتثال المستمر</strong> — التحديثات القانونية والاستشارات والالتزام التنظيمي.</li>
</ul>
<h2>لماذا تختار ليفانت</h2>
<ul>
<li>معرفة متخصصة ببيئة الأعمال البحرينية.</li>
<li>خدمات متكاملة: السجل التجاري والتأشيرات والخدمات المصرفية.</li>
<li>حلول مصمّمة لأهداف العمل المحددة.</li>
<li>دعم مخصّص يركّز على العميل.</li>
</ul>
HTML,
            ],

            [
                'slug' => 'company-registration-in-bahrain-guide',
                'category' => 'Regulation', 'read' => 9, 'date' => '2025-08-11',
                'title_en' => 'Company Registration in Bahrain — Requirements & Guide',
                'title_ar' => 'تسجيل الشركات في البحرين — المتطلبات والدليل',
                'excerpt_en' => 'Why register in Bahrain, the main company structures, and the full 8-step registration process — from documents to an active CR and LMRA visas.',
                'excerpt_ar' => 'لماذا التسجيل في البحرين، وأبرز هياكل الشركات، وعملية التسجيل الكاملة من 8 خطوات — من المستندات إلى سجل تجاري فعّال وتأشيرات هيئة سوق العمل.',
                'body_en' => <<<'HTML'
<h2>Why register a company in Bahrain</h2>
<ul>
<li><strong>Business-friendly policies</strong> — high rankings on the World Bank Ease of Doing Business index.</li>
<li><strong>Tax advantages</strong> — no income or corporate tax; Tamkeen subsidizes salaries and funds branding, marketing and accounting for startups.</li>
<li><strong>Access to regional &amp; global markets</strong> — close to Saudi Arabia, the UAE and MENA, with the Bahrain–US Free Trade Agreement.</li>
<li><strong>Stable political &amp; economic environment</strong> — a diversified, non-oil-reliant economy.</li>
</ul>
<h2>Main company structures</h2>
<table>
<thead><tr><th>Entity</th><th>Ownership</th><th>Capital</th><th>Best for</th></tr></thead>
<tbody>
<tr><td>WLL (LLC)</td><td>2–50 shareholders, 100% foreign allowed</td><td>Flexible</td><td>SMEs, trading, consultancy</td></tr>
<tr><td>BSC (Public/Closed)</td><td>Public or private shareholders</td><td>Higher capital</td><td>Large firms, IPOs</td></tr>
<tr><td>Branch</td><td>100% foreign-owned</td><td>No capital</td><td>Multinational expansions</td></tr>
</tbody>
</table>
<h2>Registration steps</h2>
<ol>
<li>Prepare documents (IDs, trade name, capital, POA).</li>
<li>Apply for the initial CR (security clearance + draft CR).</li>
<li>Secure an office lease and obtain municipal approval.</li>
<li>Draft &amp; notarize the MOA.</li>
<li>Deposit capital in a bank and obtain a deposit certificate.</li>
<li>Receive the ACTIVE CR from MOIC.</li>
<li>Register with the Bahrain Chamber of Commerce and Industry (mandatory by law).</li>
<li>Apply for investor/employee visas via LMRA.</li>
</ol>
<h2>The LevantBMS advantage</h2>
<p>23+ years of legal and corporate experience. Our Managing Director brings 35+ years of experience across KSA, the UK and Bahrain, is a British citizen, and is a graduate of three UK universities.</p>
<h2>Frequently asked questions</h2>
<h3>Can foreigners own 100%?</h3><p>Yes, for most sectors.</p>
<h3>How long does CR approval take?</h3><p>2–4 weeks for a WLL; longer for regulated businesses.</p>
<h3>What are the government fees?</h3><p>Approximately BD 196.</p>
<h3>Do I need a local sponsor?</h3><p>No — unlike some GCC countries.</p>
<h3>What is the VAT threshold?</h3><p>10% VAT, mandatory above BD 37,500 annually.</p>
HTML,
                'body_ar' => <<<'HTML'
<h2>لماذا تسجّل شركة في البحرين</h2>
<ul>
<li><strong>سياسات داعمة للأعمال</strong> — مراتب متقدّمة في مؤشر البنك الدولي لسهولة ممارسة الأعمال.</li>
<li><strong>مزايا ضريبية</strong> — لا ضريبة دخل أو شركات؛ ويدعم «تمكين» الرواتب ويموّل العلامة والتسويق والمحاسبة للشركات الناشئة.</li>
<li><strong>الوصول إلى الأسواق الإقليمية والعالمية</strong> — قرب من السعودية والإمارات ومنطقة الشرق الأوسط، مع اتفاقية التجارة الحرة بين البحرين والولايات المتحدة.</li>
<li><strong>بيئة سياسية واقتصادية مستقرة</strong> — اقتصاد متنوّع لا يعتمد على النفط.</li>
</ul>
<h2>أبرز هياكل الشركات</h2>
<table>
<thead><tr><th>الكيان</th><th>الملكية</th><th>رأس المال</th><th>الأنسب لـ</th></tr></thead>
<tbody>
<tr><td>ذ.م.م (WLL)</td><td>من 2 إلى 50 مساهمًا، تملّك أجنبي 100% مسموح</td><td>مرن</td><td>الشركات الصغيرة والتجارة والاستشارات</td></tr>
<tr><td>مساهمة (عامة/مقفلة)</td><td>مساهمون عامون أو خاصون</td><td>رأس مال أعلى</td><td>الشركات الكبرى والاكتتابات</td></tr>
<tr><td>فرع</td><td>مملوك أجنبيًا 100%</td><td>بدون رأس مال</td><td>توسّعات الشركات متعددة الجنسيات</td></tr>
</tbody>
</table>
<h2>خطوات التسجيل</h2>
<ol>
<li>تجهيز المستندات (الهويات، الاسم التجاري، رأس المال، التوكيل).</li>
<li>التقديم للسجل التجاري المبدئي (الموافقة الأمنية + مسوّدة السجل).</li>
<li>تأمين عقد مكتب والحصول على الموافقة البلدية.</li>
<li>صياغة وتوثيق عقد التأسيس.</li>
<li>إيداع رأس المال في البنك والحصول على شهادة الإيداع.</li>
<li>استلام السجل التجاري الفعّال من الوزارة.</li>
<li>التسجيل في غرفة تجارة وصناعة البحرين (إلزامي قانونًا).</li>
<li>التقديم لتأشيرات المستثمر/الموظفين عبر هيئة تنظيم سوق العمل.</li>
</ol>
<h2>ميزة ليفانت</h2>
<p>أكثر من 23 عامًا من الخبرة القانونية والمؤسسية. ويتمتّع مديرنا التنفيذي بخبرة تتجاوز 35 عامًا في السعودية والمملكة المتحدة والبحرين، وهو مواطن بريطاني وخرّيج ثلاث جامعات بريطانية.</p>
<h2>الأسئلة الشائعة</h2>
<h3>هل يمكن للأجانب التملّك 100%؟</h3><p>نعم، في معظم القطاعات.</p>
<h3>كم تستغرق الموافقة على السجل التجاري؟</h3><p>من أسبوعين إلى أربعة أسابيع للشركة ذ.م.م؛ وأطول للأنشطة الخاضعة للرقابة.</p>
<h3>ما الرسوم الحكومية؟</h3><p>نحو 196 دينارًا.</p>
<h3>هل أحتاج إلى كفيل محلي؟</h3><p>لا — بخلاف بعض دول الخليج.</p>
<h3>ما حد ضريبة القيمة المضافة؟</h3><p>10% إلزامية فوق 37,500 دينار سنويًا.</p>
HTML,
            ],

            [
                'slug' => 'investing-in-bahrain',
                'category' => 'Investment', 'read' => 6, 'date' => '2025-08-01',
                'title_en' => 'Investing in Bahrain',
                'title_ar' => 'الاستثمار في البحرين',
                'excerpt_en' => '15 key reasons to invest in Bahrain — from 100% ownership and zero tax to a 10-year investor visa and a strategic location beside Saudi Arabia.',
                'excerpt_ar' => '15 سببًا رئيسيًا للاستثمار في البحرين — من التملّك الكامل وانعدام الضرائب إلى تأشيرة مستثمر لعشر سنوات وموقع استراتيجي بجوار السعودية.',
                'body_en' => $invest15En,
                'body_ar' => $invest15Ar,
            ],

            [
                'slug' => 'steps-for-establishing-a-commercial-company-in-bahrain',
                'category' => 'Company Setup', 'read' => 6, 'date' => '2025-08-01',
                'title_en' => 'Steps for Establishing a Commercial Company in Bahrain',
                'title_ar' => 'خطوات تأسيس شركة تجارية في البحرين',
                'excerpt_en' => 'The advantages that make Bahrain a standout base for a commercial company — 100% ownership, no tax, a long-term investor visa, and strong infrastructure.',
                'excerpt_ar' => 'المزايا التي تجعل البحرين قاعدة مميّزة للشركة التجارية — تملّك كامل، ولا ضرائب، وتأشيرة مستثمر طويلة الأمد، وبنية تحتية قوية.',
                'body_en' => $invest15En,
                'body_ar' => $invest15Ar,
            ],

            [
                'slug' => 'investing-in-bahrain-levantbms-business-guide',
                'category' => 'Investment', 'read' => 6, 'date' => '2025-08-01',
                'title_en' => 'Investing in Bahrain — LevantBMS Business Guide',
                'title_ar' => 'الاستثمار في البحرين — دليل ليفانت للأعمال',
                'excerpt_en' => 'The LevantBMS business guide to investing in Bahrain: 15 reasons the Kingdom is a compelling base for founders and investors.',
                'excerpt_ar' => 'دليل ليفانت للأعمال حول الاستثمار في البحرين: 15 سببًا تجعل المملكة قاعدة مقنعة للمؤسسين والمستثمرين.',
                'body_en' => $invest15En,
                'body_ar' => $invest15Ar,
            ],

            [
                'slug' => 'investing-in-bahrain-business-opportunities-investment-guide',
                'category' => 'Investment', 'read' => 6, 'date' => '2025-08-01',
                'title_en' => 'Business Opportunities & Investment Guide in Bahrain',
                'title_ar' => 'الفرص التجارية ودليل الاستثمار في البحرين',
                'excerpt_en' => 'Ten advantages of investing in Bahrain — strategic location, a business-friendly environment, a favorable tax regime, and a strong financial sector.',
                'excerpt_ar' => 'عشر مزايا للاستثمار في البحرين — الموقع الاستراتيجي، وبيئة داعمة للأعمال، ونظام ضريبي مواتٍ، وقطاع مالي قوي.',
                'body_en' => <<<'HTML'
<h2>10 advantages of investing in Bahrain</h2>
<ol>
<li><strong>Strategic location</strong> — centrally located in the Gulf with access to the Middle East, North Africa, South Asia and Saudi Arabia (the largest GCC economy).</li>
<li><strong>Business-friendly environment</strong> — a liberal economy with minimal foreign-ownership restrictions and a transparent regulatory framework.</li>
<li><strong>Developed infrastructure</strong> — modern transport, efficient telecoms and advanced financial services; Bahrain International Airport and Khalifa Bin Salman Port as key trade hubs.</li>
<li><strong>Diversified economy</strong> — financial services, manufacturing, logistics, ICT and tourism, with reduced oil dependence.</li>
<li><strong>Skilled workforce</strong> — a well-educated workforce backed by government training and development initiatives.</li>
<li><strong>Favorable tax regime</strong> — no personal income tax, no capital-gains tax, no withholding tax, and competitive corporate rates with many incentives.</li>
<li><strong>Strong financial sector</strong> — a leading Middle East financial center with robust CBB oversight.</li>
<li><strong>Free-trade agreements</strong> — including the US–Bahrain FTA for preferential market access.</li>
<li><strong>Government support</strong> — the Bahrain EDB assists with procedures, opportunities and business facilitation.</li>
<li><strong>Quality of life</strong> — a multicultural environment with modern healthcare, quality education and recreation for expatriates and families.</li>
</ol>
HTML,
                'body_ar' => <<<'HTML'
<h2>عشر مزايا للاستثمار في البحرين</h2>
<ol>
<li><strong>الموقع الاستراتيجي</strong> — موقع مركزي في الخليج مع وصول إلى الشرق الأوسط وشمال أفريقيا وجنوب آسيا والسعودية (أكبر اقتصاد خليجي).</li>
<li><strong>بيئة داعمة للأعمال</strong> — اقتصاد منفتح بقيود ملكية أجنبية محدودة وإطار تنظيمي شفّاف.</li>
<li><strong>بنية تحتية متطوّرة</strong> — نقل حديث واتصالات فعّالة وخدمات مالية متقدّمة؛ ومطار البحرين الدولي وميناء خليفة بن سلمان كمراكز تجارية رئيسية.</li>
<li><strong>اقتصاد متنوّع</strong> — الخدمات المالية والتصنيع واللوجستيات وتقنية المعلومات والسياحة، مع اعتماد أقل على النفط.</li>
<li><strong>قوى عاملة ماهرة</strong> — قوى عاملة متعلّمة مدعومة بمبادرات حكومية للتدريب والتطوير.</li>
<li><strong>نظام ضريبي مواتٍ</strong> — لا ضريبة دخل على الأفراد ولا ضريبة أرباح رأسمالية ولا ضريبة استقطاع، مع معدلات شركات تنافسية وحوافز عديدة.</li>
<li><strong>قطاع مالي قوي</strong> — مركز مالي رائد في الشرق الأوسط برقابة قوية من المصرف المركزي.</li>
<li><strong>اتفاقيات تجارة حرة</strong> — منها اتفاقية البحرين والولايات المتحدة للوصول التفضيلي للأسواق.</li>
<li><strong>دعم حكومي</strong> — يساعد مجلس التنمية الاقتصادية في الإجراءات والفرص وتيسير الأعمال.</li>
<li><strong>جودة الحياة</strong> — بيئة متعددة الثقافات مع رعاية صحية حديثة وتعليم جيد وترفيه للمقيمين والعائلات.</li>
</ol>
HTML,
            ],

            [
                'slug' => 'incorporating-a-company-in-bahrain',
                'category' => 'Company Setup', 'read' => 9, 'date' => '2025-08-01',
                'title_en' => 'Incorporating a Company in Bahrain',
                'title_ar' => 'تأسيس شركة في البحرين',
                'excerpt_en' => 'A step-by-step incorporation guide from a CBB-approved practice — entity types, name reservation, MOA, capital, licensing, SIO, VAT and LMRA.',
                'excerpt_ar' => 'دليل تأسيس خطوة بخطوة من مكتب معتمد لدى المصرف المركزي — أنواع الكيانات وحجز الاسم وعقد التأسيس ورأس المال والترخيص والتأمينات والضريبة وهيئة سوق العمل.',
                'body_en' => <<<'HTML'
<h2>About LevantBMS leadership</h2>
<p>LevantBMS is led by an experienced British lawyer — a graduate of three British universities — with 20+ years in Bahrain and 40+ total years of legal experience across the UK, KSA and Bahrain. Expertise covers corporate finance, corporate governance, regulatory compliance, investment banking, oil &amp; gas, M&amp;A, rights issues and IPOs. He is a former Executive Director, Head of Legal, Compliance and Board Secretary for a GCC investment bank, and is approved by the Central Bank of Bahrain as Head of Legal and Compliance.</p>
<p>LevantBMS specializes in CBB-regulated companies (investment companies Category 1, 2 &amp; 3, insurance and crypto), as well as medical and industrial companies.</p>
<h2>Step-by-step guide to incorporation</h2>
<h3>1. Choose a business structure</h3>
<ul>
<li>Sole Proprietorship (Bahrainis and GCC nationals only).</li>
<li>Partnership Company / Limited Liability Company (WLL) — the most commonly used.</li>
<li>Single Person Company (SPC) — now called WLL.</li>
<li>Public Shareholding Company (BSC).</li>
<li>Closed Shareholding Company (BSC Closed).</li>
<li>Foreign Company Branch.</li>
<li>Holding Company.</li>
</ul>
<h3>2. Reserve a company name</h3>
<p>A unique name approved by MOIC.</p>
<h3>3. Draft the Memorandum and Articles of Association</h3>
<p>Prepared per Bahrain's Commercial Companies Law.</p>
<h3>4. Obtain initial approval</h3>
<p>Submit the proposed company name, draft MOA/AOA and shareholder ID documents to MOICT.</p>
<h3>5. Open a bank account</h3>
<p>Deposit the required capital and obtain a bank certificate. There is no minimum capital for most commercial companies, but statutory requirements exist for investment companies, crypto and fund administrators.</p>
<h3>6. Register the company</h3>
<p>Submit final documents to MOICT: bank-deposit certificate, final MOA/AOA, initial-approval certificate and the office-lease agreement.</p>
<h3>7. Obtain necessary licenses</h3>
<p>Industry-specific licenses from the relevant authorities.</p>
<h3>8. Register with the Social Insurance Organization (SIO)</h3>
<p>Required if you are hiring employees.</p>
<h3>9. Register for VAT</h3>
<p>If annual turnover exceeds the mandatory threshold, register with the National Bureau for Revenue (NBR).</p>
<h3>10. Register with LMRA</h3>
<p>To obtain the investor visa and work permits for staff.</p>
<h2>Key considerations</h2>
<ul>
<li>Minimum-capital requirements vary by company type.</li>
<li>Bahrain allows 100% foreign ownership in many sectors, with exceptions in trading, construction and contracting.</li>
</ul>
HTML,
                'body_ar' => <<<'HTML'
<h2>عن قيادة ليفانت</h2>
<p>تقود ليفانت محامٍ بريطاني متمرّس — خرّيج ثلاث جامعات بريطانية — بخبرة تتجاوز 20 عامًا في البحرين وأكثر من 40 عامًا إجمالًا في المملكة المتحدة والسعودية والبحرين. وتشمل خبرته التمويل المؤسسي وحوكمة الشركات والامتثال التنظيمي والخدمات المصرفية الاستثمارية والنفط والغاز وعمليات الدمج والاستحواذ وإصدارات الحقوق والاكتتابات. وهو مدير تنفيذي سابق ورئيس للشؤون القانونية والامتثال وأمين مجلس لبنك استثماري خليجي، ومعتمد لدى مصرف البحرين المركزي رئيسًا للشؤون القانونية والامتثال.</p>
<p>تتخصّص ليفانت في الشركات الخاضعة لرقابة المصرف المركزي (شركات الاستثمار من الفئات 1 و2 و3، والتأمين، والعملات المشفّرة)، إضافةً إلى الشركات الطبية والصناعية.</p>
<h2>دليل التأسيس خطوة بخطوة</h2>
<h3>1. اختيار هيكل العمل</h3>
<ul>
<li>مؤسسة فردية (للبحرينيين ومواطني الخليج فقط).</li>
<li>شركة تضامن / شركة ذات مسؤولية محدودة (ذ.م.م) — الأكثر استخدامًا.</li>
<li>شركة الشخص الواحد — تُسمّى الآن ذ.م.م.</li>
<li>شركة مساهمة عامة.</li>
<li>شركة مساهمة مقفلة.</li>
<li>فرع شركة أجنبية.</li>
<li>شركة قابضة.</li>
</ul>
<h3>2. حجز اسم الشركة</h3>
<p>اسم فريد معتمد من وزارة الصناعة والتجارة.</p>
<h3>3. صياغة عقد التأسيس والنظام الأساسي</h3>
<p>وفق قانون الشركات التجارية في البحرين.</p>
<h3>4. الحصول على الموافقة المبدئية</h3>
<p>تقديم اسم الشركة المقترح ومسوّدة العقد والنظام الأساسي وهويات المساهمين إلى الوزارة.</p>
<h3>5. فتح حساب بنكي</h3>
<p>إيداع رأس المال المطلوب والحصول على شهادة بنكية. لا يوجد حد أدنى لرأس المال لمعظم الشركات التجارية، لكن توجد متطلبات نظامية لشركات الاستثمار والعملات المشفّرة ومدراء الصناديق.</p>
<h3>6. تسجيل الشركة</h3>
<p>تقديم المستندات النهائية للوزارة: شهادة الإيداع البنكي، والعقد والنظام الأساسي النهائي، وشهادة الموافقة المبدئية، وعقد إيجار المكتب.</p>
<h3>7. الحصول على التراخيص اللازمة</h3>
<p>تراخيص خاصة بكل قطاع من الجهات المعنية.</p>
<h3>8. التسجيل في الهيئة العامة للتأمين الاجتماعي</h3>
<p>مطلوب عند توظيف موظفين.</p>
<h3>9. التسجيل لضريبة القيمة المضافة</h3>
<p>إذا تجاوز الدوران السنوي الحد الإلزامي، يُسجَّل لدى الجهاز الوطني للإيرادات.</p>
<h3>10. التسجيل في هيئة تنظيم سوق العمل</h3>
<p>للحصول على تأشيرة المستثمر وتصاريح عمل الموظفين.</p>
<h2>اعتبارات رئيسية</h2>
<ul>
<li>تختلف متطلبات الحد الأدنى لرأس المال بحسب نوع الشركة.</li>
<li>تسمح البحرين بالتملّك الأجنبي الكامل في كثير من القطاعات، مع استثناءات في التجارة والإنشاءات والمقاولات.</li>
</ul>
HTML,
            ],

            [
                'slug' => 'considering-doing-business-in-the-arabian-gulf',
                'category' => 'Guides', 'read' => 7, 'date' => '2025-08-01',
                'title_en' => 'Considering Doing Business in the Arabian Gulf?',
                'title_ar' => 'تفكّر في ممارسة الأعمال في الخليج العربي؟',
                'excerpt_en' => 'Ten reasons the Arabian Gulf is an excellent business region — strategic location, economic stability, diversification, and robust legal frameworks.',
                'excerpt_ar' => 'عشرة أسباب تجعل الخليج العربي منطقة أعمال ممتازة — الموقع الاستراتيجي والاستقرار الاقتصادي والتنويع والأطر القانونية القوية.',
                'body_en' => <<<'HTML'
<h2>10 reasons the Arabian Gulf is an excellent business region</h2>
<ol>
<li><strong>Strategic geographic location</strong> — a crossroads between Europe, Asia and Africa; Dubai, Abu Dhabi and Doha serve as key logistics and trade hubs with world-class ports and airports.</li>
<li><strong>Stable economic environment</strong> — GCC nations maintain stability through prudent fiscal management, significant sovereign wealth funds and currency reserves.</li>
<li><strong>Economic diversification</strong> — Saudi Arabia's Vision 2030 and the UAE's Vision 2021 are reducing oil dependence and opening new industries: tourism, technology, renewable energy, healthcare and education.</li>
<li><strong>Business-friendly policies</strong> — low or no corporate/personal income taxes, free-trade zones with 100% foreign ownership, full profit repatriation and streamlined registration.</li>
<li><strong>Infrastructural development</strong> — world-class transport, high-speed internet, technology parks and financial hubs like the DIFC; a regional leader in smart-city initiatives.</li>
<li><strong>Growing consumer market</strong> — a young, affluent, tech-savvy population with high internet/smartphone penetration and strong demand for luxury, e-commerce, fintech, entertainment and healthcare.</li>
<li><strong>Talent and innovation hubs</strong> — investments in education, research and technology; Dubai and Doha are becoming innovation hubs with incubators and government-backed research.</li>
<li><strong>Access to energy and natural resources</strong> — relatively low energy costs for manufacturing and heavy industry, alongside growing renewable-energy projects.</li>
<li><strong>Cultural openness and tourism growth</strong> — more open cultural policies attracting expats, businesses and tourists; Dubai, Abu Dhabi and Riyadh are becoming global cultural and tourism destinations.</li>
<li><strong>Robust legal &amp; regulatory frameworks</strong> — specialized courts, arbitration centers, FDI and IP protections, and transparent dispute resolution to build investor confidence.</li>
</ol>
<p>The Arabian Gulf's combination of strategic positioning, economic stability, favorable regulation and growing market potential makes it a unique and promising opportunity for global business expansion.</p>
HTML,
                'body_ar' => <<<'HTML'
<h2>عشرة أسباب تجعل الخليج العربي منطقة أعمال ممتازة</h2>
<ol>
<li><strong>الموقع الجغرافي الاستراتيجي</strong> — مفترق طرق بين أوروبا وآسيا وأفريقيا؛ وتعمل دبي وأبوظبي والدوحة كمراكز لوجستية وتجارية رئيسية بموانئ ومطارات عالمية المستوى.</li>
<li><strong>بيئة اقتصادية مستقرة</strong> — تحافظ دول الخليج على الاستقرار عبر إدارة مالية حصيفة وصناديق ثروة سيادية كبيرة واحتياطيات عملة.</li>
<li><strong>التنويع الاقتصادي</strong> — تعمل رؤية السعودية 2030 ورؤية الإمارات 2021 على تقليل الاعتماد على النفط وفتح صناعات جديدة: السياحة والتقنية والطاقة المتجددة والرعاية الصحية والتعليم.</li>
<li><strong>سياسات داعمة للأعمال</strong> — ضرائب دخل منخفضة أو معدومة على الشركات والأفراد، ومناطق تجارة حرة بتملّك أجنبي 100%، وتحويل كامل للأرباح، وإجراءات تسجيل ميسّرة.</li>
<li><strong>تطوّر البنية التحتية</strong> — نقل عالمي المستوى وإنترنت عالي السرعة ومجمّعات تقنية ومراكز مالية مثل مركز دبي المالي العالمي؛ وريادة إقليمية في مبادرات المدن الذكية.</li>
<li><strong>سوق استهلاكية متنامية</strong> — سكان شباب وميسورون ومتمكّنون تقنيًا بانتشار عالٍ للإنترنت والهواتف الذكية، وطلب قوي على الكماليات والتجارة الإلكترونية والتقنية المالية والترفيه والرعاية الصحية.</li>
<li><strong>مراكز للمواهب والابتكار</strong> — استثمارات في التعليم والبحث والتقنية؛ وتتحوّل دبي والدوحة إلى مراكز ابتكار بحاضنات وأبحاث مدعومة حكوميًا.</li>
<li><strong>الوصول إلى الطاقة والموارد الطبيعية</strong> — تكاليف طاقة منخفضة نسبيًا للتصنيع والصناعات الثقيلة، إلى جانب مشاريع طاقة متجددة متنامية.</li>
<li><strong>الانفتاح الثقافي ونمو السياحة</strong> — سياسات ثقافية أكثر انفتاحًا تجذب المقيمين والشركات والسيّاح؛ وتتحوّل دبي وأبوظبي والرياض إلى وجهات ثقافية وسياحية عالمية.</li>
<li><strong>أطر قانونية وتنظيمية قوية</strong> — محاكم متخصصة ومراكز تحكيم وحماية للاستثمار الأجنبي والملكية الفكرية، وتسوية شفّافة للنزاعات لبناء ثقة المستثمرين.</li>
</ol>
<p>إن مزيج الخليج العربي من الموقع الاستراتيجي والاستقرار الاقتصادي والتنظيم المواتي والإمكانات السوقية المتنامية يجعله فرصة فريدة وواعدة للتوسّع التجاري العالمي.</p>
HTML,
            ],
        ];
    }

    /** The shared "15 reasons to invest in Bahrain" body (blogs 7, 8 & 9). */
    protected function invest15(): array
    {
        $en = <<<'HTML'
<h2>15 key reasons to invest in Bahrain</h2>
<ol>
<li>An island country in the Arabian Gulf and one of the GCC states — connected to Saudi Arabia by the 25 km King Fahd Causeway.</li>
<li>All nationalities can invest with 100% ownership across a wide range of business activities.</li>
<li>A very reasonable cost of living — rent, electricity, water, petrol, health, education and food.</li>
<li>Start your business with any amount of capital.</li>
<li>A 10-year investor visa with health insurance and no sponsor needed (for non-GCC nationalities), allowing travel across all GCC countries.</li>
<li>No tax for companies or individuals.</li>
<li>Easy access to financial support; the Bahraini Dinar is pegged to the USD (BD 1 = US$ 2.65).</li>
<li>You can buy your own property — apartments, villas or buildings.</li>
<li>A strategic location within the GCC, only 30 km from Saudi Arabia via the King Fahd Causeway.</li>
<li>Strong infrastructure — banking, insurance, electricity, water, internet, telecommunications, transport, health, education, ports, airports and roads.</li>
<li>A vibrant expat community, tolerance and friendliness, with English widely spoken alongside Arabic.</li>
<li>The government supports up to 50% of the value of equipment required for your business's success.</li>
<li>The government supports up to 70% of the salaries of Bahraini employees; work permits are available for non-Bahrainis.</li>
<li>One of the largest ports and free zones in the region for GCC and global logistics.</li>
<li>Travel anywhere in the world with Bahrain's national carrier, Gulf Air.</li>
</ol>
HTML;

        $ar = <<<'HTML'
<h2>15 سببًا رئيسيًا للاستثمار في البحرين</h2>
<ol>
<li>دولة جزيرية في الخليج العربي وإحدى دول مجلس التعاون — تتصل بالسعودية عبر جسر الملك فهد بطول 25 كم.</li>
<li>يمكن لجميع الجنسيات الاستثمار بتملّك 100% في طيف واسع من الأنشطة التجارية.</li>
<li>تكلفة معيشة معقولة جدًا — الإيجار والكهرباء والماء والوقود والصحة والتعليم والغذاء.</li>
<li>ابدأ عملك بأي مبلغ من رأس المال.</li>
<li>تأشيرة مستثمر لعشر سنوات مع تأمين صحي ودون حاجة إلى كفيل (لغير مواطني الخليج)، وتتيح التنقّل بين جميع دول الخليج.</li>
<li>لا ضرائب على الشركات أو الأفراد.</li>
<li>سهولة الوصول إلى الدعم المالي؛ والدينار البحريني مربوط بالدولار (دينار واحد = 2.65 دولار).</li>
<li>يمكنك تملّك العقارات — شقق أو فلل أو مبانٍ.</li>
<li>موقع استراتيجي داخل الخليج، على بُعد 30 كم فقط من السعودية عبر جسر الملك فهد.</li>
<li>بنية تحتية قوية — المصارف والتأمين والكهرباء والماء والإنترنت والاتصالات والنقل والصحة والتعليم والموانئ والمطارات والطرق.</li>
<li>مجتمع مغترب نابض بالحياة، وتسامح وودّ، مع انتشار واسع للغة الإنجليزية إلى جانب العربية.</li>
<li>تدعم الحكومة ما يصل إلى 50% من قيمة المعدات اللازمة لنجاح عملك.</li>
<li>تدعم الحكومة ما يصل إلى 70% من رواتب الموظفين البحرينيين؛ وتتوفّر تصاريح العمل لغير البحرينيين.</li>
<li>أحد أكبر الموانئ والمناطق الحرة في المنطقة للوجستيات الخليجية والعالمية.</li>
<li>سافر إلى أي مكان في العالم عبر الناقل الوطني البحريني، طيران الخليج.</li>
</ol>
HTML;

        return [$en, $ar];
    }
}
