<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class CbbServiceSeeder extends Seeder
{
    /**
     * Central Bank of Bahrain (CBB) corporate licensing services.
     * Idempotent — keyed by code so re-running won't duplicate.
     */
    public function run(): void
    {
        foreach ($this->services() as $i => $data) {
            Service::updateOrCreate(
                ['code' => $data['code']],
                array_merge($data, ['category' => 'cbb', 'is_published' => true, 'position' => $i + 1]),
            );
        }
    }

    /** @return array<int, array<string, mixed>> */
    protected function services(): array
    {
        return [
            [
                'code' => 'C1',
                'tag' => ['en' => 'CBB · Investment Business', 'ar' => 'المصرف المركزي · أعمال الاستثمار'],
                'title' => ['en' => 'Investment Business Firms', 'ar' => 'شركات أعمال الاستثمار'],
                'description' => ['en' => 'Licensing of investment firms (Category 1, 2 and 3) regulated by the Central Bank of Bahrain.', 'ar' => 'ترخيص شركات الاستثمار (الفئات 1 و2 و3) الخاضعة لرقابة مصرف البحرين المركزي.'],
                'timeline' => ['en' => '8–16 weeks', 'ar' => '8–16 أسبوعًا'],
                'fee_from' => ['en' => 'On request', 'ar' => 'حسب الطلب'],
                'scope_lines' => [
                    'en' => ['Business plan & financial projections', 'Regulatory capital structuring', 'Controlled functions & approved persons', 'CBB Volume 4 compliance framework', 'Application drafting & CBB liaison'],
                    'ar' => ['خطة العمل والتوقعات المالية', 'هيكلة رأس المال التنظيمي', 'الوظائف الخاضعة للرقابة والأشخاص المعتمدون', 'إطار الامتثال للمجلد الرابع للمصرف المركزي', 'إعداد الطلب والتنسيق مع المصرف المركزي'],
                ],
            ],
            [
                'code' => 'C2',
                'tag' => ['en' => 'CBB · Funds', 'ar' => 'المصرف المركزي · الصناديق'],
                'title' => ['en' => 'Fund Management & Collective Investment', 'ar' => 'إدارة الصناديق والاستثمار الجماعي'],
                'description' => ['en' => 'Licensing fund managers and establishing Collective Investment Undertakings (CIUs).', 'ar' => 'ترخيص مديري الصناديق وتأسيس أدوات الاستثمار الجماعي.'],
                'timeline' => ['en' => '8–14 weeks', 'ar' => '8–14 أسبوعًا'],
                'fee_from' => ['en' => 'On request', 'ar' => 'حسب الطلب'],
                'scope_lines' => [
                    'en' => ['Fund structuring (PIUs / EIUs / Expert funds)', 'Fund administration & service providers', 'Offering memorandum & constitutive documents', 'CBB registration & ongoing reporting'],
                    'ar' => ['هيكلة الصناديق (الخاصة والمعفاة وصناديق الخبراء)', 'إدارة الصناديق ومقدمو الخدمات', 'مذكرة الطرح والوثائق التأسيسية', 'التسجيل لدى المصرف المركزي والتقارير الدورية'],
                ],
            ],
            [
                'code' => 'C3',
                'tag' => ['en' => 'CBB · Payments', 'ar' => 'المصرف المركزي · المدفوعات'],
                'title' => ['en' => 'Payment Service Providers', 'ar' => 'مقدمو خدمات الدفع'],
                'description' => ['en' => 'Licensing payment institutions and ancillary service providers under the CBB.', 'ar' => 'ترخيص مؤسسات الدفع ومقدمي الخدمات المساندة لدى المصرف المركزي.'],
                'timeline' => ['en' => '8–14 weeks', 'ar' => '8–14 أسبوعًا'],
                'fee_from' => ['en' => 'On request', 'ar' => 'حسب الطلب'],
                'scope_lines' => [
                    'en' => ['PSP & ancillary services licensing', 'AML / CFT policies & framework', 'Regulatory capital & client safeguarding', 'CBB module compliance & onboarding'],
                    'ar' => ['ترخيص خدمات الدفع والخدمات المساندة', 'سياسات وإطار مكافحة غسل الأموال وتمويل الإرهاب', 'رأس المال التنظيمي وحماية أموال العملاء', 'الامتثال لوحدات المصرف المركزي والتأهيل'],
                ],
            ],
            [
                'code' => 'C4',
                'tag' => ['en' => 'CBB · Crypto-assets', 'ar' => 'المصرف المركزي · الأصول المشفّرة'],
                'title' => ['en' => 'Crypto-Asset Service Providers', 'ar' => 'مقدمو خدمات الأصول المشفّرة'],
                'description' => ['en' => 'Licensing crypto-asset firms under the CBB Crypto-asset (CRA) module.', 'ar' => 'ترخيص شركات الأصول المشفّرة بموجب وحدة الأصول المشفّرة لدى المصرف المركزي.'],
                'timeline' => ['en' => '10–18 weeks', 'ar' => '10–18 أسبوعًا'],
                'fee_from' => ['en' => 'On request', 'ar' => 'حسب الطلب'],
                'scope_lines' => [
                    'en' => ['CRA licensing (relevant categories)', 'Custody & safeguarding of client assets', 'AML & travel-rule compliance', 'Technology, cyber-security & resilience'],
                    'ar' => ['ترخيص الأصول المشفّرة (الفئات المعنية)', 'حفظ وحماية أصول العملاء', 'الامتثال لمكافحة غسل الأموال وقاعدة التحويل', 'التقنية والأمن السيبراني والمرونة'],
                ],
            ],
            [
                'code' => 'C5',
                'tag' => ['en' => 'CBB · Insurance', 'ar' => 'المصرف المركزي · التأمين'],
                'title' => ['en' => 'Insurance & Reinsurance Firms', 'ar' => 'شركات التأمين وإعادة التأمين'],
                'description' => ['en' => 'Licensing insurers, reinsurers, brokers and insurance intermediaries.', 'ar' => 'ترخيص شركات التأمين وإعادة التأمين والوسطاء.'],
                'timeline' => ['en' => '8–16 weeks', 'ar' => '8–16 أسبوعًا'],
                'fee_from' => ['en' => 'On request', 'ar' => 'حسب الطلب'],
                'scope_lines' => [
                    'en' => ['Insurance / reinsurance / broker licensing', 'Actuarial & solvency requirements', 'Conduct of business framework', 'Regulatory reporting & approved persons'],
                    'ar' => ['ترخيص التأمين وإعادة التأمين والوساطة', 'المتطلبات الاكتوارية والملاءة المالية', 'إطار ممارسة الأعمال', 'التقارير التنظيمية والأشخاص المعتمدون'],
                ],
            ],
            [
                'code' => 'C6',
                'tag' => ['en' => 'CBB · Banking', 'ar' => 'المصرف المركزي · المصارف'],
                'title' => ['en' => 'Bank Representative Offices', 'ar' => 'المكاتب التمثيلية للبنوك'],
                'description' => ['en' => 'Establishing representative offices of foreign banks in Bahrain.', 'ar' => 'تأسيس مكاتب تمثيلية للبنوك الأجنبية في البحرين.'],
                'timeline' => ['en' => '6–10 weeks', 'ar' => '6–10 أسابيع'],
                'fee_from' => ['en' => 'On request', 'ar' => 'حسب الطلب'],
                'scope_lines' => [
                    'en' => ['Representative office registration', 'Scope of permitted activities', 'Local presence & approved persons', 'CBB liaison & ongoing compliance'],
                    'ar' => ['تسجيل المكتب التمثيلي', 'نطاق الأنشطة المسموح بها', 'الحضور المحلي والأشخاص المعتمدون', 'التنسيق مع المصرف المركزي والامتثال المستمر'],
                ],
            ],
            [
                'code' => 'C7',
                'tag' => ['en' => 'CBB · Banking', 'ar' => 'المصرف المركزي · المصارف'],
                'title' => ['en' => 'Wholesale & Offshore Banks', 'ar' => 'بنوك الجملة والبنوك الخارجية'],
                'description' => ['en' => 'Licensing conventional and Islamic wholesale banks and branches.', 'ar' => 'ترخيص بنوك الجملة التقليدية والإسلامية وفروعها.'],
                'timeline' => ['en' => '12–24 weeks', 'ar' => '12–24 أسبوعًا'],
                'fee_from' => ['en' => 'On request', 'ar' => 'حسب الطلب'],
                'scope_lines' => [
                    'en' => ['Bank licensing (conventional / Islamic)', 'Capital adequacy & prudential requirements', 'Governance, risk & compliance framework', 'Controlled functions & approved persons'],
                    'ar' => ['ترخيص المصارف (التقليدية / الإسلامية)', 'كفاية رأس المال والمتطلبات الاحترازية', 'إطار الحوكمة والمخاطر والامتثال', 'الوظائف الخاضعة للرقابة والأشخاص المعتمدون'],
                ],
            ],
        ];
    }
}
