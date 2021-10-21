@extends('layouts.app')
@section('content')
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
				    <div class="card card-preview">
				        <div class="card-inner" id="data-table">

			        		<div class="nk-block nk-block-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="title nk-block-title">Business Information</h4>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner">

                                        <form action="#" id="add-form" nctype="multipart/form-data">
                                        	<input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                            @csrf
                                            <div class="row g-4">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="full-name-1">Business Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" value="{{ $data->name ?? '' }}" class="form-control" name="name" required >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email-address-1">Email address</label>
                                                        <div class="form-control-wrap">
                                                            <input type="email" value="{{ $data->email ?? '' }}" class="form-control" name="email"  >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="phone-no-1">Phone No</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" value="{{ $data->contact ?? '' }}" class="form-control" name="phone"  >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="pay-amount-1">Postal Address</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" value="{{ $data->address ?? '' }}" class="form-control" name="address"  >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="pay-amount-1">Website</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" value="{{ $data->website ?? '' }}" class="form-control" name="website"  >
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="pay-amount-1">Logo</label>
                                                        <div class="form-control-wrap">
                                                            <input type="file" class="form-control" name="image"  >
                                                        </div>
                                                    </div>
                                                </div> -->


                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-lg btn-primary">Save Information</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- .nk-block -->

				        </div>
				    </div><!-- .card-preview -->
                </div> <!-- nk-block -->

			</div>
		</div>
	</div>
</div>

<!-- Modal Trigger Code -->

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>

    $(document).ready(function(){
        $('#add-form').submit(function(event){
        	event.preventDefault()
        	var datastring = $("#add-form").serialize();
        	$.ajax({
	           url: "{{ route('company-info') }}",
	           type: 'post',
	           data: datastring,
	           beforeSend: function(){
	           		imageOverlay('#add-form','show');
	           },
	           success: function(response){
	           		if(response.status){
	           			notify(response.message,response.notify);
	           			// setTimeout(function(){
               //              window.location.reload();
               //          }, 2000);
	           		}else{
	           			notify(response.message,response.notify);
	           		}
	           },
	           complete:function(data){
	           		imageOverlay('#add-form','hide');
	           },
	           error: function(data){
	                var msg = data.responseJSON.message;
	                notify(msg,'error');
	            }

	        });
        });
    });

</script>
