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
                    </tr>
                    @endif
                  @endforeach
                </table>
          </div>
      </div>


@endsection


                                        