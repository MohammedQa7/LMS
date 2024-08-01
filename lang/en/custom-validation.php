<?php

return [
    'custom' => [
        'selected_courses' => [
            'level' => [
                'required' => 'Each course must have a level assoicated to it.',
                'exists' => 'The selected level is invalid.',
            ],
            'class' => [
                'required' => 'Each course must have a class selected.',
                'exists' => 'The selected class is invalid.',
            ],
            'subject' => [
                'required' => 'Each course must have a subject selected.',
                'exists' => 'The selected subject is invalid.',
            ],
        ],
    ],
];