@extends('layouts.sidebar')
@section('section')
<h3>Advisee</h3>
@endsection
@section('content')

<link href="{{ asset('/css/advisee.css') }}" rel="stylesheet">


        <div class="top-area">
                    <div class="left-top">
                        <div class="top-left">
                            <!-- <form action="/action_page.php">
                                <label for="cars">School Year:</label>
                                <select id="aac_yr" name="acad_year">
                                  <option value="volvo">2021-2022</option>
                                  <option value="saab">2020-2021</option>
                                </select>
                             </form> -->

                             
                            <label for="yr_filter"> School Year: </label>
                            <select name="acad_year" id="acad_year" onchange="get_advisee_list()">
                            @foreach ($academic_school_year as $acadyear)
                            <option value="{{$acadyear->id}}" <?php if($acadyear->status == 1){?> selected <?php }?>> {{$acadyear->acad_yr}}</option>
                            @endforeach   
                            </select>
                           
                        </div>

                        <div class="top-left">
                           
                            <label for="cars">Semester:</label>
                            <select id="semester" name="semester" onchange="get_advisee_list()">
                                <option value="1">First Semester</option>
                                <option value="2">Second Semester</option>
                            </select>
                          
                        </div>
                    </div>

                    <div class="right-top">
                        <p class="mt-2" id="total-count">Records Found: {{count($adviseelist)}}</p>
                    </div>
                
        </div>
                <!-- <div class="pagination-container">
                    <div class="pagination">
                        <a href="#">A</a>
                        <a class="active" href="#">B</a>
                        <a href="#">C</a>
                        <a href="#">D</a>
                        <a href="#">E</a>
                        <a href="#">F</a>
                        <a href="#">G</a>
                        <a href="#">H</a>
                        <a href="#">I</a>
                        <a href="#">J</a>
                        <a href="#">K</a>
                        <a href="#">L</a>
                        <a href="#">N</a>
                        <a href="#">O</a>
                        <a href="#">P</a>
                        <a href="#">Q</a>
                        <a href="#">R</a>
                        <a href="#">S</a>
                        <a href="#">T</a>
                        <a href="#">U</a>
                        <a href="#">W</a>
                        <a href="#">X</a>
                        <a href="#">Y</a>
                        <a href="#">Z</a>
                    </div>
                </div> -->

               
                <div class="table-body">

                    <table id="tbl_advisees">
                        <tr>
                          <th>Student ID No.</th>
                          <th>Full Name</th>
                          <th>Year Level</th>
                          <th>GPA</th>
                          <th></th>
                        </tr>
                        <tbody id="tbl-tbody-advisees">
                            @foreach($adviseelist as $student )
                            <tr>
                                <td>{{$student['stud_idnum']}}</td>
                                <td>{{$student['stud_first']}} {{$student['stud_mi']}} {{$student['stud_last']}} </td>
                                <td>{{$student['year_level']}}</td>
                                <td>{{number_format($student['student_gpa'], 3, '.', '')}}</td>
                                
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" style= "background:#931d23; border:none;" onclick="grade_details({{$student['id']}}, {{$student['year_id']}}, {{$student['sem_id']}}, {{$student['year_level']}})" > <i class='bx bx-show' style = "font-size:1.2em; margin-right:2px; padding:0;"></i> View</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                      </table>

                      
                </div>

@endsection

<script>
    function get_advisee_list(){
        var acad_year = $("#acad_year").val();
        var acad_semester = $("#semester").val();
        jQuery("#tbl-tbody-advisees").html('');
        $.ajax({
            method: 'GET',
            url: '/advisee/get_advisee_list/?year_id='+acad_year+'&sem_id='+acad_semester,
            success    :'success',
            contentType: false,
            processData: false,
            success: (response) => {
          
                $("p#total-count").html(`Records Found: ${response.length}`);
                var tr_body;
                for (let i = 0; i < response.length; i++) {
                    
                    var link = `<a href="{{ url('advisee/view/'.$student['id']. '/'.$student['year_id'].'/'.$student['sem_id'].'/'.$student['year_level']) }}">View</a>`;
                    tr_body = `
                        <tr id="tr-${response[i].id}">
                            <td>${response[i].stud_idnum}</td>
                            <td>${response[i].stud_first} ${response[i].stud_mi} ${response[i].stud_last} </td>
                            <td>${response[i].year_level}</td>
                            <td>${response[i].student_gpa}</td>
                        
                            <td>
                                <button type="button" class="btn btn-success btn-sm" style= "background:#931d23; border:none;" onclick="grade_details(${response[i].id}, ${acad_year}, ${acad_semester}, ${response[i].year_level})" > <i class='bx bx-show' style = "font-size:1.2em; margin-right:2px; padding:0;"></i> View</button>
                            </td>
                        </tr>
                    `;
                 
                    jQuery("#tbl-tbody-advisees").append(tr_body);
                }
                
            }
        });
    }



    function grade_details(std_id, acad_year, acad_semester, year_level){

        var ids = std_id+" "+acad_year+" "+acad_semester+" "+year_level;

        var url = "{{ route('advisee.show', ':ids') }}";
        url = url.replace(':ids', ids);
        location.href = url;

    }
</script>