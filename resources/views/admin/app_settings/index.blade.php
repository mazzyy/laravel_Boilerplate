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
                                        <h4 class="title nk-block-title">App Settings</h4>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#tabItem5"><em class="icon ni ni-lock-alt"></em><span>Login Setting</span></a>
                                            </li>
                                            <!-- <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem6"><em class="icon ni ni-user"></em><span>nav</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem7"><em class="icon ni ni-bell"></em><span>nav</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabItem8"><em class="icon ni ni-link"></em><span>nav</span></a>
                                            </li> -->
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabItem5">
                                                <div class="form-group">
                                                    <ul class="custom-control-group g-3 align-center">
                                                    <form action="#" id="login-setting-form" nctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id_login" value="{{ $logins->id }}">       
                                                        <li>
                                                            <div class="custom-control custom-control-lg custom-checkbox">
                                                                <input type="checkbox" {{ $logins->two_factor_auth > 0 ? "checked" : '' }} name="TwoFactorAuth" class="custom-control-input" id="customCheck2">
                                                                <label class="custom-control-label" for="customCheck2">TwoFactor Auth</label>
                                                            </div>
                                                        </li>
                                                     </form>   
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabItem6">
                                                <p>content</p>
                                            </div>
                                            <div class="tab-pane" id="tabItem7">
                                                <p>contnet</p>
                                            </div>
                                            <div class="tab-pane" id="tabItem8">
                                                <p>contnet</p>
                                            </div>
                                        </div>

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

        //TwoFactor Authencation 
        $('#customCheck2').on('change',function(event){
            event.preventDefault()
            var datastring = $("#login-setting-form").serialize();
            $.ajax({
               url: "{{ route('login-settings') }}",
               type: 'post',
               data: datastring,
               beforeSend: function(){
                    imageOverlay('#login-setting-form','show');
               },
               success: function(response){
                    if(response.status){
                        notify(response.message,response.notify);
                    }else{
                        notify(response.message,response.notify);
                    }
               },
               complete:function(data){
                    imageOverlay('#login-setting-form','hide');
               },
               error: function(data){
                    var msg = data.responseJSON.message;
                    notify(msg,'error');
                }

            });
        });

    });

</script>