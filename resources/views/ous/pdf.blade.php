<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pdf</title>

    <style>

    *{
        font-family:"Calibri, sans-serif";
        font-size: 12px;
    }
    .form-name{
        padding: 1em;
        text-align: center;
        font-size: .9em;
       font-family: Arial, Helvetica, sans-serif;
        
    }
    .container{
      width: 100%;
      
      
    }
    .header{
        text-align:center;
      
        

    }
    .header-text{
        padding: 0;
        font-size: 1em;
        margin-left: 1em;
        
    }
    .text{
        width: 100%;
    }
    

    table, th, td {
    border: .2px solid #060c0c;
    border-collapse: collapse;
    padding: .5em;
    height: 1em;
    text-align: left;
    
   
    }
    table {
        width: 100%;
    }
    th{
        background-color: #deeaf6;
    }
    td.info{
        height: 4em;
    }

    </style>

</head>


<body>

    <div class="container">
        <div class="header">
                <div class="iit-logo">
                    <img src="" alt ="" class="logo" width = 80px;>
                </div>

                <div class="header-text">
                    <div class="text lineOne">
                        <div class="schoolname"><b> MSU - Iligan Institute of Technology</b></div>
                      
                    </div>
                    <div class="text"><b>OFFICE OF THE VICE CHANCELLOR FOR ACADEMIC AFFAIRS</b></div>
                    <div class="text"><b>OFFICE OF THE UNDERGRADUATE STUDIES</b></div>
                    <div class="text">Iligan City, Philippines</div>
                </div>
            </div>
            <hr style="border: .5px solid; background: #060c0c;">
            <div class="form-name"><b>ACADEMIC PROGRAM ADVISING PROGRESS REPORT</b></div>

            <div class="form-content">
                <table class="adviseeinfo">
                    <tr>
                        <td>Program Title:</td>
                        <td>{{$adviser_info->prog}}</td>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td>{{$adviser_info->dept}}</td>
                    </tr>
                    <tr>
                        <td>College</td>
                        <td>College of Computer Studies</td>
                    </tr>
                    <tr>
                        <td>Academic Year</td>
                        <td>{{$reports[0]->acad_yr}}</td>
                    </tr>
                    <tr>
                        <td>Report Submission Date</td>
                        <td>{{  date('M d, Y', strtotime($reports[0]->created_at)) }}</td>
                    </tr>
                    <tr>
                            <td>Program Adviser:</td>
                            <td>{{$adviser_info->name}}</td>
                    </tr>
                </table>
               
                <table class="statRate">
                    
                        <th colspan="4">I. Program Academic Performance Profile</th>

                    
                    
                    <tr>
                        <td>Total Program Enrolees</td>
                        <td colspan="1">{{$queryNumberEnrolee[0]->numberOfEnrollee}}</td>
                        <td>Number of Students with INC</td>
                        <td colspan=" 1">{{$num_student_inc_grade}}</td>
                    </tr>
                    <tr>
                        <td>Survival Rate</td>
                        <td colspan="1">{{$survival_rate}}%</td>
                        <td>Number of Students withdraw from the program</td>
                        <td colspan=" 1">0</td>
                    </tr>
                    <tr>
                        <td>Completion Rate</td>
                        <td colspan="1">{{$survival_rate}}%</td>
                        <td>Number of Students with failing grades</td>
                        <td colspan=" 1">{{$num_student_fail_grade}}</td>
                    </tr>
                    <tr>
                        <td>Promotion Rate</td>
                        <td colspan="1">{{$promotion_rate}}%</td>
                        <td>Number of Rizal Excellence Awardees (1.0 – 1.20)</td>
                        <td colspan=" 1">{{$student_reports[1]}}</td>
                    </tr>
                    <tr>
                        <td>Failure Rate</td>
                        <td colspan="1">{{$failure_rate}}%</td>
                        <td>Number of Chancellor’s Excellence Awardees (1.21 – 1.45)</td>
                        <td colspan=" 1">{{$student_reports[2]}}</td>
                    </tr>
                    <tr>
                        <td>Dropout Rate</td>
                        <td colspan="1">{{$dropout_rate}}%</td>
                        <td>Number of Dean’s Excellence Awardees (1.46 – 1.75)</td>
                        <td colspan=" 1">{{$student_reports[3]}}</td>
                    </tr>
                     <tr>
                        <td>Average GPA of Students</td>
                        <td colspan="1">{{$average_students_gpa}}</td>
                        <td>Number of Students with GPA below 2.50</td>
                        <td colspan=" 1">{{$student_reports[0]}}</td>
                    </tr>
                     <tr>
                        <td>Average CGPA of Students</td>
                        <td colspan="1">{{$average_students_cgpa}}</td>
                        <td>Number of Students with CGPA below 2.50</td>
                        <td colspan=" 1">{{$num_student_cgpa_below_2_5}}</td>
                    </tr>

                </table>
                
                <table class="program-engagement">
                    <th colspan="3">II: Program Engagement & Activities</th>

                    <tr>
                        <td><b>Objectives</b></td>
                        <td><b>Curricular & Co-Curricular Activities</b></td>
                        <td><b>Accomplishments</b></td>
                    </tr>
                    @foreach($program_activities as $val_progAc)
                    <tr>
                        <td>{{$val_progAc->objective_desc}}</td>
                        <td>{{$val_progAc->activities_desc}}</td>
                        <td>{{$val_progAc->accomplishment_desc}}</td>
                    </tr>
                    @endforeach
                </table>
                
                <table class="program outputs"> 
                    <th  colspan=" 2">III: Program Outputs and Deliverables</th>

                    <tr>
                        <td ><b>Program Outputs</b></td>
                        <td><b>Program Deliverables</b></td>
                    </tr>
                    @foreach($program_outputs_deliverables as $val_progDeli)
                    <tr>
                        <td>{{$val_progDeli->outputs_desc}}</td>
                        <td>{{$val_progDeli->deliverables_desc}}</td>
                    </tr>
                    @endforeach
                </table>
           
                <table class="consult">
                    <th colspan="3">IV: Consultation & Advising</th>

                    <tr>
                        <td><b>Date of Consultation</b></td>
                        <td><b>Nature of Advising</b></td>
                        <td><b>Action Taken</b></td>
                    </tr>
                    @foreach($program_consultation_advising as  $val_consultation_advising)
                    <tr>
                        <td>{{$val_consultation_advising->date_desc}}</td>
                        <td>{{$val_consultation_advising->advising_nature_desc}}</td>
                        <td>{{$val_consultation_advising->action_desc}}</td>
                    </tr>
                   @endforeach
                </table>
               
                <table class="risk">
                    <th colspan="1">V: Risks & Challenges</th>

                    @foreach($program_risk_challenges as $val_program_risk_challenges)
                    <tr>
                        <td>{{$val_program_risk_challenges->risk_desc}}</td>
                    </tr>
                   @endforeach
                </table>

                <table class="collab">
                    <th>VI: Collaboration & Linkages</th>
                    @foreach($program_collaboration_linkages as  $val_program_collab)
                    <tr>
                        <td>{{$val_program_collab->collaboration_desc}}</td>
                    </tr>
                    @endforeach
                </table>
                <table class="prob">
                    <th colspan="1">VII: Problems Encountered</th>

                    @foreach($program_problems_encountered as $val_program_problem_encountered)
                    <tr>
                        <td>{{$val_program_problem_encountered->problem_desc}}</td>
                    </tr>
                   @endforeach
                </table>
                <table class="recommendations">
                    <th>VIII: Recommendations</th>
                    @foreach($program_recommendations as $val_program_recommendation)
                    <tr>
                        <td>{{$val_program_recommendation->recommendation_desc}}</td>
                    </tr>
                    @endforeach
                </table>
                <table class="plans">
                    <th>IX: Program Plans</th>
                    @foreach($program_program_plans as $index => $val_program_plans)
                    <tr>
                        <td>{{$val_program_plans->plan_desc}}</td>
                    </tr>
                   @endforeach
                </table>
                <!-- <table>
                    <tr>
                        <td class="info"><b>Name of Program Adviser:</b><br>
                        <p style = "text-transform:uppercase;">{{$adviser_info->name}}</p>

                        </td>
                        <td class="info"><b> Date and Signature: </b><br>
                         <p>{{  date('M d, Y', strtotime($reports[0]->created_at)) }} <br>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="info"><b>Department Chairperson:</b><br>
                        <p></p>
                            
                        </td>
                        <td class="info"><b> Date and Signature:  </b><br>
                        <p></p>
                            
                        </td>
                    </tr>
                </table> -->

                <br>
                <br>
                <br>
            </div>
    </div>
    
</body>
</html>
