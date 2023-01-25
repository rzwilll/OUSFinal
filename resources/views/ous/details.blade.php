@extends('layouts.sidebar')

@section('section')
<h3>Academic Program Advising Report</h3>
@endsection

@section('content')
    <link href="{{ asset('/css/ous_view.css') }}" rel="stylesheet">
<div class="report-content">
                    <table>
                        <tr>
                            <td><b>Program Title:</b></td>
                            <td> {{$adviser_info->prog}}</td>
                        </tr>
                        <tr>
                            <td><b>Department:</b></td>
                            <td>{{$adviser_info->dept}}</td>
                        </tr>
                        <tr>
                            <td><b>Academic Year:</b></td>
                            <td>{{$reports[0]->acad_yr}}</td>
                        </tr>
                        <!-- <tr>
                            <td><b>Reporting Period:</b></td>
                            <td>Second Semester of A.Y. 2021-2022</td>
                        </tr> -->
                        <tr>
                            <td><b>Report Submission Date:</b></td>
                            <td>{{  date('M d, Y', strtotime($reports[0]->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td><b>Program Adviser:</b></td>
                            <td>{{$adviser_info->name}}</td>
                        </tr>
                    
                    </table>
                    <br>
                    <form action="">
                        <table>
                            <tr>
                                <td colspan="4" class="report-section"><b>I. Program Academic Performance Profile</b></td>
                            </tr>
                            <tr>
                                <td><b>Total Program Enrolee:</b></td>
                                <td>{{$queryNumberEnrolee[0]->numberOfEnrollee}}</td>
                                <td><b>Number of Students with INC:</b></td>
                                <td>{{$num_student_inc_grade}}</td>
                            </tr>
                            <tr>
                                <td><b>Survival Rate:</b></td>
                                <td>{{$survival_rate}}%</td>
                                <td><b>Number of Students withdraw from the program:</b></td>
                                <td>{{$num_student_withdraw}}</td>
                            </tr>
                            <tr>
                                <td><b>Completion Rate:</b></td>
                                <td>{{$survival_rate}}%</td>
                                <td><b>Number of Students with failing grades:</b></td>
                                <td>{{$num_student_fail_grade}}</td>
                            </tr>

                            <tr>
                                <td><b>Promotion Rate:</b></td>
                                <td>{{$promotion_rate}}%</td>
                                <td><b>Number of Rizal's Excellence Awardees:</b></td>
                                <td>{{$student_reports[1]}}</td>
                            </tr>

                            <tr>
                                <td><b>Failure Rate:</b></td>
                                <td>{{$failure_rate}}%</td>
                                <td><b>Number of Chancellor's Excellence Awardees:</b></td>
                                <td>{{$student_reports[2]}}</td>
                            </tr>
                            <tr>
                                <td><b>Dropout Rate:</b></td>
                                <td>{{$dropout_rate}}%</td>
                                <td><b>Number of Dean's Excellence Awardees:</b></td>
                                <td>{{$student_reports[3]}}</td>
                            </tr>
                            <tr>
                                <td><b>Average GPA of Students:</b></td>
                                <td>{{$average_students_gpa}}</td>
                                <td><b>Number of Students with GPA below 2.50:</b></td>
                                <td>{{$student_reports[0]}}</td>
                            </tr>
                            <tr>
                                <td><b>Average CGPA of Students:</b></td>
                                <td>{{$average_students_cgpa}}</td>
                                <td><b>Number of Students with CGPA below 2.50:</b></td>
                                <td>{{$num_student_cgpa_below_2_5}}</td>
                            </tr>
                        </table>
                         <br>
                        <table id="tbl_engagement_activities">
                            <thead>
                                <tr>
                                    <td colspan="3"class="report-section"><b>II. Program Engagement & Activities</b> </th>
                                    <?php
                                        if($report_status->status ==0 || $report_status->status ==2 ){?>
                                            <td class="col-1 report-section add-btn"> 
                                                <button type="button" class="btn  btn-info add-button" onclick="add_program_engagement_activities({{$report_id}});" > <i class='bx bx-plus'></i>Add</button>
                                            </td>   
                                        <?php }
                                    ?>

                                    
                            
                                    <!-- <td class="col-1 report-section add-btn"> 
                                        <form class="form-horizontal" id="add_program_engagement_form" method="POST">
                                            <button type="button" class="btn  btn-info add-button" onclick="add_program_engagement_activities({{$report_id}});"><i class='bx bx-plus'>Add</i></button>
                                        </form>
                                    </td> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Objectives</b></td>
                                    <td><b>Curricular & Co-curricular Activities</b></td>
                                    <td><b> Accomplishment</b></td>
                                    
                                    <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                 <td></td>

                                            <?php }
                                    ?>
                                </tr>
                                @foreach($program_activities as $index => $val_progAc)
                                <tr id="tbl_tr_progAc_{{$val_progAc->id}}">

                                    <td>
                                        <?php

                                                if($report_status->status == 1 || $report_status->status ==3){?>
                                                    <p>{{$val_progAc->objective_desc}}</p>
                                                <?php } else { ?>
                                                    <input type="text " name="" id="objective" class="form-control" value="{{$val_progAc->objective_desc}}" onfocusout="update_program_engagement_activities({{$val_progAc->id}}, 'objective_desc', this)" placeholder=".....">
                                                <?php }

                                        ?>

                                    </td>
                                            
                                    <td>
                                        <?php

                                            if($report_status->status == 1 || $report_status->status ==3){?>
                                                <p>{{$val_progAc->activities_desc}}</p>
                                            <?php } else { ?>
                                                <input type="text " name="" id="activities" class="form-control" value="{{$val_progAc->activities_desc}}" onfocusout="update_program_engagement_activities({{$val_progAc->id}}, 'activities_desc', this)" placeholder=".....">
                                            <?php }

                                        ?>

                                    </td>

                                    <td>
                                        <?php

                                        if($report_status->status == 1 || $report_status->status ==3){?>
                                            <p>{{$val_progAc->accomplishment_desc}}</p>
                                        <?php } else { ?>
                                            <input type="text " name="" id="accomplishment" class="form-control" value="{{$val_progAc->accomplishment_desc}}" onfocusout="update_program_engagement_activities({{$val_progAc->id}}, 'accomplishment_desc', this)" placeholder=".....">
                                        <?php }

                                        ?>

                                    </td>
                                    <!-- <td><input type="text " name="" id="objective" class="form-control" value="{{$val_progAc->objective_desc}}" onfocusout="update_program_engagement_activities({{$val_progAc->id}}, 'objective_desc', this)" placeholder="....."></td>
                                    <td><input type="text " name="" id="activities" class="form-control" value="{{$val_progAc->activities_desc}}" onfocusout="update_program_engagement_activities({{$val_progAc->id}}, 'activities_desc', this)" placeholder="....."></td> -->
                                    <!-- <td><input type="text " name="" id="accomplishment" class="form-control" value="{{$val_progAc->accomplishment_desc}}" onfocusout="update_program_engagement_activities({{$val_progAc->id}}, 'accomplishment_desc', this)" placeholder="....."></td> -->
                                    
                                    <?php
                                            if($report_status->status ==0|| $report_status->status ==2){?>
                                                <td class= "remove-td">
                                                    <?php
                                                        if($index > 4){?>
                                                            <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_engagement_activities({{$val_progAc->id}})"></i></button>
                                                        <?php }
                                                    ?>
                                                </td> 

                                            <?php }
                                    ?>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <table id="tbl_output_deliverables">
                            <thead>
                                <tr>
                                    <td colspan="2" class="report-section"><b>III. Program Outputs and Deliverables</b></td>
                                    <?php
                                        if($report_status->status == 0 || $report_status->status ==2){?>
                                            <td class="col-1 report-section add-btn"> 
                                                <button type="button" class="btn  btn-info add-button" onclick="add_program_output_deliverables({{$report_id}});" > <i class='bx bx-plus'></i>Add</button>
                                            </td>   
                                        <?php }
                                    ?>
                            <!-- <td class="col-1 report-section add-btn">
                                        <button type="button" class="btn  btn-info add-button" onclick="add_program_output_deliverables({{$report_id}});"><i class='bx bx-plus'>Add</i></button>
                                    </td> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Program Outputs</b></td>
                                    <td><b>Deliverables</b></td>
                                    <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                 <td></td>

                                            <?php }
                                    ?>
                                </tr>
                                @foreach($program_outputs_deliverables as $index => $val_progDeli)
                                    <tr id="tbl_tr_progdeli_{{$val_progDeli->id}}">

                                    <td>
                                        <?php

                                                if($report_status->status == 1 || $report_status->status ==3){?>
                                                    <p>{{$val_progDeli->outputs_desc}}</p>
                                                <?php } else { ?>
                                                    <input type="text " name="" id="prog_output" value="{{$val_progDeli->outputs_desc}}" onfocusout="update_program_output_deliverables({{$val_progDeli->id}}, 'outputs_desc', this)" class="form-control"placeholder="...">
                                                <?php }

                                        ?>

                                    </td>

                                    <td>
                                        <?php

                                                if($report_status->status == 1 || $report_status->status ==3){?>
                                                    <p>{{$val_progDeli->deliverables_desc}}</p>
                                                <?php } else { ?>
                                                    <input type="text " name="" id="deliverables" value="{{$val_progDeli->deliverables_desc}}" onfocusout="update_program_output_deliverables({{$val_progDeli->id}}, 'deliverables_desc', this)" class="form-control"placeholder="...">
                                                <?php }

                                        ?>

                                    </td>
                                        

                                        <!-- <td><input type="text " name="" id="prog_output" value="{{$val_progDeli->outputs_desc}}" onfocusout="update_program_output_deliverables({{$val_progDeli->id}}, 'outputs_desc', this)" class="form-control"placeholder="..."></td>
                                        <td><input type="text " name="" id="deliverables" value="{{$val_progDeli->deliverables_desc}}" onfocusout="update_program_output_deliverables({{$val_progDeli->id}}, 'deliverables_desc', this)" class="form-control"placeholder="..."></td> -->
                                         

                                        <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                <td class= "remove-td">
                                                    <?php
                                                        if($index > 3){?>
                                                            <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_output_deliverables({{$val_progDeli->id}})"></i></button>
                                                        <?php }
                                                    ?>
                                                </td> 

                                            <?php }
                                        ?> 

                                    </tr>
                                @endforeach
                            </tbody>
                           
                        </table>
                        <br>
                        <table id ="tbl_consultation_advising">
                            <thead>
                                <tr>
                                    <td colspan="3" class="report-section"><b>IV. Consultation and Advising</b></td>
                                    <?php
                                        if($report_status->status ==0 || $report_status->status ==2){?>
                                            <td class="col-1 report-section add-btn"> 
                                                <button type="button" class="btn  btn-info add-button" onclick="add_program_consultation_advising({{$report_id}});" > <i class='bx bx-plus'></i>Add</button>
                                            </td>   
                                        <?php }
                                    ?>
                            
                                    <!-- <td class="col-1 report-section add-btn"> 
                                        <button type="button" class="btn  btn-info add-button" onclick="add_program_consultation_advising({{$report_id}});"><i class='bx bx-plus'></i>Add</button>
                                    </td> -->
                                </tr>
                            </thead>
                            <tbody>
                            <tr >
                                <td>Date of Consultation</td>
                                <td>Nature of Advising</td>
                                <td>Action Taken</td>
                                <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                <td></td>

                                            <?php }
                                ?>
                                
                            </tr>
                                @foreach($program_consultation_advising as $index => $val_consultation_advising)
                            <tr id = "tbl_tr_progconsult_{{$val_consultation_advising->id}}">

                                    <td>
                                        <?php

                                                if($report_status->status == 1 || $report_status->status ==3){?>
                                                    <p>{{$val_consultation_advising->date_desc}}</p>
                                                <?php } else { ?>
                                                    <input type="text " name="" id="date"  value="{{$val_consultation_advising->date_desc}}" onfocusout="update_program_consultation_advising({{$val_consultation_advising->id}}, 'date_desc', this)" class="form-control"placeholder="...">
                                                <?php }

                                        ?>

                                    </td>

                                    <td>
                                        <?php

                                                if($report_status->status == 1 || $report_status->status ==3){?>
                                                    <p>{{$val_consultation_advising->advising_nature_desc}}</p>
                                                <?php } else { ?>
                                                    <input type="text " name="" id="nature"  value="{{$val_consultation_advising->advising_nature_desc}}" onfocusout="update_program_consultation_advising({{$val_consultation_advising->id}}, 'advising_nature_desc', this)"class="form-control"placeholder="...">
                                                <?php }

                                        ?>

                                    </td>

                                    
                                    <td>
                                        <?php

                                                if($report_status->status == 1 || $report_status->status ==3){?>
                                                    <p>{{$val_consultation_advising->action_desc}}</p>
                                                <?php } else { ?>
                                                    <input type="text " name="" id="action" value="{{$val_consultation_advising->action_desc}}" onfocusout="update_program_consultation_advising({{$val_consultation_advising->id}}, 'action_desc', this)"class="form-control"placeholder="...">
                                                <?php }

                                        ?>

                                    </td>

                                    
                                <!-- <td><input type="text " name="" id="date"  value="{{$val_consultation_advising->date_desc}}" onfocusout="update_program_consultation_advising({{$val_consultation_advising->id}}, 'date_desc', this)" class="form-control"placeholder="..."></td>
                                <td><input type="text " name="" id="nature"  value="{{$val_consultation_advising->advising_nature_desc}}" onfocusout="update_program_consultation_advising({{$val_consultation_advising->id}}, 'advising_nature_desc', this)"class="form-control"placeholder="..."></td>
                                <td><input type="text " name="" id="action" value="{{$val_consultation_advising->action_desc}}" onfocusout="update_program_consultation_advising({{$val_consultation_advising->id}}, 'action_desc', this)"class="form-control"placeholder="..."></td> -->
                                

                                
                                <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                <td class= "remove-td">
                                                    <?php
                                                        if($index > 3){?>
                                                            <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_consultation({{$val_consultation_advising->id}})"></i></button>
                                                        <?php }
                                                    ?>
                                                </td> 
                                

                                            <?php }
                                ?> 
                                
                            </tr>
                            @endforeach
                            </tbody>
                           
                        </table>
                        <br>
                        <table id = "tbl_risk_challenges">  
                            <thead>
                                <tr>
                                    <td colspan="1" class="report-section"><b>V.Risk and Challenges</b></td>
                                    <?php
                                        if($report_status->status ==0 || $report_status->status ==2){?>
                                            <td class="col-1 report-section add-btn"> 
                                                <button type="button" class="btn  btn-info add-button" onclick="add_program_risk_challenges({{$report_id}});" > <i class='bx bx-plus'></i>Add</button>
                                            </td>   
                                        <?php }
                                    ?>
                        
                                    <!-- <td class="col-1 report-section add-btn"> 
                                        <button type="button" class="btn  btn-info add-button"onclick="add_program_risk_challenges({{$report_id}});"> <i class='bx bx-plus'></i>Add
                                    </button>
                                     </td> -->
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($program_risk_challenges as $index => $val_program_risk_challenges)
                                <tr id = "tbl_tr_progrisk_{{$val_program_risk_challenges->id}}">

                                <td>
                                        <?php

                                                if($report_status->status == 1 || $report_status->status ==3){?>
                                                    <p>{{$val_program_risk_challenges->risk_desc}}</p>
                                                <?php } else { ?>
                                                    <input type="text " name="" id="risk" value="{{$val_program_risk_challenges->risk_desc}}" onfocusout="update_program_risk_challenges({{$val_program_risk_challenges->id}}, 'risk_desc', this)"class="form-control"placeholder="...">
                                                <?php }

                                        ?>

                                    </td>
                                    <!-- <td><input type="text " name="" id="risk" value="{{$val_program_risk_challenges->risk_desc}}" onfocusout="update_program_risk_challenges({{$val_program_risk_challenges->id}}, 'risk_desc', this)"class="form-control"placeholder="..."></td> -->
                                     

                                    <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                
                                                <td class= "remove-td">
                                                    <?php
                                                        if($index > 3){?>
                                                            <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_risk({{$val_program_risk_challenges->id}})"></i></button>
                                                        <?php }
                                                    ?>
                                                </td>

                                            <?php }
                                    ?> 

                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <table id= "tbl_collaboration_linkages">
                            <thead>
                                <tr>
                                    <td colspan ="1"class="report-section"><b>VI.Collaborations and Linkage</b></td>
                                    <?php
                                        if($report_status->status ==0 || $report_status->status ==2){?>
                                            <td class="col-1 report-section add-btn"> 
                                                <button type="button" class="btn  btn-info add-button" onclick="add_pogram_collaborations_linkages({{$report_id}});" > <i class='bx bx-plus'></i>Add</button>
                                            </td>   
                                        <?php }
                                    ?>
                            
                                </tr>
                            </thead>
                           <tbody>
                                @foreach($program_collaboration_linkages as $index => $val_program_collab)
                                <tr id = "tbl_tr_progcollab_{{$val_program_collab->id}}">
                                        <td>
                                            <?php
                                                if($report_status->status == 1 || $report_status->status ==3){?>
                                                    <p>{{$val_program_collab->collaboration_desc}}</p>
                                                <?php } else { ?>
                                                    <input type="text " name="" id="collaboration" value="{{$val_program_collab->collaboration_desc}}" onfocusout="update_program_collaboration_linkages({{$val_program_collab->id}}, 'collaboration_desc', this)"class="form-control"placeholder="...">
                                                <?php }
                                            ?>
                                            
                                        </td>   
                                        <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                <td class= "remove-td">
                                                    <?php
                                                        if($index > 4){?>
                                                            <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick=" confirm_remove_program_collaborations({{$val_program_collab->id}})"></i></button>
                                                        <?php }
                                                    ?>
                                                </td>
                                            <?php }
                                        ?> 
                                </tr>
                                @endforeach
                           </tbody>
                           
                        </table>
                        <br>
                        <table id = "tbl_problems_ecountered">
                           <thead>
                                <tr>
                                    <td  colspan= "1"class="report-section"><b>VII. Problems Encountered</b></td>
                                    <?php
                                        if($report_status->status ==0 || $report_status->status ==2){?>
                                            <td class="col-1 report-section add-btn"> 
                                                <button type="button" class="btn  btn-info add-button" onclick="add_program_problems({{$report_id}});" > <i class='bx bx-plus'></i>Add</button>
                                            </td>   
                                        <?php }
                                    ?>
                            
                                    
                                    
                                    <!-- <td class="col-1 report-section add-btn">
                                         <button type="button" class="btn  btn-info add-button" onclick="add_program_problems({{$report_id}});" > <i class='bx bx-plus'></i>Add
                                        </button>
                                    </td> -->
                                </tr>
                           </thead>
                           <tbody>
                           @foreach($program_problems_encountered as $index => $val_program_problem_encountered)
                            <tr id = "tbl_tr_progproblem_{{$val_program_problem_encountered->id}}">
                                    <!-- <td><input type="text " name="" id="problems" value="{{$val_program_problem_encountered->problem_desc}}" onfocusout="update_program_problems_ecountered({{$val_program_problem_encountered->id}}, 'problem_desc', this)" class="form-control"placeholder="..."></td>    -->

                                    <td>
                                        <?php

                                        if($report_status->status == 1 || $report_status->status ==3){?>
                                            <p>{{$val_program_problem_encountered->problem_desc}}</p>
                                        <?php } else { ?>
                                            <input type="text " name="" id="problems" value="{{$val_program_problem_encountered->problem_desc}}" onfocusout="update_program_problems_ecountered({{$val_program_problem_encountered->id}}, 'problem_desc', this)" class="form-control"placeholder="...">
                                        <?php }

                                        ?>

                                    </td>
                                    

                                    <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                <td class= "remove-td">
                                                    <?php
                                                        if($index > 4){?>
                                                        <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_problems({{$val_program_problem_encountered->id}})"></i></button>
                                                    <?php }
                                                        ?>
                                                </td> 
                                            <?php }
                                    ?> 
                            
                            </tr>
                            @endforeach
                           </tbody>
                            
                        </table>
                        <br>
                        <table id = "tbl_recommendations">
                            <thead>
                                <tr>
                                    <td  colspan="1" class="report-section"><b>VIII. Recommendations</b></td>
                                    <?php
                                        if($report_status->status ==0 || $report_status->status ==2){?>
                                            <td class="col-1 report-section add-btn"> 
                                                <button type="button" class="btn  btn-info add-button" onclick="add_program_recommendations({{$report_id}});" > <i class='bx bx-plus'></i>Add</button>
                                            </td>   
                                        <?php }
                                    ?>
                            
                                    <!-- <td class="col-1 report-section add-btn"> 
                                        <button type="button" class="btn  btn-info add-button" onclick="add_program_recommendations({{$report_id}});"> <i class='bx bx-plus'></i>Add
                                        </button>
                                    </td> -->
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($program_recommendations as $index => $val_program_recommendation)
                                <tr id = "tbl_tr_progreco_{{$val_program_recommendation->id}}">
                                    <!-- <td><input type="text " name="" id="recommendations" value="{{$val_program_recommendation->recommendation_desc}}"  onfocusout="update_program_recommendations({{$val_program_recommendation->id}}, 'recommendation_desc', this)" class="form-control"placeholder="..."></td>    -->
                                    
                                    <td>
                                        <?php

                                        if($report_status->status == 1 || $report_status->status ==3){?>
                                            <p>{{$val_program_recommendation->recommendation_desc}}</p>
                                        <?php } else { ?>
                                            <input type="text " name="" id="recommendations" value="{{$val_program_recommendation->recommendation_desc}}"  onfocusout="update_program_recommendations({{$val_program_recommendation->id}}, 'recommendation_desc', this)" class="form-control"placeholder="...">
                                        <?php }

                                        ?>

                                    </td>
                                  

                                    <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                 <td class= "remove-td">
                                                        <?php
                                                            if($index > 4){?>
                                                            <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_recommendations({{$val_program_recommendation->id}})"></i></button>
                                                        <?php }
                                                        ?>
                                                    </td>  
                                            <?php }
                                    ?> 
        
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        <br>

                        
                        <table id = "tbl_program_plans">
                           <thead>
                                <tr>
                                    <td colspan="1" class="report-section"><b>IX.Program Plans</b></td>
                                    <?php
                                        if($report_status->status ==0 || $report_status->status ==2){?>
                                            <td class="col-1 report-section add-btn"> 
                                                <button type="button" class="btn  btn-info add-button" onclick="add_program_plans({{$report_id}});" > <i class='bx bx-plus'></i>Add</button>
                                            </td>   
                                        <?php }
                                    ?>
                            
                                    <!-- <td class="col-1 report-section add-btn">
                                         <button type="button" class="btn  btn-info add-button"  onclick="add_program_plans({{$report_id}});"><i class='bx bx-plus'></i>Add
                                        </button>
                                    </td> -->
                                </tr>
                           </thead>
                           <tbody>
                                @foreach($program_program_plans as $index => $val_program_plans)
                                <tr id = "tbl_tr_progplan_{{$val_program_plans->id}}">
                                    <!-- <td><input type="text " name="" id="plans" value="{{$val_program_plans->plan_desc}}" onfocusout="update_program_plans({{$val_program_plans->id}}, 'plan_desc', this)" class="form-control"placeholder="..."></td>    -->

                                    
                                    <td>
                                        <?php

                                        if($report_status->status == 1 || $report_status->status ==3){?>
                                            <p>{{$val_program_plans->plan_desc}}</p>
                                        <?php } else { ?>
                                            <input type="text " name="" id="plans" value="{{$val_program_plans->plan_desc}}" onfocusout="update_program_plans({{$val_program_plans->id}}, 'plan_desc', this)" class="form-control"placeholder="...">
                                        <?php }

                                        ?>

                                    </td>
                                    

                                    <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                <td class= "remove-td">
                                                    <?php
                                                        if($index > 2){?>
                                                        <button type="button" class = "remove-btn" onclick="confirm_remove_program_plans({{$val_program_plans->id}})"><i class='bx bxs-trash-alt'></i></button>
                                                    <?php }

                                                    ?>
                                                </td>   
                                            <?php }
                                    ?> 
                                </tr>
                                @endforeach
    
                                
                           </tbody>
                        </table>

                        <!-- <button class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24;"><b style=" color:white; padding:1em;">Submit Report</b></button>
                        <button class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24;"><b style=" color:white; padding:1em;">Save Changes</b></button>
                        <button class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24;"><b style=" color:white; padding:1em;">Cancel</b></button> -->

                        <?php
                                            if($report_status->status ==0 || $report_status->status ==2){?>
                                                <!-- <button type =button class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24;" onclick="conferm_submit({{$report_id}});"><b style=" color:white; padding:1em;"> Add Report</b></button> -->
                                                <button type =button class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24;" onclick="conferm_submit({{$report_id}})"><b style=" color:white; padding:1em;">Add Report</b></button>
                                                <a href="{{route('ous.index')}}" class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24;"><b style=" color:white; padding:1em;">Save as draft</b></a>
                                                <!-- <button class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24; color:white;">Save as draft </button> -->
                                                <!-- <button class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24;"><b style=" color:white; padding:1em;">Cancel</b></button> -->

                                    
                                            <?php } else { ?>
                                            <!-- <button class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24;"><b style=" color:white; padding:1em;">Back</b></button> -->
                                            <a href="{{route('ous.index')}}" class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24;"><b style=" color:white; padding:1em;">Back</b></a>
                                            <!-- <a href="{{ url('ous/copy/'.$report_id) }}" class="mt-2  text-center btn btn-primary" style=" border: none; background: #a41d24;"><b style=" color:white; padding:.25em;"><i class='bx bxs-download'></i>PDF</b></a> -->
                                            <?php
                                            }
                                ?>
                    </form>




                </div>

