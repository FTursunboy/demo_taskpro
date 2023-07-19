<?php

namespace App\Http\Controllers\API\V1\Statistics;

use App\Models\Admin\CRM\Lead;

class LeadStatisticController
{
    public function LeadStatistic()
    {
        $months = ['Январь' => 'January',  'Февраль' => 'February', 'Март' => 'March', 'Апрель' => 'April', 'Май' => 'May', 'Июнь' => 'June', 'Июль' => 'July',
            'Авуст' => 'August', 'Сентябрь' => 'September', 'Октябрь' => 'October', 'Ноябрь' => 'November', 'Декабрь' => 'December'];

        $dataByMonth = [];
        $leadStatusIds = [1, 2, 3, 4, 5, 6, 7];

        foreach ($months as $month) {
            $monthTimestamp = strtotime($month);
            $monthNumber = date('m', $monthTimestamp);

            $counts = Lead::whereIn('lead_status_id', $leadStatusIds)
                ->whereMonth('created_at', $monthNumber)
                ->groupBy('lead_status_id')
                ->selectRaw('lead_status_id, COUNT(*) as count')
                ->pluck('count', 'lead_status_id');

            $dataByMonth[] = [
                'month' => $month,
                'count' => $counts->sum(),
                'first_meet' => $counts->get(1, 0),
                'potential_client' => $counts->get(2, 0),
                'treaty' => $counts->get(3, 0),
                'payment' => $counts->get(4, 0),
                'unquality_lead' => $counts->get(5, 0),
                'test_stage' => $counts->get(6, 0),
                'kp' => $counts->get(7, 0),
            ];
        }

        return response([
            'message' => true,
            'dataByMonth' => $dataByMonth
        ]);
    }

}
