<?php

return [
    'schedules' => [
        [
            'name' => 'report_send',
            'command' => 'report:send',
            'schedule' => '0 12,18 * * *',
            'output' => storage_path('logs/report_send.log'),
        ],
    ],
];
