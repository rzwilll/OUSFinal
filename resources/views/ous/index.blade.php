@extends('layouts.sidebar')

@section('section')
<h3>Academic Program Advising Report</h3>
@endsection
@section('content')
<link href="{{ asset('/css/ous_index.css') }}" rel="stylesheet">


<div class="add-report">
        <button class="create-report p-2" id="create-report"> <i class='bx bx-plus'></i>Generate report</i></button>
        <!-- <a href="{{ route('ous.gen_report')}}"></a> -->
</div>

      <div class="report-container">
          <div class="report-table">
                <table>
                  <tr>
                    <th>REPORT:</th>
                    <th>DATE:</th>
                    <th></th>
                  </tr>
                  @foreach($reports as $val)
                    <tr>
                      <td>Report (A.Y: {{$val->school_year}})</td>
                        <td>{{  date('M d, Y', strtotime($val->created_at)) }}</td>
                        <td>
                          
          
                          <a href="{{ url('ous/details/'.$val->re_id) }}" type="button">
                            @if($val->status == 1)
                            <div class="btn btn-info">
                              <i class='bx bx-show'></i>View
                            </div>
                            <div class="btn btn-info" style= "margin-left:.5em;">
                              <a href="{{ url('ous/copy/'.$val->re_id) }}" type=button> <i class='bx bxs-download'></i> PDF</a>
                            </div>
                           
                            @elseif($val->status!=1)
                            <div class="btn btn-info">
                              <i class='bx bxs-edit'></i>Edit
                            </div>
                            @endif
                          </a>

                          

                          
                          <!-- <button class="edit-button"> <a href="{{ route('ous.edit')}}"><i class='bx bxs-edit' ></i>Edit</a></button> -->
                          
                      </td>
                    </tr>
                  @endforeach
                </table>
          </div>
      </div>


@endsection


                                        