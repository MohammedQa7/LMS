<?php

namespace App\Services;

use App\Models\FileMaterial;
use App\Models\Lecture;
use App\Models\LectureSection;
use App\Models\Material;
use App\Traits\NotificationTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MaterialsService
{
    use NotificationTrait;
    function FileSubmit($name_ar, $name_en, $subject_content_files, $selected_file_type, $status, $current_level)
    {

        try {
            DB::beginTransaction();
            $material = Material::create([
                'name' => [
                    'ar' => $name_ar,
                    'en' => $name_en,
                ],
                'subject_id' => $current_level->subject_id,
                'class_id' => $current_level->class_id,
            ]);

            if ($material) {
                foreach ($subject_content_files as $single_file) {
                    $file_path = $single_file->store('material/files', 'public');
                    $files = FileMaterial::create([
                        'material_id' => $material->id,
                        'file' => $file_path,
                        'type' => $selected_file_type,
                        'status' => $status,
                    ]);
                }
            }
            DB::commit();
            return $this->success('Material Has Been created successfully', 'heroicon-o-document-text', 5000);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            return $this->failed('something went wrong while creating material', 'heroicon-o-document-text', 5000);
        }
    }

    function LectureSubmit($lecture_name_ar, $lecture_name_en, $videoFiles, $video_url, $lecture_status, $selected_lecture_section)
    {
        try {
            if (is_array($videoFiles) && sizeof($videoFiles) <=0) {
                $videoFiles = null;
            }
            $file_path = !is_null($videoFiles)
                ? $videoFiles->store('lecture/videos' , 'public')
                : null;

            $lecture = Lecture::create([
                'name' => [
                    'ar' => $lecture_name_ar,
                    'en' => $lecture_name_en,
                ],
                'lecture_section_id' => $selected_lecture_section,
                'video_url' => !is_null($videoFiles) ? null : $video_url,
                'video_file' => $file_path ? $file_path : null,
                'status' => $lecture_status,
            ]);
            return $lecture;
        } catch (\Throwable $th) {
            dd($th);
            return null;
        }
    }

    function createLectureSection($current_level, $lecture_name_ar, $lecture_name_en)
    {
        try {
            DB::beginTransaction();
            $lectureSection = LectureSection::create([
                'name' => [
                    'ar' => $lecture_name_ar,
                    'en' => $lecture_name_en,
                ],
                'subject_id' => $current_level->subject_id,
                'class_id' => $current_level->class_id,
                'teacher_id' => Auth::user()->id,
            ]);
            DB::commit();
            return $lectureSection;
        } catch (\Throwable $th) {
            DB::rollBack();
            return null;
        }
    }

    function getLectures($class_id, $subject_id)
    {
        $lectures = LectureSection::where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->with('lectures')
            ->get();
        if (sizeof($lectures) > 0) {
            return $lectures;
        } else {
            return null;
        }
    }
}