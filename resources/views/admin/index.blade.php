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
                    <th>VIEW DETAILS:</th>
                    <th>REMARKS:</th>
                    <th><small>ACTION:</small> </th>
                    
                  </tr>
                  @foreach($reports as $val)
                    @if($val-> status==1)
                    <tr>
                      <td>{{$val->course}} (A.Y: {{$val->school_year}})</td>
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
                      <!-- changes -->
                      <td>
                      <input type="text " name="remarks" id="date"  value="" onfocusout="" class="form-control"placeholder="leave remarks..">
                      </td>

                      <td>
                        <div class="button-container" style = "display:flex;">
                        <small>
                          <button class="icon-btn" id = "edit_submission"onclick="approve_report({{$val->re_id}})" title = "Approve report">
                            <i class='bx bxs-check-square'></i>                        
                            <span>Approve</span>
                          </button>
                        </small>
                        
                        <small>
                          <button class="icon-btn" id = "edit_submission"onclick="confirm_resubmission({{$val->re_id}}, document.getElementById('date').value)" title = "Request for revision of report">
                            <i class='bx bxs-edit-alt'></i> 
                            <span>Revise</span>
                          </button>
                        </small>

                        

                        </div>


                      </td>
                    </tr>
                    @elseif ($val->status==3)
                    <tr>
                      <td>{{$val->course}}(A.Y: {{$val->school_year}})</td>
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

                          

                      </td>
                      <!-- changes -->

                      <td>
                        <small style = "font-style:italic;">Report has been approved</small>
                      </td>
                      <td>
                          <small class ="approve">Approved</small>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                </table>
          </div>
      </div>


@endsection
<script>
// function confirm_resubmission(id){
//         swal({
//             text: 'Confirm request for resubmission',
//             icon: "warning",
//             buttons: true,
//             closeModal: false,
//             showCancelButton: true,
//         }).then(result => {
//             if (result == true){
//                 $.ajax({
//                     type: "GET",
//                     url: '/admin/resubmit/' + id,
//                     success: (response) => {
//                         swal({
//                             icon: 'success',
//                             title: 'Requested Successfully',
//                             showConfirmButton: false,
//                             timer: 1500
//                         }).then(result => {
//                             location.reload();
//                         });
//                     }
//                 });
//             }
//         });
//     }


function confirm_resubmission(id){
    let remarks = document.getElementById('date').value;
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
                data: {remarks:remarks},
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

      function approve_report(id) {
      $.ajax({
          type: "GET",
          url: '/admin/approvalstatus/' + id,
          success: (response) => {
              swal({
                  icon: 'success',
                  title: 'Report Approved Successfully',
                  showConfirmButton: false,
                  timer: 1000
              }).then(result => {
                  location.reload();
              });
          }
      });
  }






</script>


                                        