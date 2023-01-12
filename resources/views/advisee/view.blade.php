@extends('layouts.sidebar')

@section('content')

<link href="{{ asset('/css/studenteval.css') }}" rel="stylesheet">


<div class="student-info">
    <p><b>NAME: </b>{{$student_info->stud_first}} {{$student_info->stud_mi}} {{$student_info->stud_last}}</p>
    <p><b>YEAR LEVEL: </b>{{$year_level}}</p>
    <!-- <p><b>CGPA: </b>1.85</p> -->
    <p><b>GPA: </b>{{$gpa}}</p>

</div>

<div class="table-body">
    <table>
        <tr>
            <th>Subject Code</th>
            <th>Description</th>
            <!-- <th>Unit</th> -->
            <th>Grade</th>
        </tr>
        <tr>
            <td colspan ="3"class="sem-info"><p><b> SY: </b> <b> {{$acad_year->acad_yr}}</b> <b>SEM: </b> <b>{{$sem_id}}</b> <small>({{$student_info->program_name}})</small></p>
            </td>
        </tr>
        
        @foreach($student_grade as $student )
        <tr>
            <td class = "eval_info">{{$student->subject_code}}</td>
            <td class = "eval_info">{{$student->subject_name}}</td>
            <!-- <td>{{$student->subject_unit}}</th> -->
            <td class = "eval_info">{{$student->grade}}</td>
        </tr>
        @endforeach
        
        <tr class="gpa-data">
            <td colspan="2" class=" gpa"><b>GPA:</b></td>
            <td class="">{{$gpa}}</td>
        </tr>


</div>

@endsection