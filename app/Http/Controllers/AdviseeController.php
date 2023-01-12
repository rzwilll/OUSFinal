<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advisee;
use App\Models\AcadYear;
use App\Models\ProgramOutputsDeliverables;
use App\Models\ProgramEngagementActivities;
use App\Models\ConsultationAdvising;
use App\Models\RiskChallenges;
use App\Models\CollaborationsLinkages;
use App\Models\ProblemsEncountered;
use App\Models\Recommendations;
use App\Models\Reports;
use App\Models\Student;
use App\Models\ProgramPlans;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;



class AdviseeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function index()
    {
        // $user = Auth::user();

        //

        
        // SELECT * FROM advisees 
        // INNER JOIN users ON users.id = advisees.user_id 
        // INNER JOIN students ON advisees.student_id = students.id 
        // INNER JOIN acad_terms ON advisees.term_id = acad_terms.id 
        // WHERE users.id = 1 AND acad_terms.acadyear_id = 1 AND acad_terms.acad_sem = 2;


        // SELECT acad_years.acad_yr, students.stud_idnum, students.stud_last, students.stud_first, students.stud_mi, (SUM(subject_grades.grade*subjects.subject_unit)/SUM(subjects.subject_unit)) as GPA FROM subject_grades
        // INNER JOIN subjects ON subject_grades.subject_id = subjects.id
        // INNER JOIN students ON subject_grades.stud_id = students.id
        // INNER JOIN acad_terms ON subject_grades.term_id = acad_terms.id
        // INNER JOIN acad_years ON acad_terms.acadyear_id = acad_years.id
        // WHERE acad_terms.acad_sem =1 AND acad_years.id = 1 AND students.id = 2;
        $adviseelist = [];
        $academic_school_year = AcadYear::orderBy('status', 'DESC')->get();
        $currrent_year = AcadYear::where('status', 1)->first();

        $adviseelist_students = DB::table('advisees')
        ->join('users', 'users.id', '=', 'advisees.user_id')
        ->join('students', 'advisees.student_id', '=', 'students.id')
        ->join('acad_terms', 'advisees.term_id', '=', 'acad_terms.id')
        ->where('users.id', '=', auth()->user()->id)
        ->where('acad_terms.acadyear_id', $currrent_year->id) 
        ->where('acad_terms.acad_sem',1, )
        ->select('students.*')
        ->get(); 

        foreach ($adviseelist_students as $value) {


            $student_grade = DB::table('subject_grades')
            ->join('acad_terms', 'subject_grades.term_id', '=', 'acad_terms.id')
            ->join('subjects', 'subject_grades.subject_id', '=', 'subjects.id')
            ->where('acad_terms.acad_sem', '=', 1)
            ->where('acad_terms.acadyear_id', $currrent_year->id) 
            ->where('subject_grades.stud_id',$value->id)
            ->select('subjects.subject_unit', 'subject_grades.year_level', 'subject_grades.grade')
            ->get();


            $gpa = 0;
            $total_units = 0;
            $total_subject_times_unit = 0;
            $yearLevel = "";


            foreach ($student_grade as $std_grade){
                if($std_grade-> grade != 'INC'||$std_grade-> grade != 'WDRW' || $std_grade-> grade != 'DRP' ){
                    $total_units = ($total_units + $std_grade->subject_unit);
                    $total_subject_times_unit = ($total_subject_times_unit + ((float)$std_grade->grade * $std_grade->subject_unit));
                    $yearLevel = $std_grade->year_level;
                }
            }

            $gpa = ($total_subject_times_unit/$total_units);


            
            
            $student_gpa = array(
                'id' => $value->id,
                'stud_idnum' => $value->stud_idnum,
                'stud_last' => $value->stud_last,
                'stud_first' => $value->stud_first,
                'stud_mi' => $value->stud_mi,
                'student_gpa' => $gpa,
                'total_units' => $total_units,
                'year_level' => $yearLevel,
                'total_subject_times_unit' => $total_subject_times_unit,
                'sem_id' => 1,
                'year_id' => $currrent_year->id
            );

            array_push($adviseelist, $student_gpa);

            $gpa = 0;
            $total_units = 0;
            $total_subject_times_unit = 0;
            $yearLevel = "";
        }


        return view('advisee.index', compact('adviseelist', 'academic_school_year'));

    }

    public function get_advisee_list(Request $request){

        $adviseelist = [];
        $academic_school_year = AcadYear::orderBy('status', 'DESC')->get();

        $adviseelist_students = DB::table('advisees')
        ->join('users', 'users.id', '=', 'advisees.user_id')
        ->join('students', 'advisees.student_id', '=', 'students.id')
        ->join('acad_terms', 'advisees.term_id', '=', 'acad_terms.id')
        ->where('users.id', '=', auth()->user()->id)
        ->where('acad_terms.acadyear_id', $request->year_id,) 
        ->where('acad_terms.acad_sem',$request->sem_id, )
        ->select('students.*')
        ->get(); 

        foreach ($adviseelist_students as $value) {


            $student_grade = DB::table('subject_grades')
            ->join('acad_terms', 'subject_grades.term_id', '=', 'acad_terms.id')
            ->join('subjects', 'subject_grades.subject_id', '=', 'subjects.id')
            ->where('acad_terms.acad_sem', '=', $request->sem_id)
            ->where('acad_terms.acadyear_id', $request->year_id) 
            ->where('subject_grades.stud_id',$value->id)
            ->select('subjects.subject_unit', 'subject_grades.year_level', 'subject_grades.grade')
            ->get();


            $gpa = 0;
            $total_units = 0;
            $total_subject_times_unit = 0;
            $yearLevel = "";


            foreach ($student_grade as $std_grade){
                if($std_grade-> grade != 'INC'||$std_grade-> grade != 'WDRW' || $std_grade-> grade != 'DRP' ){
                    $total_units = ($total_units + $std_grade->subject_unit);
                    $total_subject_times_unit = ($total_subject_times_unit + ((float)$std_grade->grade * $std_grade->subject_unit));
                    $yearLevel = $std_grade->year_level;
                }
                
            }

            $gpa = ($total_subject_times_unit/$total_units);


            
            
            $student_gpa = array(
                'id' => $value->id,
                'stud_idnum' => $value->stud_idnum,
                'stud_last' => $value->stud_last,
                'stud_first' => $value->stud_first,
                'stud_mi' => $value->stud_mi,
                'student_gpa' => number_format($gpa, 3, '.', ''),
                'total_units' => $total_units,
                'year_level' => $yearLevel,
                'total_subject_times_unit' => $total_subject_times_unit,
                'sem_id' => $request->sem_id,
                'year_id' =>$request->year_id
            );

            array_push($adviseelist, $student_gpa);

            $gpa = 0;
            $total_units = 0;
            $total_subject_times_unit = 0;
            $yearLevel = "";
        }

        return response()->json($adviseelist);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ids)
    {
        $parameters = explode(" ", $ids);

        // $student_info = Student::where('id', $parameters[0])->first();
        $student_info = DB::table('students')
        ->join('programs', 'students.program_id', '=', 'programs.id')
        ->where('students.id', $parameters[0])
        ->select('students.*', 'programs.program_name')->first();

        $year_level = $parameters[3];
        $sem_id = $parameters[2];
        $acad_year = $parameters[1];

        $student_grade = DB::table('subject_grades')
        ->join('acad_terms', 'subject_grades.term_id', '=', 'acad_terms.id')
        ->join('subjects', 'subject_grades.subject_id', '=', 'subjects.id')
        ->where('acad_terms.acad_sem', $sem_id)
        ->where('acad_terms.acadyear_id', $acad_year) 
        ->where('subject_grades.stud_id',$parameters[0])
        ->get();
        // return $student_grade;

        $acad_year = AcadYear::where('id', $parameters[1])->first();

        $gpa = 0;
        $total_units = 0;
        $total_subject_times_unit = 0;
        $yearLevel = "";


        foreach ($student_grade as $std_grade){
            if($std_grade-> grade != 'INC'||$std_grade-> grade != 'WDRW' || $std_grade-> grade != 'DRP' ){
                    $total_units = ($total_units + $std_grade->subject_unit);
                    $total_subject_times_unit = ($total_subject_times_unit + ((float)$std_grade->grade * $std_grade->subject_unit));
                    $yearLevel = $std_grade->year_level;
                }
            
        }
        $gpa = number_format(($total_subject_times_unit/$total_units), 3, '.', '');
        
        return view('advisee.view', compact('student_info', 'year_level', 'sem_id', 'student_grade', 'acad_year', 'gpa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function get_student_cgpa($std_id){

    // }
}
