<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassStudent;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClassStudentController extends BaseController
{
    protected $pageTitle = 'Danh sách học viên';
    public function __construct()
    {
        $this->model = ClassStudent::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.class-students';
        parent::__construct();
    }

    /**
     * Get students for a class
     */
    public function getStudents(Request $request)
    {
        try {
            $classId = $request->input('class_id');

            $class = Classes::findOrFail($classId);

            // Lấy danh sách học viên theo logic trong ClassStudent model
            $fields = ClassStudent::getFields();
            $optionsCallback = $fields['registration_id']['options'];

            $students = $optionsCallback(['class_id' => $classId]);

            return response()->json($students);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
