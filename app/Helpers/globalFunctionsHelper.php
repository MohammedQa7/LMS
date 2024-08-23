<?php

namespace App\Helpers;

use App\Models\Attendance;

class globalFunctionsHelper
{
    public static function allTypes()
    {
        return [
            'PDF',
            'TXT',
            'RTF',
            'DOCX',
            'CSV',
            'DOC',
            'PPT',
            'VIDEO',
            'OTHER',
        ];
    }

    public static function humanReadableFileSize($bytes, $decimals = 2)
    {
        $size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . $size[$factor];
    }

    public static function classNameRelatedToAttendanceStatus($status)
    {
        if ($status) {
            $class_name = match ($status) {
                Attendance::PRESENCE => 'bg-green-100 text-green-800',
                Attendance::ABSENT => 'bg-red-100 text-red-800',
                Attendance::LATE => 'bg-yellow-100 text-yellow-800',
            };

            return $class_name;
        }
    }


    public static function Permissions()
    {
        return [
            'Manage Levels' => 'Manage Levels',
            'Create Levels' => 'Create Level',

            'Manage Classes' => 'Manage Classes',
            'Create Class' => 'Create Class',


            'Manage Sections' => 'Manage Sections',
            'Create Section' => 'Create Section',

            'Manage Subjects' => 'Manage Subjects',
            'Create Subject' => 'Create Subject',

            'Manage Student Promotions' => 'Manage Student Promotions',
            'Manage Zoom Meetings' => 'Manage Zoom Meetings',
            'Manage Roles' => 'Manage Roles',
            'Finance Manager' => 'Finance Manager',
        ];
    }
}