@endsection
<script>

function conferm_submit(e){
    swal({
        text: 'Are you sure you want to submit this report? Once submitted you can no longer change its content',
        showCancelButton: false,
        icon: "warning",
        buttons: true,
        closeModal: false,
    }).then(result => {
        if (result == true){
            $(".btn").attr("disabled", true);
            $.ajax({
                method: 'GET',
                url: '/ous/submit_ous_report/?report_id='+e,
                success    :'success',
                contentType: false,
                processData: false,
                success: (response) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(result => {
                        $.ajax({
                            method: 'GET',
                            url: '/ous/pdf/'+e,
                            success: (response) => {
                                location.reload();
                            }
                        });
                    });
                }
            });
        }
    });
}

    //remove

    function confirm_remove_program_output_deliverables(e){
        swal({
            text: 'Are you sure you want to remove this?',
            showCancelButton: false,
            icon: "warning",
            buttons: true,
            closeModal: false,
        }).then(result => {
            
            if (result == true){
                $(".btn").attr("disabled", true);
                $.ajax({
                    method: 'GET',
                    url: '/ous/remove_program_output_deliverables/?report_id='+e,
                    success    :'success',
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(result => {
                            $(".btn").attr("disabled", false);
                            $('#tbl_tr_progdeli_'+e).remove(); 
                        });
                    }
                });
            }

        });
    }

    function confirm_remove_program_engagement_activities(e){
        swal({
            text: 'Are you sure you want to remove this?',
            showCancelButton: false,
            icon: "warning",
            buttons: true,
            closeModal: false,
        }).then(result => {
            
            if (result == true){
                $(".btn").attr("disabled", true);
                $.ajax({
                    method: 'GET',
                    url: '/ous/remove_program_engagement_activities/?report_id='+e,
                    success    :'success',
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(result => {
                            $(".btn").attr("disabled", false);
                            $('#tbl_tr_progAc_'+e).remove(); 
                        });
                    }
                });
            }

        });
    }

    function confirm_remove_program_consultation(e){
        swal({
            text: 'Are you sure you want to remove this?',
            showCancelButton: false,
            icon: "warning",
            buttons: true,
            closeModal: false,
        }).then(result => {
            
            if (result == true){
                $(".btn").attr("disabled", true);
                $.ajax({
                    method: 'GET',
                    url: '/ous/remove_program_consultation/?report_id='+e,
                    success    :'success',
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(result => {
                            $(".btn").attr("disabled", false);
                            $('#tbl_tr_progconsult_'+e).remove(); 
                        });
                    }
                });
            }

        });
    }

    function confirm_remove_program_risk(e){
        swal({
            text: 'Are you sure you want to remove this?',
            showCancelButton: false,
            icon: "warning",
            buttons: true,
            closeModal: false,
        }).then(result => {
            
            if (result == true){
                $(".btn").attr("disabled", true);
                $.ajax({
                    method: 'GET',
                    url: '/ous/remove_program_risk/?report_id='+e,
                    success    :'success',
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(result => {
                            $(".btn").attr("disabled", false);
                            $('#tbl_tr_progrisk_'+e).remove(); 
                        });
                    }
                });
            }

        });
    }

    function confirm_remove_program_collaborations(e){
        swal({
            text: 'Are you sure you want to remove this?',
            showCancelButton: false,
            icon: "warning",
            buttons: true,
            closeModal: false,
        }).then(result => {
            
            if (result == true){
                $(".btn").attr("disabled", true);
                $.ajax({
                    method: 'GET',
                    url: '/ous/remove_program_collaborations/?report_id='+e,
                    success    :'success',
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(result => {
                            $(".btn").attr("disabled", false);
                            $('#tbl_tr_progcollab_'+e).remove(); 
                        });
                    }
                });
            }

        });
    }

    function confirm_remove_program_problems(e){
        swal({
            text: 'Are you sure you want to remove this?',
            showCancelButton: false,
            icon: "warning",
            buttons: true,
            closeModal: false,
        }).then(result => {
            
            if (result == true){
                $(".btn").attr("disabled", true);
                $.ajax({
                    method: 'GET',
                    url: '/ous/remove_program_problems/?report_id='+e,
                    success    :'success',
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(result => {
                            $(".btn").attr("disabled", false);
                            $('#tbl_tr_progproblem_'+e).remove(); 
                        });
                    }
                });
            }

        });
    }
    function confirm_remove_program_recommendations(e){
        swal({
            text: 'Are you sure you want to remove this?',
            showCancelButton: false,
            icon: "warning",
            buttons: true,
            closeModal: false,
        }).then(result => {
            
            if (result == true){
                $(".btn").attr("disabled", true);
                $.ajax({
                    method: 'GET',
                    url: '/ous/remove_program_recommendations/?report_id='+e,
                    success    :'success',
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(result => {
                            $(".btn").attr("disabled", false);
                            $('#tbl_tr_progreco_'+e).remove(); 
                        });
                    }
                });
            }

        });
    }
    
    function confirm_remove_program_plans(e){
        swal({
            text: 'Are you sure you want to remove this?',
            showCancelButton: false,
            icon: "warning",
            buttons: true,
            closeModal: false,
        }).then(result => {
            
            if (result == true){
                $(".btn").attr("disabled", true);
                $.ajax({
                    method: 'GET',
                    url: '/ous/remove_program_plans/?report_id='+e,
                    success    :'success',
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(result => {
                            $(".btn").attr("disabled", false);
                            $('#tbl_tr_progplan_'+e).remove(); 
                        });
                    }
                });
            }

        });
    }




    //ADD

    function add_program_output_deliverables(e){
        $.ajax({
            method: 'GET',
            url: '/ous/add_program_output_deliverables/?report_id='+e,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {

                var newRowContent = ` 
                    <tr id="tbl_tr_progdeli_${response.insertedid}">
                        <td><input type="text " name="" id="prog_output" onfocusout="update_program_output_deliverables(${response.insertedid}, 'outputs_desc', this)" class="form-control"placeholder="..."></td>
                        <td><input type="text " name="" id="deliverables" onfocusout="update_program_output_deliverables(${response.insertedid}, 'deliverables_desc', this)" class="form-control"placeholder="..."></td>
                        <td class= "remove-td">
                            <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_output_deliverables(${response.insertedid})"></i></button>
                        </td> 
                    </tr>
                `;
                jQuery("#tbl_output_deliverables tbody").append(newRowContent);
                
            }
        });
    }

    function add_program_engagement_activities(e){
        $.ajax({
            method: 'GET',
            url: '/ous/add_program_engagement_activities/?report_id='+e,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                var newRowContent = `
                    <tr id="tbl_tr_progAc_${response.insertedid}">
                        <td><input type="text " name="" id="objective" class="form-control"  onfocusout="update_program_engagement_activities(${response.insertedid}, 'objective_desc', this)" placeholder="....."></td>
                        <td><input type="text " name="" id="activities" class="form-control"  onfocusout="update_program_engagement_activities(${response.insertedid}, 'activities_desc', this)" placeholder="....."></td>
                        <td><input type="text " name="" id="accomplishment" class="form-control" onfocusout="update_program_engagement_activities(${response.insertedid}, 'accomplishment_desc', this)" placeholder="....."></td>
                        <td class= "remove-td">
                        <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_engagement_activities(${response.insertedid})"></i></button>
                        </td> 
                    </tr>
                `;
                jQuery("#tbl_engagement_activities tbody").append(newRowContent);
                
            }
        });
    }

    function add_program_consultation_advising(e){
        $.ajax({
            method: 'GET',
            url: '/ous/add_program_consultation_advising/?report_id='+e,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                var newRowContent = `
                    <tr id="tbl_tr_progconsult_${response.insertedid}">
                        <td><input type="text " name="" id="date" class="form-control"  onfocusout="update_program_consultation_advising(${response.insertedid}, 'date_desc', this)" placeholder="....."></td>
                        <td><input type="text " name="" id="nature" class="form-control"  onfocusout="update_program_consultation_advising(${response.insertedid}, 'advising_nature_desc', this)" placeholder="....."></td>
                        <td><input type="text " name="" id="action" class="form-control" onfocusout="update_program_consultation_advising(${response.insertedid}, 'action_desc', this)" placeholder="....."></td>
                        <td class= "remove-td">
                        <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_consultation(${response.insertedid})"></i></button>
                        </td> 
                    </tr>
                `;
                jQuery("#tbl_consultation_advising tbody").append(newRowContent);
                
            }
        });
    }

    function add_program_risk_challenges(e){
        $.ajax({
            method: 'GET',
            url: '/ous/add_program_risk_challenges/?report_id='+e,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                var newRowContent = `
                    <tr id="tbl_tr_progrisk_${response.insertedid}">
                        <td><input type="text " name="" id="risk" class="form-control"  onfocusout="update_program_risk_challenges(${response.insertedid}, 'risk_desc', this)" placeholder="....."></td>
                        <td class= "remove-td">
                        <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_risk(${response.insertedid})"></i></button>
                        </td> 
                    </tr>
                `;
                jQuery("#tbl_risk_challenges tbody").append(newRowContent);
                
            }
        });
    }

    function add_pogram_collaborations_linkages(e){
        $.ajax({
            method: 'GET',
            url: '/ous/add_pogram_collaborations_linkages/?report_id='+e,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                var newRowContent = `
                    <tr id="tbl_tr_progcollab_${response.insertedid}">
                        <td><input type="text " name="" id="collaboration" class="form-control"  onfocusout=" update_program_collaboration_linkages(${response.insertedid}, 'collaboration_desc, this)" placeholder="....."></td>
                        <td class= "remove-td">
                        <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_collaborations(${response.insertedid})"></i></button>
                        </td> 
                    </tr>
                `;
                jQuery("#tbl_collaboration_linkages tbody").append(newRowContent);
                
            }
        });
    }

    function add_program_problems(e){
        
        $.ajax({
            method: 'GET',
            url: '/ous/add_program_problem/?report_id='+e,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                var newRowContent = `
                    <tr id="tbl_tr_progproblem_${response.insertedid}">
                        <td><input type="text " name="" id="problems" class="form-control"  onfocusout="update_program_problems_ecountered(${response.insertedid}, 'problem_desc', this)" placeholder="....."></td>
                        <td class= "remove-td">
                        <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_problems(${response.insertedid})"></i></button>
                        </td> 
                    </tr>
                `;
                jQuery("#tbl_problems_ecountered tbody").append(newRowContent);
                
            }
        });
    }

    function add_program_recommendations(e){
        $.ajax({
            method: 'GET',
            url: '/ous/add_program_recommendations/?report_id='+e,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                var newRowContent = `
                    <tr id="tbl_tr_progreco_${response.insertedid}">
                        <td><input type="text " name="" id="recommendations" class="form-control"  onfocusout="update_program_recommendations(${response.insertedid}, 'recommendation_desc', this)" placeholder="....."></td>
                        <td class= "remove-td">
                        <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_recommendations(${response.insertedid})"></i></button>
                        </td> 
                    </tr>
                `;
                jQuery("#tbl_recommendations tbody").append(newRowContent);
                
            }
        });
    }

    function add_program_plans(e){
        $.ajax({
            method: 'GET',
            url: '/ous/add_program_plans/?report_id='+e,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                var newRowContent = `
                    <tr id="tbl_tr_progplan_${response.insertedid}">
                        <td><input type="text " name="" id="plans" class="form-control"  onfocusout="update_program_plans(${response.insertedid}, 'plan_desc', this)" placeholder="....."></td>
                        
                        <td class= "remove-td">
                        <button type="button" class = "remove-btn"><i class='bx bxs-trash-alt' onclick="confirm_remove_program_plans(${response.insertedid})"></i></button>
                        </td> 
                    </tr>
                `;
                jQuery("#tbl_program_plans tbody").append(newRowContent);
                
            }
        });
    }

    //UPDATE 
    function update_program_output_deliverables(id, fieldname, value){
        var in_value = $(value).val();
        $.ajax({
            method: 'GET',
            url: '/ous/update_program_output_deliverables/?id='+id+'&fieldname='+fieldname+'&value='+in_value,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                
            }
        });
    }

    function update_program_engagement_activities(id, fieldname, value){
        var in_value = $(value).val();
        $.ajax({
            method: 'GET',
            url: '/ous/update_program_engagement_activities/?id='+id+'&fieldname='+fieldname+'&value='+in_value,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                
            }
        });
    }

    function update_program_consultation_advising (id, fieldname, value) {
        var in_value = $(value).val();
        $.ajax({
            method: 'GET',
            url: '/ous/update_program_consultation_advising/?id='+id+'&fieldname='+fieldname+'&value='+in_value,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                
            }
        });

    }

    function update_program_collaboration_linkages (id, fieldname, value) {
     
        var in_value = $(value).val();
        $.ajax({
            method: 'GET',
            url: '/ous/update_program_collaboration_linkages/?id='+id+'&fieldname='+fieldname+'&value='+in_value,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
                
            }
        });
    }

    function update_program_problems_ecountered (id, fieldname, value) {
     
     var in_value = $(value).val();
     $.ajax({
         method: 'GET',
         url: '/ous/update_program_problems_ecountered/?id='+id+'&fieldname='+fieldname+'&value='+in_value,
         success    :'success',
         contentType: false,
         processData: false,
         success: (response) => {
             
         }
     });
    }

    function update_program_recommendations (id, fieldname, value) {
     
     var in_value = $(value).val();
     $.ajax({
         method: 'GET',
         url: '/ous/update_program_recommendations/?id='+id+'&fieldname='+fieldname+'&value='+in_value,
         success    :'success',
         contentType: false,
         processData: false,
         success: (response) => {
                
         }
     });
    }

    function update_program_plans (id, fieldname, value) {
     
     var in_value = $(value).val();
     $.ajax({
         method: 'GET',
         url: '/ous/update_program_plans/?id='+id+'&fieldname='+fieldname+'&value='+in_value,
         success    :'success',
         contentType: false,
         processData: false,
         success: (response) => {
             
         }
     });
    }

    function update_program_risk_challenges (id, fieldname, value) {
     
     var in_value = $(value).val();
     $.ajax({
         method: 'GET',
         url: '/ous/update_program_risk_challenges/?id='+id+'&fieldname='+fieldname+'&value='+in_value,
         success    :'success',
         contentType: false,
         processData: false,
         success: (response) => {
             
         }
     });
    }



    

</script>