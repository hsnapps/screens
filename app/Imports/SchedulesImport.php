<?php

namespace App\Imports;

use App\Schedule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Str;

class SchedulesImport implements ToCollection, WithHeadingRow
{
    protected $fingerprint;
    protected $user_name;
    protected $header;


    public function __construct(string $fingerprint, string $user_name)
    {
        HeadingRowFormatter::default('none');

        $this->fingerprint = $fingerprint;
        $this->user_name = $user_name;
        $this->header = true;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (isset($row['أوقات'])) {
                $row_10 = trim($row['أوقات']);
                $start = '00:00';
                $end = '00:00';
                $time_text = str_replace(' ', '', $row_10);
                $times = explode('-', $time_text);

                if (isset($times[1])) {
                    $start = sprintf('%s:%s', substr($times[1], 0, 2),substr($times[1], 2, 2));
                }

                if (isset($times[0])) {
                    $end = sprintf('%s:%s', substr($times[0], 0, 2),substr($times[0], 2, 2));
                }

                if (isset($row['أيام'])) {
                    $row_9 = trim($row['أيام']);
                    $more_than_one_day = Str::contains($row_9, ' ');

                    if ($more_than_one_day) {
                        $days = explode(' ', $row_9);
                        foreach ($days as $day) {
                            $this->createSchedule($row, $day, $start, $end);
                        }
                    } else {
                        $this->createSchedule($row, $row_9, $start, $end);
                    }
                }
            }

        }
    }

    private function createSchedule($row, $day, $start, $end)
    {
        $day_index = array_search($day, __('schedules.days'));

        Schedule::create([
            'fingerprint' => $this->fingerprint,
            'user_name' => $this->user_name,

            'term' => trim($row['الفصل التدريبي']),
            'college' => trim($row['الوحدة التدريبية']),
            'certificate' => trim($row['جزء الفصل']),
            'specialty' => trim($row['القسم']),
            'subject_code' => trim($row['المقرر']),
            'subject_name' => trim($row['اسم المقرر']),
            'reference' => trim($row['الرقم المرجعي']),
            'contact_hours' => trim($row['ساعات الاتصال']),
            'classification' => trim($row['نوع الشعبة']),
            'days' => trim($row['أيام']),
            'times' => trim($row['أوقات']),
            'building' => trim($row['مبنى']),
            'hall' => trim($row['قاعة']),
            'capacity' => trim($row['سعة']),
            'registered' => trim($row['مسجلين']),
            'rest' => trim($row['متبقي']),
            'instructor_name' => trim($row['المدرب']),
            'instructor_id' => trim($row['رقم الحاسب']),

            'day_index' => $day_index,
            'start' => $start,
            'end' => $end,
        ]);
    }
}
