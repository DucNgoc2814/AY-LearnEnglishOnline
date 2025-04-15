<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Classes;
use App\Models\Student;

class TestClassStudentRelationship extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-class-student-relationship';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the relationship between Classes and Student models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Class->Student relationship');
        
        // Test getting students for a class
        $class = Classes::find(1);
        if (!$class) {
            $this->error('Class with ID 1 not found');
            return 1;
        }
        
        $this->info("Class found: {$class->name}");
        
        $students = $class->students;
        $this->info("Number of students in class: " . count($students));
        
        if (count($students) > 0) {
            $this->info("First student: " . $students->first()->id);
            $this->info("Pivot data: " . json_encode($students->first()->pivot->toArray()));
        }
        
        // Test getting classes for a student
        $this->info('Testing Student->Class relationship');
        $student = Student::find(1);
        if (!$student) {
            $this->error('Student with ID 1 not found');
            return 1;
        }
        
        $this->info("Student found: {$student->id}");
        
        $classes = $student->classes;
        $this->info("Number of classes for student: " . count($classes));
        
        if (count($classes) > 0) {
            $this->info("First class: " . $classes->first()->name);
            $this->info("Pivot data: " . json_encode($classes->first()->pivot->toArray()));
        }
        
        $this->info('Relationship test completed successfully');
        return 0;
    }
}
