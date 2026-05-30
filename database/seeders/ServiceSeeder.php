<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

/**
 * Real LevantBMS services (source: levantbms.com/services) — all 7, fully bilingual
 * including the scope-of-work detail lines.
 */
class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Replace any existing services with the authoritative set.
        Service::query()->delete();

        $services = [
            [
                'code' => '01',
                'tag' => ['en' => 'Ministry of Industry & Commerce', 'ar' => 'وزارة الصناعة والتجارة'],
                'title' => ['en' => 'Ministry of Commerce', 'ar' => 'وزارة التجارة'],
                'description' => [
                    'en' => 'Incorporate, register and manage every company activity at the Ministry — from CR changes to bankruptcy.',
                    'ar' => 'نتولّى التأسيس والتسجيل وإدارة جميع أنشطة الشركة لدى الوزارة — من تعديلات السجل التجاري حتى الإفلاس.',
                ],
                'scope_en' => [
                    'Incorporate, register a new company or amend an existing one and manage all company activities',
                    'Change company address, name, branch or CR',
                    'Change company Memorandum and Articles of Association',
                    'Change company type, ownership or transfer ownership',
                    'Increase or decrease company capital',
                    'Manage authorized signatories',
                    'Change partners — remove or add new ones',
                    'Manage representatives',
                    'Change directors, delete CR or license, or change group name',
                    'Manage mortgages or change company lifespan',
                    'Change financial year-end and change sponsors',
                    'Apply for bankruptcy and execute the process',
                ],
                'scope_ar' => [
                    'تأسيس وتسجيل شركة جديدة أو تعديل شركة قائمة وإدارة جميع أنشطة الشركة',
                    'تغيير عنوان الشركة أو اسمها أو فرعها أو السجل التجاري',
                    'تعديل عقد التأسيس والنظام الأساسي للشركة',
                    'تغيير نوع الشركة أو الملكية أو نقل الملكية',
                    'زيادة أو تخفيض رأس مال الشركة',
                    'إدارة المخوّلين بالتوقيع',
                    'تغيير الشركاء — إضافة أو إزالة شركاء',
                    'إدارة الممثلين',
                    'تغيير المديرين، أو إلغاء السجل أو الترخيص، أو تغيير اسم المجموعة',
                    'إدارة الرهون أو تغيير مدة الشركة',
                    'تغيير نهاية السنة المالية وتغيير الكفلاء',
                    'تقديم طلب الإفلاس وتنفيذ الإجراءات',
                ],
            ],
            [
                'code' => '02',
                'tag' => ['en' => 'Corporate', 'ar' => 'الخدمات المؤسسية'],
                'title' => ['en' => 'Corporate Services', 'ar' => 'الخدمات المؤسسية'],
                'description' => [
                    'en' => 'Day-to-day corporate function support — from governance and compliance to annual reports.',
                    'ar' => 'دعم وظائف الشركة اليومية — من الحوكمة والامتثال إلى التقارير السنوية.',
                ],
                'scope_en' => [
                    'Management consulting',
                    'Company restructuring',
                    'Shareholders equity issues',
                    'Company capitalization',
                    'Corporate governance',
                    'Regulatory and non-regulatory compliance, framework and strategy',
                    'Policies and procedures',
                    'Regulatory approvals',
                    'Directors evaluation',
                    'Assisting with AGMs & EGMs',
                    'Assisting with annual reports',
                ],
                'scope_ar' => [
                    'الاستشارات الإدارية',
                    'إعادة هيكلة الشركات',
                    'قضايا حقوق المساهمين',
                    'رسملة الشركة',
                    'حوكمة الشركات',
                    'الامتثال التنظيمي وغير التنظيمي، والإطار والاستراتيجية',
                    'السياسات والإجراءات',
                    'الموافقات التنظيمية',
                    'تقييم المديرين',
                    'المساعدة في الجمعيات العمومية العادية وغير العادية',
                    'المساعدة في إعداد التقارير السنوية',
                ],
            ],
            [
                'code' => '03',
                'tag' => ['en' => 'Advisory', 'ar' => 'الاستشارات'],
                'title' => ['en' => 'Advisory Services', 'ar' => 'الخدمات الاستشارية'],
                'description' => [
                    'en' => 'Capital-markets and placement advisory — from IPOs to private equity.',
                    'ar' => 'استشارات أسواق المال والطرح — من الاكتتابات إلى الملكية الخاصة.',
                ],
                'scope_en' => [
                    'IPOs',
                    'Capitalization',
                    'Private subscription and investment placement',
                    'Private equity',
                    'Private placement memorandum',
                    'Public placement memorandum',
                    'Shares placement, sale & purchase',
                ],
                'scope_ar' => [
                    'الاكتتابات العامة الأولية',
                    'الرسملة',
                    'الاكتتاب الخاص وطرح الاستثمار',
                    'الملكية الخاصة',
                    'مذكرة الطرح الخاص',
                    'مذكرة الطرح العام',
                    'طرح الأسهم وبيعها وشراؤها',
                ],
            ],
            [
                'code' => '04',
                'tag' => ['en' => 'Approvals', 'ar' => 'الموافقات'],
                'title' => ['en' => 'Statutory Approvals', 'ar' => 'الموافقات النظامية'],
                'description' => [
                    'en' => 'Getting your business approved. We help clients meet statutory requirements and obtain approvals from the Kingdom of Bahrain\'s relevant authorities — including the Central Bank of Bahrain and the Ministry of Industry, Commerce & Tourism.',
                    'ar' => 'نساعد عملاءنا على استيفاء المتطلبات النظامية والحصول على الموافقات من الجهات المعنية في مملكة البحرين — بما في ذلك مصرف البحرين المركزي ووزارة الصناعة والتجارة.',
                ],
                'scope_en' => [
                    'Meeting statutory requirements',
                    'Approvals from the Central Bank of Bahrain (CBB)',
                    'Approvals from the Ministry of Industry, Commerce & Tourism',
                    'Coordination across relevant authorities',
                ],
                'scope_ar' => [
                    'استيفاء المتطلبات النظامية',
                    'الموافقات من مصرف البحرين المركزي (CBB)',
                    'الموافقات من وزارة الصناعة والتجارة والسياحة',
                    'التنسيق مع الجهات المعنية',
                ],
            ],
            [
                'code' => '05',
                'tag' => ['en' => 'M&A', 'ar' => 'الدمج والاستحواذ'],
                'title' => ['en' => 'Mergers & Acquisitions', 'ar' => 'عمليات الدمج والاستحواذ'],
                'description' => [
                    'en' => 'We advise on mergers & acquisitions, steering the process without future negative surprises — legal and financial due diligence, asset legacy, disclosure and merger documentation.',
                    'ar' => 'نوجّه عملية الدمج والاستحواذ دون مفاجآت سلبية مستقبلية — العناية القانونية والمالية، وإرث الأصول، والإفصاح، وتوثيق الاندماج.',
                ],
                'scope_en' => [
                    'Legal & financial due diligence',
                    'Assets legacy review',
                    'Disclosure',
                    'Merger documentation',
                ],
                'scope_ar' => [
                    'العناية القانونية والمالية الواجبة',
                    'مراجعة إرث الأصول',
                    'الإفصاح',
                    'توثيق الاندماج',
                ],
            ],
            [
                'code' => '06',
                'tag' => ['en' => 'Governance', 'ar' => 'الحوكمة'],
                'title' => ['en' => 'Corporate Governance', 'ar' => 'حوكمة الشركات'],
                'description' => [
                    'en' => "Stuck with Bahrain's new Corporate Governance? We help your business adopt the right structure and comply with the new Bahrain Corporate Governance requirements.",
                    'ar' => 'حائر مع حوكمة الشركات الجديدة في البحرين؟ نساعد عملك على تبنّي الهيكل الصحيح والامتثال لمتطلبات الحوكمة الجديدة.',
                ],
                'scope_en' => [
                    'Adopt the right governance structure',
                    'Comply with Bahrain Corporate Governance',
                    'Board & committee frameworks',
                    'Policies & procedures',
                ],
                'scope_ar' => [
                    'تبنّي هيكل الحوكمة المناسب',
                    'الامتثال لحوكمة الشركات البحرينية',
                    'أطر المجلس واللجان',
                    'السياسات والإجراءات',
                ],
            ],
            [
                'code' => '07',
                'tag' => ['en' => 'Planning', 'ar' => 'التخطيط'],
                'title' => ['en' => 'Business Plans & Feasibility Studies', 'ar' => 'خطط العمل ودراسات الجدوى'],
                'description' => [
                    'en' => 'Our partners arrange professional business plans and feasibility studies for our clients.',
                    'ar' => 'يقوم شركاؤنا بإعداد خطط العمل ودراسات الجدوى لعملائنا.',
                ],
                'scope_en' => [
                    'Business plans',
                    'Feasibility studies',
                    'Prepared with our specialist partners',
                ],
                'scope_ar' => [
                    'خطط العمل',
                    'دراسات الجدوى',
                    'تُعدّ بالتعاون مع شركائنا المتخصصين',
                ],
            ],
        ];

        foreach ($services as $i => $s) {
            Service::create([
                'code' => $s['code'],
                'tag' => $s['tag'],
                'title' => $s['title'],
                'description' => $s['description'],
                'scope_lines' => ['en' => $s['scope_en'], 'ar' => $s['scope_ar']],
                'timeline' => ['en' => '', 'ar' => ''],
                'fee_from' => ['en' => '', 'ar' => ''],
                'is_published' => true,
                'position' => $i + 1,
            ]);
        }
    }
}
