<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

/**
 * Real LevantBMS FAQs (source: levantbms.com/faqs) — English + Arabic.
 */
class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            'Setup' => [
                [
                    'q' => 'How long does it take to establish my company and get my investor visa?',
                    'a' => 'If all the required documents are received, the whole process takes three to four weeks. You receive your investor visa after the active Commercial Register (CR) is issued.',
                    'q_ar' => 'كم يستغرق تأسيس شركتي والحصول على تأشيرة المستثمر؟',
                    'a_ar' => 'في حال استلام جميع المستندات المطلوبة، تستغرق العملية بالكامل من ثلاثة إلى أربعة أسابيع. وتحصل على تأشيرة المستثمر بعد إصدار السجل التجاري الفعّال (CR).',
                ],
                [
                    'q' => 'When should I sign the rental agreement for my company?',
                    'a' => 'Sign the rental agreement after you receive security clearance and commercial name approval. Rents start from BD 80/month depending on office size.',
                    'q_ar' => 'متى يجب أن أوقّع عقد الإيجار الخاص بشركتي؟',
                    'a_ar' => 'وقّع عقد الإيجار بعد الحصول على الموافقة الأمنية واعتماد الاسم التجاري. تبدأ الإيجارات من 80 دينارًا بحرينيًا شهريًا حسب مساحة المكتب.',
                ],
                [
                    'q' => 'I am from a GCC country — can I open an establishment or company in Bahrain?',
                    'a' => 'Yes. GCC nationals are treated as Bahrainis and may establish an Individual Establishment or a company with 100% ownership.',
                    'q_ar' => 'أنا من دول مجلس التعاون الخليجي — هل يمكنني فتح مؤسسة أو شركة في البحرين؟',
                    'a_ar' => 'نعم. يُعامَل مواطنو دول مجلس التعاون الخليجي معاملة البحرينيين، ويمكنهم تأسيس مؤسسة فردية أو شركة بملكية كاملة 100%.',
                ],
                [
                    'q' => 'I am American — can I own any activity in the Bahrain market?',
                    'a' => 'Yes. US nationals are treated the same as Bahrainis and can own 100% of any activity — service, industrial or trading — with no Bahraini partner required.',
                    'q_ar' => 'أنا أمريكي — هل يمكنني تملّك أي نشاط في السوق البحريني؟',
                    'a_ar' => 'نعم. يُعامَل المواطنون الأمريكيون معاملة البحرينيين، ويمكنهم تملّك 100% من أي نشاط — خدمي أو صناعي أو تجاري — دون الحاجة إلى شريك بحريني.',
                ],
                [
                    'q' => 'I am not from a GCC country — do I need a Bahraini partner?',
                    'a' => 'It depends on the activity. Many activities permit full foreign ownership; a small number still require a Bahraini partner. Share your intended activity with us and we will confirm the exact requirement for your case.',
                    'q_ar' => 'لست من دول مجلس التعاون الخليجي — هل أحتاج إلى شريك بحريني؟',
                    'a_ar' => 'يعتمد ذلك على النشاط. تسمح العديد من الأنشطة بالملكية الأجنبية الكاملة، بينما لا يزال عدد قليل منها يتطلب شريكًا بحرينيًا. شاركنا النشاط الذي ترغب فيه وسنؤكد لك المتطلبات الدقيقة لحالتك.',
                ],
                [
                    'q' => 'Can I work in a GCC country and start my business in Bahrain as well?',
                    'a' => 'Yes. You can work in a GCC country and invest in Bahrain at the same time with no problem at all.',
                    'q_ar' => 'هل يمكنني العمل في إحدى دول الخليج وبدء عملي في البحرين أيضًا؟',
                    'a_ar' => 'نعم. يمكنك العمل في إحدى دول مجلس التعاون الخليجي والاستثمار في البحرين في الوقت نفسه دون أي مشكلة على الإطلاق.',
                ],
                [
                    'q' => 'I work for a Bahraini company — can I establish my own company?',
                    'a' => 'Yes. You can start your own business in Bahrain provided you obtain a no-objection letter from your current employer.',
                    'q_ar' => 'أعمل لدى شركة بحرينية — هل يمكنني تأسيس شركتي الخاصة؟',
                    'a_ar' => 'نعم. يمكنك بدء عملك الخاص في البحرين بشرط الحصول على رسالة عدم ممانعة من صاحب العمل الحالي.',
                ],
                [
                    'q' => 'Can I have more than one business activity in one CR?',
                    'a' => 'Yes. You can register multiple activities under one CR, and you can also open additional branches or companies.',
                    'q_ar' => 'هل يمكنني إدراج أكثر من نشاط تجاري في سجل تجاري واحد؟',
                    'a_ar' => 'نعم. يمكنك تسجيل عدة أنشطة ضمن سجل تجاري واحد، كما يمكنك فتح فروع أو شركات إضافية.',
                ],
            ],

            'Costs' => [
                [
                    'q' => "What is the minimum amount of the company's capital?",
                    'a' => "There is no fixed minimum capital. You can start with any amount, provided it is suitable to carry out the company's objectives.",
                    'q_ar' => 'ما هو الحد الأدنى لرأس مال الشركة؟',
                    'a_ar' => 'لا يوجد حد أدنى محدد لرأس المال. يمكنك البدء بأي مبلغ، شريطة أن يكون مناسبًا لتحقيق أهداف الشركة.',
                ],
                [
                    'q' => 'When should I deposit the company capital in a local bank?',
                    'a' => 'Capital should be deposited with a local bank before the final CR is issued — the bank certificate is required to complete registration. The capital can then be used normally.',
                    'q_ar' => 'متى يجب أن أودع رأس مال الشركة في بنك محلي؟',
                    'a_ar' => 'يجب إيداع رأس المال في بنك محلي قبل إصدار السجل التجاري النهائي — إذ تُطلب شهادة من البنك لإتمام التسجيل. ويمكن بعد ذلك استخدام رأس المال بشكل طبيعي.',
                ],
                [
                    'q' => 'What is the cost of establishing a new company?',
                    'a' => 'Indicative costs: Government fees BD 251 (all ministry fees; higher for some activities); electricity & water deposit BD 100 (refundable if unused); investor/employee visa BD 344 for 2 years or BD 172 for 1 year, plus BD 5/month LMRA; family visa BD 90 per member (2 years, no monthly LMRA fee); office rent from BD 80/month; and LevantBMS processing fees of BD 450 for commercial/service activities or BD 800 for industrial activities.',
                    'q_ar' => 'ما هي تكلفة تأسيس شركة جديدة؟',
                    'a_ar' => 'التكاليف التقديرية: الرسوم الحكومية 251 دينارًا (تشمل رسوم جميع الوزارات، وقد تزيد لبعض الأنشطة)؛ تأمين الكهرباء والماء 100 دينار (يُسترد إذا لم يُستخدم)؛ تأشيرة المستثمر/الموظف 344 دينارًا لمدة سنتين أو 172 دينارًا لمدة سنة، إضافة إلى 5 دنانير شهريًا لهيئة تنظيم سوق العمل؛ تأشيرة العائلة 90 دينارًا لكل فرد (لمدة سنتين، دون رسوم شهرية)؛ إيجار المكتب من 80 دينارًا شهريًا؛ ورسوم معالجة ليفانت 450 دينارًا للأنشطة التجارية والخدمية أو 800 دينار للأنشطة الصناعية.',
                ],
                [
                    'q' => 'What are the annual fees for renewing my company?',
                    'a' => "Just BD 50 to renew your company's CR each year. (1 BD ≈ 2.65 USD.)",
                    'q_ar' => 'ما هي الرسوم السنوية لتجديد شركتي؟',
                    'a_ar' => '50 دينارًا بحرينيًا فقط لتجديد السجل التجاري لشركتك سنويًا. (يعادل الدينار البحريني الواحد نحو 2.65 دولار أمريكي.)',
                ],
                [
                    'q' => 'What is the Labour Market Regulatory Authority (LMRA) bill?',
                    'a' => 'The LMRA bill is a nominal BD 5 per month for each investor or employee working in the company.',
                    'q_ar' => 'ما هي فاتورة هيئة تنظيم سوق العمل (LMRA)؟',
                    'a_ar' => 'فاتورة هيئة تنظيم سوق العمل هي مبلغ رمزي قدره 5 دنانير شهريًا عن كل مستثمر أو موظف يعمل في الشركة.',
                ],
            ],

            'Regulation' => [
                [
                    'q' => 'What are the types of residence permits in the Kingdom of Bahrain?',
                    'a' => 'Property owner, business owner, employee of a Bahrain company, student, and dependant visa.',
                    'q_ar' => 'ما هي أنواع تصاريح الإقامة في مملكة البحرين؟',
                    'a_ar' => 'مالك عقار، صاحب عمل، موظف لدى شركة بحرينية، طالب، وتأشيرة المرافقين (العائلة).',
                ],
                [
                    'q' => 'Can I get residence permits for my employees?',
                    'a' => "Yes. The number of residence permits depends on the size and type of the company's activity. Initially you can typically obtain two or three visas.",
                    'q_ar' => 'هل يمكنني الحصول على تصاريح إقامة لموظفيّ؟',
                    'a_ar' => 'نعم. يعتمد عدد تصاريح الإقامة على حجم ونوع نشاط الشركة. وفي البداية يمكنك عادةً الحصول على تأشيرتين أو ثلاث.',
                ],
            ],

            'After' => [
                [
                    'q' => 'Can I modify information about my company after it is established?',
                    'a' => 'Yes. After establishment you can change the company name, add or remove partners, add or delete business activities, open new branches, increase capital, and make other amendments.',
                    'q_ar' => 'هل يمكنني تعديل معلومات شركتي بعد تأسيسها؟',
                    'a_ar' => 'نعم. بعد التأسيس يمكنك تغيير اسم الشركة، وإضافة أو إزالة الشركاء، وإضافة أو حذف الأنشطة التجارية، وفتح فروع جديدة، وزيادة رأس المال، وإجراء تعديلات أخرى.',
                ],
                [
                    'q' => "What are the company's obligations after incorporation?",
                    'a' => "Renew the Commercial Register annually, renew residence permits every two years, pay rent and electricity bills, pay the LMRA bill, and prepare the company's financial report after each financial year.",
                    'q_ar' => 'ما هي التزامات الشركة بعد التأسيس؟',
                    'a_ar' => 'تجديد السجل التجاري سنويًا، وتجديد تصاريح الإقامة كل سنتين، وسداد فواتير الإيجار والكهرباء، ودفع فاتورة هيئة تنظيم سوق العمل، وإعداد التقرير المالي للشركة بعد كل سنة مالية.',
                ],
            ],
        ];

        $position = 0;

        foreach ($faqs as $category => $rows) {
            foreach ($rows as $row) {
                Faq::updateOrCreate(
                    ['category' => $category, 'position' => $position],
                    [
                        'question' => ['en' => $row['q'], 'ar' => $row['q_ar']],
                        'answer' => ['en' => $row['a'], 'ar' => $row['a_ar']],
                        'is_published' => true,
                    ]
                );
                $position++;
            }
        }
    }
}
