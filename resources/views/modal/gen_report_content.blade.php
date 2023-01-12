<form class="form-horizontal" id="generate_form" method="POST">
    <select class="form-select" name="academic_year" id="academic_year" aria-label="Default select example" onchange="verified(this)">
        <option value="">Choose Academic Year..</option>
        @foreach($data as $val)
        <option value="{{$val->id}}">{{$val->acad_yr}}</option>
        @endforeach
    </select>
<br>

<?php if(count($data) > 0){?>
    <button type="submit" class="btn btn-primary">Generate Report</button>
<?php }
else { ?>
    <p><small style = "color:red"> You already submitted required reports</small></p>

<?php }?>

<button type="button" class="btn btn-secondary" onclick="modal_closed();">Close</button>
</form>
<script>
    $('#generate_form').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('_token', `{{ csrf_token() }}`);
        if($("#academic_year").val() == ""){
            $("#academic_year").attr('style', 'border: 1px solid #ffc107;');
            return;
        }
        $.ajax({
            method: 'post',
            url: '/ous/generate_report',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                
                $("#modal_report").modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                }).then(result => {
                    var id = response;
                    var url = "{{ route('ous.get_ous_details', ':id') }}";
                    url = url.replace(':id', id);
                    location.href = url;
                });
                
            },
            error: function(reject){
                
                $("#academic_year").attr('style', 'border: 1px solid #ffc107;');
            
            }
            
        });
    });
    function verified(e){
        var val = $(e).val();
        if(val != ""){
            $("#academic_year").attr('style', 'border: unset;');
        }else{
            $("#academic_year").attr('style', 'border: 1px solid #ffc107;');
        }
    }
</script>