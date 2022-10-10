<?php
namespace App\Services;

use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

class LessonServices
{
    public function lessonsInClassroom($id){
        $lesson = Lesson::select(
            'lessons.id',
            'lessons.classroom_id',
            'lessons.type',
            'lessons.start_time',
            'lessons.end_time',
            'subjects.name',
            'subjects.code',
            DB::raw('users.code as teacher'),
            DB::raw('lessons.tutor_email as tutor'),
            DB::raw('lessons.class_location_online'),
            DB::raw('lessons.class_location_offline'),
        )
        ->leftJoin('classrooms','classrooms.id','lessons.classroom_id')
        ->leftJoin('subjects','subjects.id','classrooms.subject_id')
        ->leftJoin('users','users.id','classrooms.user_id')
        ->where('classroom_id', $id)
        ->orderBy('lessons.start_time','ASC','lessons.end_time','ASC')->get();
        return $lesson;
    }

    public function store($data)
    {
        return Lesson::create($data);
    }

    public function update($data, $lesson)
    {
        return $lesson->update($data);
    }
    public function destroy($lesson)
    {
        $lesson->delete();
        return $lesson->trashed();
    }

}
