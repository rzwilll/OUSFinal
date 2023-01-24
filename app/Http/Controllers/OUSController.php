<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advisee;
use App\Models\AcadYear;
use App\Models\ReportPdfs;

use App\Models\ProgramOutputsDeliverables;
use App\Models\ProgramEngagementActivities;
use App\Models\ConsultationAdvising;
use App\Models\RiskChallenges;
use App\Models\CollaborationsLinkages;
use App\Models\ProblemsEncountered;
use App\Models\Recommendations;
use App\Models\Reports;
use App\Models\ProgramPlans;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PDF;

use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Response;





class OUSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //  SELECT * FROM advisees
    // INNER JOIN users ON advisees.user_id  = users.id
    // INNER JOIN students ON advisees.student_id = students.id
    // INNER JOIN programs ON students.program_id = programs.id
    // INNER JOIN departments ON programs.department_id = departments.id
    // WHERE user_id = 6 AND department_id=1;
    public function index()
    {
        //
        $reports = DB::table('acad_years')
        ->join('acad_terms', 'acad_terms.acadyear_id', '=', 'acad_years.id')
        ->join('advisees', 'advisees.term_id', '=', 'acad_terms.id')
        ->join('reports', 'reports.advisee_id', '=', 'advisees.id')
        ->where('advisees.user_id', '=', auth()->user()->id)
        ->select('reports.id as re_id',  'reports.remarks as remarks','reports.status', 'acad_years.acad_yr as school_year', 'reports.created_at')
        ->get();
        return view('ous.index', compact('reports'));
    }

    public function adminHome()
    {
        //
        $reports = DB::table('acad_years')
        ->join('acad_terms', 'acad_terms.acadyear_id', '=', 'acad_years.id')
        ->join('advisees', 'advisees.term_id', '=', 'acad_terms.id')
        ->join('reports', 'reports.advisee_id', '=', 'advisees.id')
        ->join('users', 'advisees.user_id', '=', 'users.id')
        ->join('advisers','users.id', '=', 'advisers.user_id')
        ->join('departments', 'advisers.department_id', '=', 'departments.id')
        ->join('programs', 'departments.id','=', 'programs.department_id')
        ->select('reports.id as re_id', 'reports.status', 'programs.program_name as program', 'users.name as name', 'acad_years.acad_yr as school_year', 'reports.created_at')
        ->get();
        return view('admin.index', compact('reports'));
    }

    public function request_resubmit($id)
    {
        $remarks = request()->input('remarks'); // retrieve the passed remarks
    
        // Delete the record in the report_pdfs table
        DB::table('report_pdfs')->where('report_id', $id)->delete();
    
        // Update the status of the report record and the remarks
        $report = Reports::find($id);
        $report->status = 2;
        $report->remarks = $remarks;
        $report->save();
    
        return redirect()->back()->with('status', 'Updated Successfully');
    }

    public function approve_report($id){
        $report = Reports::find($id);
        $report->status = 3;
        $report->save();

        $approve = DB::table('report_pdfs')
        ->where('report_id', $id)
        ->update(['status' => 1]);

        return redirect()->back()->with('status', 'Updated Successfully');


    }
    // public function admin_view_report($id) {
    //     $pdf = ReportPdfs::where ('report_id', $id)->first();  

    //     if (!$pdf) {
    //         abort(404);
    //     }

    //     $path = storage_path($pdf->pdf_path);

    //     // Make sure the file exists
    //     if (!file_exists($path)) {
    //         abort(404);
    //     }

    //     return Response::make(file_get_contents($path), 200, [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'inline; filename="ous.pdf"',
    //     ]);


    // }


    public function submit_ous_report(Request $request){
        
        $data = $request->all();
        if(isset($data['report_id'])){

                
            $reports = Reports::where('id', $data['report_id'])->first();
            $reports->status = 1;
            $reports->save();

            return response()->json(array('success' => true), 200);
        }

    }
    
    public function get_survival_rate($acadYear, $userId){
        
        $termId = ($acadYear == "1") ? 2 : 4;
  
        $firstSemStudents= DB::select("SELECT count(*) as result from advisees a 
                                where a.term_id = '1' && a.user_id = '$userId'");

        $secondSemStudents= DB::select("SELECT count(*) as result from advisees a 
                                where a.term_id = '$termId' && a.user_id = '$userId'");

        return ($secondSemStudents[0]->result/$firstSemStudents[0]->result ) * 100;
        
    }public function get_drop_rate($acadYear, $userId){

        $termIds = ($acadYear == "1") ? array(1,2) : array(1,2,3,4);
    
        /**
         * get students of $userId
         */
        
        $students = DB::select("SELECT distinct((a.student_id)) as student_id  from advisees a 
                where a.user_id = '$userId' && a.term_id in (" .implode(',', $termIds) . " )");

        $studentData = array();
        foreach($students as $value){
            array_push($studentData, $value->student_id);
        }

        $count = DB::select("SELECT count(distinct sg.stud_id) as result from subject_grades sg 
                where sg.term_id in (" .implode(',', $termIds) . " ) 
                && sg.grade = 'DRP' && sg.stud_id in (" .implode(',', $studentData) . " ) ");

        
        return ($count[0]->result / sizeof($studentData)) * 100;
    

    }

    public function  get_failure_rate($acadYear, $userId){
    
        $termIds = ($acadYear == "1") ? array(1,2) : array(1,2,3,4);
    
        /**
         * get students of $userId
         */
        
        $students = DB::select("SELECT distinct((a.student_id)) as student_id  from advisees a 
                where a.user_id = '$userId' && a.term_id in (" .implode(',', $termIds) . " )");

        $studentData = array();
        foreach($students as $value){
            array_push($studentData, $value->student_id);
        }

        $count = DB::select("SELECT count(distinct sg.stud_id) as result from subject_grades sg 
                where sg.term_id in (" .implode(',', $termIds) . " ) 
                && sg.grade = 5 && sg.stud_id in (" .implode(',', $studentData) . " ) ");

        
        return ($count[0]->result / sizeof($studentData)) * 100;
        
    }
    
    public function get_student_fail_grade($acadYear, $userId){
        $termIds = ($acadYear == "1") ? array(1,2) : array(1,2,3,4);
    
        /**
         * get students of $userId
         */
        
        $students = DB::select("SELECT distinct((a.student_id)) as student_id  from advisees a 
                where a.user_id = '$userId' && a.term_id in (" .implode(',', $termIds) . " )");

        $studentData = array();
        foreach($students as $value){
            array_push($studentData, $value->student_id);
        }

        $count = DB::select("SELECT count(distinct sg.stud_id) as result from subject_grades sg 
                where sg.term_id in (" .implode(',', $termIds) . " ) 
                && sg.grade = 5 && sg.stud_id in (" .implode(',', $studentData) . " ) ");

        
        return $count[0]->result;
    }

    public function get_student_inc_grade($acadYear, $userId){
        $termIds = ($acadYear == "1") ? array(1,2) : array(1,2,3,4);
    
        /**
         * get students of $userId
         */
        
        $students = DB::select("SELECT distinct((a.student_id)) as student_id  from advisees a 
                where a.user_id = '$userId' && a.term_id in (" .implode(',', $termIds) . " )");

        $studentData = array();
        foreach($students as $value){
            array_push($studentData, $value->student_id);
        }

        $count = DB::select("SELECT count(distinct sg.stud_id) as result from subject_grades sg 
                where sg.term_id in (" .implode(',', $termIds) . " ) 
                && sg.grade = 'INC' && sg.stud_id in (" .implode(',', $studentData) . " ) ");

        
        return $count[0]->result;
    }

    public function get_gpa_student($acadYear, $userId){
        $termId = ($acadYear == "1") ? 2 : 4;
   
        /**
         * get students of $userId
         */
        $students = DB::select("SELECT * from advisees where user_id = '$userId' 
                    && term_id = '$termId'");
        $result = 0;
        $numStudents = 0; 
        $totalStudentGPA = 0;

        foreach($students as $value){
            $studentId = $value->student_id;

            $getStudentGrade = DB::select("SELECT * from subject_grades sg 
                    inner join subjects s on s.id = sg.subject_id  
                    where sg.stud_id = '$studentId' && sg.term_id = $termId");

            $grades = 0;
            $units = 0;
            $counter = 0;
            foreach($getStudentGrade as $studentGrade){
                
                    $grades += ($studentGrade->grade * $studentGrade->subject_unit);
                    $units+=$studentGrade->subject_unit;
        }

            $totalStudentGPA += ($grades/$units);

            $numStudents+=1;
        }
        
        return round(($totalStudentGPA/$numStudents),3);

    }

    public function get_average_cgpa($acadYear, $userId){
        $termIds = ($acadYear == "1") ? array(1,2) : array(1,2,3,4);

        $students = DB::select("SELECT distinct((a.student_id)) as student_id  from advisees a 
                where a.user_id = '$userId' && a.term_id in (" .implode(',', $termIds) . " )");
        
        $result = 0;
        $totalUnits = 0;
        $totalGPA = 0;
        
        foreach($students as $student){
            $studentsGrade = DB::select(" SELECT distinct(sg.id) as id, sg.grade as grades, sg.subject_id, sg.term_id ,
                s.subject_unit  from subject_grades sg 
                inner join advisees a on a.student_id = sg.stud_id 
                inner join subjects s on sg.subject_id = s.id 
                where sg.term_id  in (" .implode(',', $termIds) . " )  && sg.stud_id = '$student->student_id'");
            
            $grade = 0;
            $numUnit = 0;
            $counter =0;
            foreach($studentsGrade as $studentGrade){
                
                $grade += ($studentGrade->grades * $studentGrade->subject_unit);
                $numUnit+=$studentGrade->subject_unit;
                
                

        
    }

            $studentGPA = $grade/$numUnit;

            $totalUnits += $numUnit;
            $totalGPA += ($studentGPA * $numUnit);

        }

        return round($totalGPA/$totalUnits, 3);

    }

    public function get_cgpa_below_2_5($acadYear, $userId){
        $termIds = ($acadYear == "1") ? array(1,2) : array(1,2,3,4);

        $students = DB::select("SELECT distinct((a.student_id)) as student_id  from advisees a 
                where a.user_id = '$userId' && a.term_id in (" .implode(',', $termIds) . " )");
        
        $result = 0;

        
        foreach($students as $student){
            $studentsGrade = DB::select(" SELECT distinct(sg.id) as id, sg.grade as grades, sg.subject_id, sg.term_id ,
                s.subject_unit  from subject_grades sg 
                inner join advisees a on a.student_id = sg.stud_id 
                inner join subjects s on sg.subject_id = s.id 
                where sg.term_id  in (" .implode(',', $termIds) . " )  && sg.stud_id = '$student->student_id'");
            
            $grade = 0;
            $numUnit = 0;
            $counter =0;
            foreach($studentsGrade as $studentGrade){
               
                $grade += ($studentGrade->grades * $studentGrade->subject_unit);
                $numUnit+=$studentGrade->subject_unit;
           
        }

            $studentGPA = $grade/$numUnit;

            if($studentGPA > 2.50){
                $result+=1;
            }

        }

        return $result;
    }

    public function get_student_records($acadYear, $userId){
    
        $num_student_rizalist = 0;
        $num_student_chancellor = 0;
        $num_student_deans_list = 0;
        $num_student_below_gpa_2_5 = 0;

        $termId = ($acadYear == "1") ? 2 : 4;
   
        /**
         * get students of $userId
         */
        $students = DB::select("SELECT * from advisees where user_id = '$userId' 
                    && term_id = '$termId'");

        $numStudents = 0; 

        foreach($students as $value){
            $studentId = $value->student_id;

            $getStudentGrade = DB::select("SELECT * from subject_grades sg 
                    inner join subjects s on s.id = sg.subject_id  
                    where sg.stud_id = '$studentId' && sg.term_id = $termId");

            $grades = 0;
            $units = 0;

            $counter = 0;
            foreach($getStudentGrade as $studentGrade){
                if($studentGrade-> grade == 'INC'||$studentGrade-> grade == 'WDRW' || $studentGrade-> grade == 'DRP' ){

                $counter+=1;
                }
                else{
                    $grades += ($studentGrade->grade * $studentGrade->subject_unit);
                    $units+=$studentGrade->subject_unit;
                }
        }
    
            
            $studentGPA = $grades/$units;
    
            if($studentGPA >= 1 && 1.20 >= $studentGPA){
                $num_student_rizalist+=1;
            }
            else if($studentGPA >= 1.21 && 1.45 >= $studentGPA){
                $num_student_chancellor +=1;
            }
            else if($studentGPA >= 1.46 && 1.75 >= $studentGPA){
                $num_student_deans_list +=1;
            }
            else if($studentGPA > 2.50){
                $num_student_below_gpa_2_5 += 1;
            }
            $numStudents+=1;
        }
 

        $result = array($num_student_below_gpa_2_5, $num_student_rizalist/$numStudents
                ,$num_student_chancellor, $num_student_deans_list);
        
        return $result;
    }

    public function get_promotion_rate($acadYear, $userId){

        $termId = ($acadYear == "1") ? 2 : 4;
   
        /**
         * get students of $userId
         */
        $students = DB::select("SELECT * from advisees where user_id = '$userId' 
                    && term_id = '$termId'");
        $result = 0;
        $numStudents = 0; 
        foreach($students as $value){
            $studentId = $value->student_id;

            $getStudentGrade = DB::select("SELECT * from subject_grades sg 
                    inner join subjects s on s.id = sg.subject_id  
                    where sg.stud_id = '$studentId' && sg.term_id = $termId");

            $grades = 0;
            $units = 0;
            $counter = 0;
            foreach($getStudentGrade as $studentGrade){
               
                    $grades += ($studentGrade->grade * $studentGrade->subject_unit);
                    $units+=$studentGrade->subject_unit;
                }
            if(3 >= ($grades/$units)){
                $result+=1;
            }

            $numStudents+=1;
        }
        return ($result/$numStudents) * 100;
        
    }

    

    // public function get_advisee_info($id)
    // {
    // $adviser_info = DB::table('advisees')
    // ->join('users', 'advisees.user_id', '=', 'users.id')
    // ->join('students', 'advisees.student_id', '=', 'students.id')
    // ->join('users', 'advisees.user_id', '=', 'users.id')
    // ->join('programs', 'students.program_id','=', 'programs.id')
    // ->join('departments', 'programs.department_id', '=', 'departments.id')
    // ->where('users.id', '=', auth()->user()->id)
    // ->where( 'programs.id', 'departments.id')->first()
    // ->select('users.name as user ', 'programs.program_name as program', 'departments.department_name as dept')
    // ->get();
    

    // return $adviser_info;

    // }

    public function get_withdraw_student($acadYear, $userId){
        
        $termId = ($acadYear == "1") ? 2 : 4;
  
        $firstSemStudents= DB::select("SELECT count(*) as result from advisees a 
                                where a.term_id = '1' && a.user_id = '$userId'");

        $secondSemStudents= DB::select("SELECT count(*) as result from advisees a 
                                where a.term_id = '$termId' && a.user_id = '$userId'");

        return ($firstSemStudents[0]->result-$secondSemStudents[0]->result );
    }

    public function get_ous_details($id){

        $report_status = Reports::where('id', $id)->first();
        $userId = auth()->user()->id;
       

        $adviser_info = DB::table('advisers')
        ->join('users', 'advisers.user_id', '=', 'users.id')
        ->join('departments', 'advisers.department_id', '=', 'departments.id')
        ->join('programs', 'programs.department_id', '=', 'departments.id')
        ->where('advisers.user_id', '=', auth()->user()->id)
        ->select('users.name as name', 'programs.program_name as prog','departments.department_name as dept')->first();
        


        $program_activities = ProgramEngagementActivities::where("report_id", $id)->get();
        $program_outputs_deliverables = ProgramOutputsDeliverables::where("report_id", $id)->get();
        $program_consultation_advising = ConsultationAdvising::where("report_id", $id)->get();
        $program_risk_challenges = RiskChallenges::where("report_id", $id)->get();
        $program_collaboration_linkages= CollaborationsLinkages::where("report_id", $id)->get();
        $program_problems_encountered = ProblemsEncountered::where("report_id", $id)->get();
        $program_recommendations = Recommendations::where("report_id", $id)->get();
        $program_program_plans = ProgramPlans::where("report_id", $id)->get();
       
        $reports = DB::select("SELECT * from reports r 
                                inner join advisees a on a.id  = r.advisee_id 
                                inner join acad_terms at2 on at2.id = a.term_id 
                                inner join acad_years ay on ay.id = at2.acadyear_id 
                                where r.id = '$id'"
                            );
        $dropout_rate = $this->get_drop_rate($reports[0]->acadyear_id, $userId);
        $survival_rate = $this->get_survival_rate($reports[0]->acadyear_id, $userId);
        $promotion_rate = $this->get_promotion_rate($reports[0]->acadyear_id, $userId);
        $failure_rate = $this->get_failure_rate($reports[0]->acadyear_id, $userId);
        $average_students_gpa = $this->get_gpa_student($reports[0]->acadyear_id, $userId);
        $average_students_cgpa = $this->get_average_cgpa($reports[0]->acadyear_id, $userId);
        $student_reports = $this->get_student_records($reports[0]->acadyear_id, $userId);
        $num_student_fail_grade = $this->get_student_fail_grade($reports[0]->acadyear_id, $userId);
        $num_student_inc_grade = $this->get_student_inc_grade($reports[0]->acadyear_id, $userId);
        $num_student_withdraw = $this->get_withdraw_student($reports[0]->acadyear_id, $userId);
        $num_student_cgpa_below_2_5 = $this->get_cgpa_below_2_5($reports[0]->acadyear_id, $userId);

        $termId = $reports[0]->term_id;
        $queryNumberEnrolee = DB::select("SELECT COUNT(*) as numberOfEnrollee FROM advisees  where term_id= '$termId'
                                && user_id = '$userId'");
       
        
        $report_id = $id;
        return view('ous.details', compact('program_activities', 'report_id', 'program_outputs_deliverables', 
                    'program_consultation_advising', 'program_risk_challenges','program_collaboration_linkages', 
                    'program_problems_encountered','survival_rate','num_student_cgpa_below_2_5','average_students_cgpa', 'num_student_fail_grade','student_reports','dropout_rate','average_students_gpa', 'failure_rate','promotion_rate',
                    'reports','program_recommendations','queryNumberEnrolee', 'program_program_plans', 
                    'report_status', 'num_student_inc_grade','adviser_info','num_student_withdraw'));
    }


    public function get_pdf_details($id){

        $report_status = Reports::where('id', $id)->first();
        $userId = auth()->user()->id;
       

        $adviser_info = DB::table('advisers')
        ->join('users', 'advisers.user_id', '=', 'users.id')
        ->join('departments', 'advisers.department_id', '=', 'departments.id')
        ->join('programs', 'programs.department_id', '=', 'departments.id')
        ->where('advisers.user_id', '=', auth()->user()->id)
        ->select('users.name as name', 'programs.program_name as prog','departments.department_name as dept')->first();
        


        $program_activities = ProgramEngagementActivities::where("report_id", $id)->get();
        $program_outputs_deliverables = ProgramOutputsDeliverables::where("report_id", $id)->get();
        $program_consultation_advising = ConsultationAdvising::where("report_id", $id)->get();
        $program_risk_challenges = RiskChallenges::where("report_id", $id)->get();
        $program_collaboration_linkages= CollaborationsLinkages::where("report_id", $id)->get();
        $program_problems_encountered = ProblemsEncountered::where("report_id", $id)->get();
        $program_recommendations = Recommendations::where("report_id", $id)->get();
        $program_program_plans = ProgramPlans::where("report_id", $id)->get();
       
        $reports = DB::select("SELECT * from reports r 
                                inner join advisees a on a.id  = r.advisee_id 
                                inner join acad_terms at2 on at2.id = a.term_id 
                                inner join acad_years ay on ay.id = at2.acadyear_id 
                                where r.id = '$id'"
                            );
        $dropout_rate = $this->get_drop_rate($reports[0]->acadyear_id, $userId);
        $survival_rate = $this->get_survival_rate($reports[0]->acadyear_id, $userId);
        $promotion_rate = $this->get_promotion_rate($reports[0]->acadyear_id, $userId);
        $failure_rate = $this->get_failure_rate($reports[0]->acadyear_id, $userId);
        $average_students_gpa = $this->get_gpa_student($reports[0]->acadyear_id, $userId);
        $average_students_cgpa = $this->get_average_cgpa($reports[0]->acadyear_id, $userId);
        $student_reports = $this->get_student_records($reports[0]->acadyear_id, $userId);
        $num_student_fail_grade = $this->get_student_fail_grade($reports[0]->acadyear_id, $userId);
        $num_student_inc_grade = $this->get_student_inc_grade($reports[0]->acadyear_id, $userId);
         $num_student_withdraw = $this->get_withdraw_student($reports[0]->acadyear_id, $userId);
  
        $num_student_cgpa_below_2_5 = $this->get_cgpa_below_2_5($reports[0]->acadyear_id, $userId);

        $termId = $reports[0]->term_id;
        $queryNumberEnrolee = DB::select("SELECT COUNT(*) as numberOfEnrollee FROM advisees  where term_id= '$termId'
                                && user_id = '$userId'");
       
        
        $report_id = $id;
        // return view('ous.details', compact('program_activities', 'report_id', 'program_outputs_deliverables', 
        //             'program_consultation_advising', 'program_risk_challenges','program_collaboration_linkages', 
        //             'program_problems_encountered','survival_rate','num_student_cgpa_below_2_5','average_students_cgpa', 'num_student_fail_grade','student_reports','dropout_rate','average_students_gpa', 'failure_rate','promotion_rate',
        //             'reports','program_recommendations','queryNumberEnrolee', 'program_program_plans', 
        //             'report_status', 'num_student_inc_grade','adviser_info'));

        

        

        $pdf = PDF::loadView('ous.pdf', compact('program_activities', 'report_id', 'program_outputs_deliverables', 
        'program_consultation_advising', 'program_risk_challenges','program_collaboration_linkages', 
        'program_problems_encountered','survival_rate','num_student_cgpa_below_2_5','average_students_cgpa', 'num_student_fail_grade','student_reports','dropout_rate','average_students_gpa', 'failure_rate','promotion_rate',
        'reports','program_recommendations','queryNumberEnrolee', 'program_program_plans', 
        'report_status', 'num_student_inc_grade','adviser_info','num_student_withdraw'));
                
        
        $pdfFile=  $pdf->output();
        
        $path = Storage::put('report_pdfs', $pdfFile);

        $report_pdf = new ReportPdfs;
        $report_pdf->report_id = $id; // foreign key value
        $report_pdf->pdf_path = $path;
        $report_pdf->pdf_file = $pdfFile;
        $report_pdf->save();
       
        return $pdf->download('ousform.pdf');
    }

    public function get_pdf_copy($id){

        $report_status = Reports::where('id', $id)->first();
        $userId = auth()->user()->id;
       

        $adviser_info = DB::table('advisers')
        ->join('users', 'advisers.user_id', '=', 'users.id')
        ->join('departments', 'advisers.department_id', '=', 'departments.id')
        ->join('programs', 'programs.department_id', '=', 'departments.id')
        ->where('advisers.user_id', '=', auth()->user()->id)
        ->select('users.name as name', 'programs.program_name as prog','departments.department_name as dept')->first();
        


        $program_activities = ProgramEngagementActivities::where("report_id", $id)->get();
        $program_outputs_deliverables = ProgramOutputsDeliverables::where("report_id", $id)->get();
        $program_consultation_advising = ConsultationAdvising::where("report_id", $id)->get();
        $program_risk_challenges = RiskChallenges::where("report_id", $id)->get();
        $program_collaboration_linkages= CollaborationsLinkages::where("report_id", $id)->get();
        $program_problems_encountered = ProblemsEncountered::where("report_id", $id)->get();
        $program_recommendations = Recommendations::where("report_id", $id)->get();
        $program_program_plans = ProgramPlans::where("report_id", $id)->get();
       
        $reports = DB::select("SELECT * from reports r 
                                inner join advisees a on a.id  = r.advisee_id 
                                inner join acad_terms at2 on at2.id = a.term_id 
                                inner join acad_years ay on ay.id = at2.acadyear_id 
                                where r.id = '$id'"
                            );
        $dropout_rate = $this->get_drop_rate($reports[0]->acadyear_id, $userId);
        $survival_rate = $this->get_survival_rate($reports[0]->acadyear_id, $userId);
        $promotion_rate = $this->get_promotion_rate($reports[0]->acadyear_id, $userId);
        $failure_rate = $this->get_failure_rate($reports[0]->acadyear_id, $userId);
        $average_students_gpa = $this->get_gpa_student($reports[0]->acadyear_id, $userId);
        $average_students_cgpa = $this->get_average_cgpa($reports[0]->acadyear_id, $userId);
        $student_reports = $this->get_student_records($reports[0]->acadyear_id, $userId);
        $num_student_fail_grade = $this->get_student_fail_grade($reports[0]->acadyear_id, $userId);
        $num_student_inc_grade = $this->get_student_inc_grade($reports[0]->acadyear_id, $userId);
        $num_student_withdraw = $this->get_withdraw_student($reports[0]->acadyear_id, $userId);
  
        $num_student_cgpa_below_2_5 = $this->get_cgpa_below_2_5($reports[0]->acadyear_id, $userId);

        $termId = $reports[0]->term_id;
        $queryNumberEnrolee = DB::select("SELECT COUNT(*) as numberOfEnrollee FROM advisees  where term_id= '$termId'
                                && user_id = '$userId'");
       
        
        $report_id = $id;
        // return view('ous.details', compact('program_activities', 'report_id', 'program_outputs_deliverables', 
        //             'program_consultation_advising', 'program_risk_challenges','program_collaboration_linkages', 
        //             'program_problems_encountered','survival_rate','num_student_cgpa_below_2_5','average_students_cgpa', 'num_student_fail_grade','student_reports','dropout_rate','average_students_gpa', 'failure_rate','promotion_rate',
        //             'reports','program_recommendations','queryNumberEnrolee', 'program_program_plans', 
        //             'report_status', 'num_student_inc_grade','adviser_info'));

        

        

        $pdf = PDF::loadView('ous.pdf', compact('program_activities', 'report_id', 'program_outputs_deliverables', 
        'program_consultation_advising', 'program_risk_challenges','program_collaboration_linkages', 
        'program_problems_encountered','survival_rate','num_student_cgpa_below_2_5','average_students_cgpa', 'num_student_fail_grade','student_reports','dropout_rate','average_students_gpa', 'failure_rate','promotion_rate',
        'reports','program_recommendations','queryNumberEnrolee', 'program_program_plans', 
        'report_status', 'num_student_inc_grade','adviser_info','num_student_withdraw'));
                
        // $path = Storage::put('report_pdfs', $pdf->output());

        // $report_pdf = new ReportPdfs;
        // $report_pdf->report_id = $id; // foreign key value
        // $report_pdf->pdf_path = $path;
        // $report_pdf->save();
       
        return $pdf->stream('ousform.pdf');
    }


    public function admin_view_report($id) {
       
            $pdf = DB::table('report_pdfs')->where('report_id', $id)->first();

            
            $headers = [
                'Content-Type' => 'application/pdf',
            ];
            
            return Response::make($pdf->pdf_file, 200, $headers);
                }

    //UPDATE 
    public function update_program_consultation_advising(Request $request){

        $field_name = $request->fieldname;
        
        $prog_activities = ConsultationAdvising::where('id', $request->id)->first();
        $prog_activities->$field_name = $request->value;
        $prog_activities->save();

    }

    public function update_program_risk_challenges(Request $request){

        $field_name = $request->fieldname;
        
        $prog_activities = RiskChallenges::where('id', $request->id)->first();
        $prog_activities->$field_name = $request->value;
        $prog_activities->save();

    }

    public function update_program_collaboration_linkages(Request $request){

        $field_name = $request->fieldname;
        
        $prog_activities =CollaborationsLinkages::where('id', $request->id)->first();
        $prog_activities->$field_name = $request->value;
        $prog_activities->save();

    }

    public function update_program_problems_ecountered(Request $request){

        $field_name = $request->fieldname;
        
        $prog_activities =ProblemsEncountered::where('id', $request->id)->first();
        $prog_activities->$field_name = $request->value;
        $prog_activities->save();

    }

    public function update_program_recommendations(Request $request){

        $field_name = $request->fieldname;
        
        $prog_activities =Recommendations::where('id', $request->id)->first();
        $prog_activities->$field_name = $request->value;
        $prog_activities->save();

    }

    public function update_program_plans(Request $request){

        $field_name = $request->fieldname;
        
        $prog_activities =ProgramPlans::where('id', $request->id)->first();
        $prog_activities->$field_name = $request->value;
        $prog_activities->save();

    }


    public function update_program_activities(Request $request){

        $field_name = $request->fieldname;
        
        $prog_activities = ProgramEngagementActivities::where('id', $request->id)->first();
        $prog_activities->$field_name = $request->value;
        $prog_activities->save();

    }

    public function update_program_output_deliverables(Request $request){
        $field_name = $request->fieldname;

        $prog_activities = ProgramOutputsDeliverables::where('id', $request->id)->first();
        $prog_activities->$field_name = $request->value;
        $prog_activities->save();
    }

    //ADD
    
    public function add_program_output_deliverables(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){
            $output_deliverables = new ProgramOutputsDeliverables;
            $output_deliverables->report_id = $data['report_id'];
            $output_deliverables->save();
            $insertedid = $output_deliverables->id;

            return response()->json(array('insertedid' => $insertedid), 200);
        }
    }

    public function add_program_activities(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){
            $engagementProgramm = new ProgramEngagementActivities;
            $engagementProgramm->report_id = $data['report_id'];
            $engagementProgramm->save();
            $insertedid = $engagementProgramm->id;

            return response()->json(array('insertedid' => $insertedid), 200);
        }
    }


    public function add_program_consultation_advising(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){
            $program_consultation = new ConsultationAdvising;
            $program_consultation->report_id = $data['report_id'];
            $program_consultation->save();
            $insertedid = $program_consultation->id;

            return response()->json(array('insertedid' => $insertedid), 200);
        }
    }

    public function add_program_risk_challenges(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){
            $program_risk= new RiskChallenges;
            $program_risk->report_id = $data['report_id'];
            $program_risk->save();
            $insertedid =  $program_risk->id;

            return response()->json(array('insertedid' => $insertedid), 200);
        }
    }

    public function add_pogram_collaborations_linkages(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){
            $program_collaborations = new CollaborationsLinkages;
            $program_collaborations ->report_id = $data['report_id'];
            $program_collaborations ->save();
            $insertedid =$program_collaborations ->id;

            return response()->json(array('insertedid' => $insertedid), 200);
        }
    }

    public function add_program_problems(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){
            $program_problems = new ProblemsEncountered;
            $program_problems ->report_id = $data['report_id'];
            $program_problems ->save();
            $insertedid = $program_problems ->id;

            return response()->json(array('insertedid' => $insertedid), 200);
        }
    }

    public function add_program_recommendations(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){
            $program_recommend = new Recommendations;
            $program_recommend ->report_id = $data['report_id'];
            $program_recommend ->save();
            $insertedid = $program_recommend ->id;

            return response()->json(array('insertedid' => $insertedid), 200);
        }
    }

    public function add_program_plans(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){
            $program_plans = new ProgramPlans;
            $program_plans ->report_id = $data['report_id'];
            $program_plans ->save();
            $insertedid =  $program_plans ->id;

            return response()->json(array('insertedid' => $insertedid), 200);
        }
    }

    //Remove

    public function  remove_program_output_deliverables(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){

            $engagementProgramm=ProgramOutputsDeliverables::where('id',$data['report_id'])->delete();

            return response()->json(array('succcess' => true), 200);
        }
    }
    public function remove_program_activities(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){

            $engagementProgramm=ProgramEngagementActivities::where('id',$data['report_id'])->delete();

            return response()->json(array('succcess' => true), 200);
        }
    }

    public function remove_program_consultation(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){

            $program_consultation=ConsultationAdvising::where('id',$data['report_id'])->delete();

            return response()->json(array('succcess' => true), 200);
        }
    }

    public function remove_program_risk(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){

            $program_risk=RiskChallenges::where('id',$data['report_id'])->delete();

            return response()->json(array('succcess' => true), 200);
        }
    }

    public function remove_program_collaborations(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){

            $program_collaboration=CollaborationsLinkages::where('id',$data['report_id'])->delete();

            return response()->json(array('succcess' => true), 200);
        }
    }

    public function remove_program_problems(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){

            $program_problems=ProblemsEncountered::where('id',$data['report_id'])->delete();

            return response()->json(array('succcess' => true), 200);
        }
    }

    public function remove_program_recommendations(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){

            $program_recommendations=Recommendations::where('id',$data['report_id'])->delete();

            return response()->json(array('succcess' => true), 200);
        }
    }

    public function remove_program_plans(Request $request){
        $data = $request->all();
        if(isset($data['report_id'])){

            $program_plans=ProgramPlans::where('id',$data['report_id'])->delete();

            return response()->json(array('succcess' => true), 200);
        }
    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('ous.add');

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
    public function show()
    {
        //
        return view('ous.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        return view('ous.edit');
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

    public function load_modal_report(){

        $data = DB::table('acad_years')
        ->whereNotIn('acad_years.id', DB::table('acad_years')
        ->join('acad_terms', 'acad_terms.acadyear_id', '=', 'acad_years.id')
        ->join('advisees', 'advisees.term_id', '=', 'acad_terms.id')
        ->join('reports', 'reports.advisee_id', '=', 'advisees.id')
        ->where('advisees.user_id', '=', auth()->user()->id)
        ->pluck('acad_years.id'))
        ->select('acad_years.id', 'acad_years.acad_yr')
        ->get();

        return view('modal.gen_report_content', compact('data'));
    }



    public function gen_report(Request $request){
        
        if($request->academic_year == ""){
            return response()->json(array('success' => false), 400);
        }
        $todayDate = Carbon::now()->format('Y-m-d');


        $advisee_id = DB::table('acad_terms')
        ->join('acad_years', 'acad_terms.acadyear_id', '=', 'acad_years.id')
        ->join('advisees', 'advisees.term_id', '=', 'acad_terms.id')
        ->where('acad_terms.acadyear_id', $request->academic_year)
        ->where('advisees.user_id', auth()->user()->id)
        ->select('advisees.id')
        ->first();



        // $advisee_id = Advisee::where('user_id', auth()->user()->id)->first()->id;


        $Reports = new Reports;
        $Reports->advisee_id = $advisee_id->id;
        $Reports->save();

        $insertedid = $Reports->id;

       
        $this->generate_program_engagement($insertedid);
        $this->generate_program_output($insertedid);
        $this->generate_program_consultation($insertedid);
        $this->generate_program_risk($insertedid);
        $this->generate_program_collaboration($insertedid);
        $this->generate_program_problem($insertedid);
        $this->generate_program_recommendations($insertedid);
        $this->generate_program_plans($insertedid);

        return $insertedid;
        
    }

    private function get_program_engagement_list(){
        $report_id = Report::where('report_id', $report_id);
        $advisee_id =Advisee::where('advisee_id', auth()->user()->id)->first()->id;

        // $advisee_id = Advisee::where('advisee_id', auth()->user()->id)->first()->id;
        // // $activeYear = AcadYear::where('status', 1)->first()->id;
        $data = ProgramEngagementActivities::where('advisee_id', $advisee_id)->first();
        // ->where('acadyr_id', $activeYear)->get();
        return $data;
    }

    private function generate_program_engagement($insertedid)
    {

        $count_check = ProgramEngagementActivities::where('report_id', $insertedid)->count();
        $current_date_time = Carbon::now()->toDateTimeString();
        if($count_check <= 0){
            $data = [
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time]
            ];
    
            ProgramEngagementActivities::insert($data);
        }

    }
    private function generate_program_output($insertedid) 
    {
        $count_check = ProgramOutputsDeliverables::where('report_id', $insertedid)->count();
        $current_date_time = Carbon::now()->toDateTimeString();

        if($count_check <= 0){
            $data = [
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time]
            ];
    
            ProgramOutputsDeliverables::insert($data);
        }

    }
    private function generate_program_consultation($insertedid) 
    {
        $count_check = ConsultationAdvising::where('report_id', $insertedid)->count();
        $current_date_time = Carbon::now()->toDateTimeString();

        if($count_check <= 0){
            $data = [
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time]
            ];
    
            ConsultationAdvising::insert($data);
        }
    }

    private function generate_program_risk($insertedid) {
        $count_check = RiskChallenges::where('report_id', $insertedid)->count();
        $current_date_time = Carbon::now()->toDateTimeString();

        if($count_check <= 0){
            $data = [
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time]
            ];
    
            RiskChallenges::insert($data);
        }
    }

    private function generate_program_collaboration($insertedid) 
    {
        $count_check = CollaborationsLinkages::where('report_id', $insertedid)->count();
        $current_date_time = Carbon::now()->toDateTimeString();

        if($count_check <= 0){
            $data = [
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time]
            ];
    
            CollaborationsLinkages::insert($data);
        }
    }
    private function generate_program_problem($insertedid) 
    {
        $count_check = ProblemsEncountered::where('report_id', $insertedid)->count();
        $current_date_time = Carbon::now()->toDateTimeString();
        
        if($count_check <= 0){
            $data = [
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time]
            ];
    
            ProblemsEncountered::insert($data);
        }
    }
    private function generate_program_recommendations($insertedid) 
    {
        $count_check = Recommendations::where('report_id', $insertedid)->count();
        $current_date_time = Carbon::now()->toDateTimeString();

        if($count_check <= 0){
            $data = [
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time]
            ];
    
            Recommendations::insert($data);
        }
    }
    private function generate_program_plans($insertedid) {
        $count_check = ProgramPlans::where('report_id', $insertedid)->count();
        $current_date_time = Carbon::now()->toDateTimeString();
        
        if($count_check <= 0){
            $data = [
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time],
                ['report_id' => $insertedid, 'created_at' => $current_date_time, 'updated_at' => $current_date_time]
            ];
    
            ProgramPlans::insert($data);
            
        }
    }
}
