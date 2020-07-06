<?php

function getWorkingDays($startDate, $endDate) {
    $begin = strtotime($startDate);
    $end = strtotime($endDate);
    if ($begin > $end) {
        return 0;
    } else {
        $no_days = 0;
        $weekends = 0;
        while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
                $weekends++;
            }
            $begin += 86400; // +1 day
        }
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}

function DiasUteis($startDate, $endDate) {
    $diasUteis = array();
    while ($startDate <= $endDate) {
        $date = date_create($startDate);
        $diaDaSemana = date_format($date, 'N');
        if ($diaDaSemana < 6) {
            $diasUteis[] = date_format($date, 'd/m/Y');
        }
        $startDate = date('Y-m-d', strtotime('+1 days', strtotime($startDate)));
    }
    return $diasUteis;
}
