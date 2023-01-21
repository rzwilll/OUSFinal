@extends('layouts.sidebaradmin')

@section('section')
<h3>Academic Program Advising Report</h3>
@endsection
@section('content')
<link href="{{ asset('/css/ous_index.css') }}" rel="stylesheet">




      <div class="report-container">
          <div class="report-table">
                <table>
                  <tr>
                    <th>REPORT:</th>
                    <th>DATE:</th>
                    <th>ADVISER:</th>
                    <th></th>
                    <th><small></small></th>
                  </tr>
                  @foreach($reports->sortByDesc('created_at') as $val)
                    @if($val-> status==1)
                    <tr>
                      <td>{{$val->program}} (A.Y: {{$val->school_year}})</td>
                        <td>{{  date('M d, Y', strtotime($val->created_at)) }}</td>
                        <td>{{$val->name}}</td>
                        <td>
                          
          
                          <a href="{{ url('admin/report/'.$val->re_id) }}" type="button">
                            
                            <div class="btn btn-info">
                              <i class='bx bx-show'></i>View
                            </div>
                            <!-- <div class="btn btn-info" style= "margin-left:.5em;">
                              <a href="{{ url('ous/pdf/'.$val->re_id) }}" type=button> <i class='bx bxs-download'></i> PDF</a>
                            </div> -->
                           
                          </a>

                          

                          
                          <!-- <button class="edit-button"> <a href="{{ route('ous.edit')}}"><i class='bx bxs-edit' ></i>Edit</a></button> -->
                          
                      </td>
                      <td  class ="edit-report">
                        <button type =button class="edit" style ="border:none; color:#a41d21; "id = "edit_submission" onclick="confirm_resubmission({{$val->re_id}})" title = "Request for resubmission of report">
                            
                           
                        <i class='bx bx-message-square-x'></i>
                            
                            <!-- <div class="btn btn-info" style= "margin-left:.5em;">
                              <a href="{{ url('ous/pdf/'.$val->re_id) }}" type=button> <i class='bx bxs-download'></i> PDF</a>
                            </div> -->
                           
                        </button>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                </table>
          </div>
      </div>


@endsection
<script>
function confirm_resubmission(id){
        swal({
            text: 'Confirm request for resubmission',
            icon: "warning",
            buttons: true,
            closeModal: false,
            showCancelButton: true,
        }).then(result => {
            if (result == true){
                $.ajax({
                    type: "GET",
                    url: '/admin/resubmit/' + id,
                    success: (response) => {
                        swal({
                            icon: 'success',
                            title: 'Requested Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(result => {
                            location.reload();
                        });
                    }
                });
            }
        });
    }



</script>

                                        

                                        