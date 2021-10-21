@extends('layouts.app')
@section('content')
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">

            	<div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Users List</h3>
                            <div class="nk-block-des text-soft">
                                <!-- <p>You have total 2,595 users.</p> -->
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <!-- <li><a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li> -->
                                        <li class="nk-block-tools-opt">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a data-toggle="modal" data-target="#modalDefault" href="#"><span>Add User</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->

                <div class="nk-block nk-block-lg">
				    <div class="card card-preview">
				        <div class="card-inner" id="data-table">
				        	<table class="datatable-init table">
							    <thead>
							        <tr>
							            <th>ID</th>
							            <th>Name</th>
							            <th>Email</th>
							            <th>Role</th>
							            <th>Permissions</th>
							            <th>Action</th>

							        </tr>
							    </thead>
							    <tbody >
							    	@foreach($data as $row)
									<tr>
									    <td>{{ $row['id'] }}</td>
									    <td>{{ $row['name'] }}</td>
									    <td>{{ $row['email'] }}</td>
									    <td>{{ $row['role'] }}</td>
									    <td>
									    	@if( $row['is_super'] > 0 )
									    		<span class="badge badge-success">Full Access</span>
									    	@else
									    	@foreach($row['permissions'] as $per)
									    		@if( $per['permissions'] == 'add' )
									    		<span class="badge badge-primary">{{ $per['permissions'] }}</span>
									    		@elseif( $per['permissions'] == 'edit' )
									    		<span class="badge badge-warning">{{ $per['permissions'] }}</span>
									    		@elseif( $per['permissions'] == 'view' )
									    		<span class="badge badge-info">{{ $per['permissions'] }}</span>
									    		@elseif( $per['permissions'] == 'delete' )
									    		<span class="badge badge-danger">{{ $per['permissions'] }}</span>
									    		@endif
									    	@endforeach
									    	@endif
									    </td>
									    <td>
									    	<!-- <button class="btn btn-xs btn-info" onclick="editItem({{ $row['id'] }});"><em class="icon ni ni-eye"></em></button> -->
									    	<button class="btn btn-xs btn-warning" onclick="editItem({{ $row['id'] }});"><em class="icon ni ni-edit"></em> Edit</button>
									    	<button class="btn btn-xs btn-danger" onclick="deleteItem({{ $row['id'] }});"><em class="icon ni ni-trash"></em> Delete</button>
									    </td>
									</tr>
									@endforeach
							    </tbody>
							</table>

				        </div>
				    </div><!-- .card-preview -->
                </div> <!-- nk-block -->

			</div>
		</div>
	</div>
</div>

<!-- Modal Trigger Code -->

<!-- Modal Content Code -->
<div class="modal fade zoom" tabindex="-1" id="modalDefault">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
            </div>
            <form id="add-roles" action="#" class="form-validate is-alter" novalidate="novalidate">
            <div class="modal-body">

                <div class="form-group">
                    <label class="form-label" for="full-name">User Name <span class="text-danger">*</span></label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="user_name" id="user_name" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="full-name">User Email <span class="text-danger">*</span></label>
                    <div class="form-control-wrap">
                        <input type="email" class="form-control" name="email" id="email" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="full-name">Password <span class="text-danger">*</span></label>
                    <div class="form-control-wrap">
                        <input type="password" class="form-control" name="user_password" id="user_password" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="full-name">User Role</label>
                    <div class="form-control-wrap">
                        <select class="form-control" name="user_role">
                        	@foreach($roles as $row)
                        	<option value="{{ $row->id }}">{{ $row->name }}</option>
                        	@endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
				    <div class="custom-control custom-checkbox">
				        <input type="checkbox" name="is_super" class="custom-control-input" id="customCheck1">
				        <label class="custom-control-label" for="customCheck1">Mark as SuperUser</label>
				    </div>
				</div>

                <div class="form-group">
                    <label class="form-label">Permissions</label>
                    <ul class="custom-control-group g-3 align-center">
                        <li>
                            <div class="custom-control custom-control-sm custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="add" id="com-add">
                                <label class="custom-control-label" for="com-add">Add</label>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-control-sm custom-checkbox">
                                <input type="checkbox" name="edit" class="custom-control-input" id="com-edit">
                                <label class="custom-control-label" for="com-edit">Edit</label>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-control-sm custom-checkbox">
                                <input type="checkbox" name="view" class="custom-control-input" id="com-view">
                                <label class="custom-control-label" for="com-view">View</label>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-control-sm custom-checkbox">
                                <input type="checkbox" name="delete" class="custom-control-input" id="com-delete">
                                <label class="custom-control-label" for="com-delete">Delete</label>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-lg btn-primary">Save</button>
            </div>
        	</form>
        </div>
    </div>
</div>

<div class="modal fade zoom" tabindex="-1" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Edit Role</h5>
            </div>
            <form id="edit-roles" action="#" class="form-validate is-alter" novalidate="novalidate">
            <div class="modal-body" id="edit-modal-body">


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-lg btn-primary">Update</button>
            </div>
        	</form>
        </div>
    </div>
</div>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>

    $(document).ready(function(){

        $('#role_name').keyup(function(e){
            var str = $('#role_name').val();
            str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
            $('#role_slug').val(str);
            $('#role_slug').attr('placeholder', str);
        });

        $('#add-roles').submit(function(event){
        	event.preventDefault()
        	var datastring = $("#add-roles").serialize();
        	$.ajax({
	           url: "{{ route('users') }}",
	           type: 'post',
	           data: datastring,
	           beforeSend: function(){
	           		imageOverlay('#add-roles','show');
	           },
	           success: function(response){
	           		if(response.status){
	           			notify(response.message,response.notify);
	           			setTimeout(function(){
                            window.location.reload();
                        }, 2000);
	           		}else{
	           			notify(response.message,response.notify);
	           		}
	           },
	           complete:function(data){
	           		imageOverlay('#add-roles','hide');
	           },
	           error: function(data){
	                var msg = data.responseJSON.message;
	                notify(msg,'error');
	            }

	        });
        });

        $('#edit-roles').submit(function(event){
        	event.preventDefault()
        	var datastring = $("#edit-roles").serialize();
        	$.ajax({
	           url: "{{ route('update-user') }}",
	           type: 'post',
	           data: datastring,
	           beforeSend: function(){
	           		imageOverlay('#edit-roles','show');
	           },
	           success: function(response){
	           		if(response.status){
	           			notify(response.message,response.notify);
	           			setTimeout(function(){
                            window.location.reload();
                        }, 2000);
	           		}else{
	           			notify(response.message,response.notify);
	           		}
	           },
	           complete:function(data){
	           		imageOverlay('#edit-roles','hide');
	           },
	           error: function(data){
	                var msg = data.responseJSON.message;
	                notify(msg,'error');
	            }

	        });
        });

    });

    function deleteItem(id){
    	Swal.fire({
		      title: 'Are you sure?',
		      text: "You won't be able to revert this!",
		      icon: 'warning',
		      showCancelButton: true,
		      confirmButtonText: 'Yes, delete it!'
		    }).then(function (result) {
		      if (result.value) {
		      	$.ajax({
		           url: "{{ route('delete-user') }}",
		           type: 'post',
		           data: {
			        "_token": "{{ csrf_token() }}",
			        'id' :  id,
			        },
		           beforeSend: function(){
		           		imageOverlay('#deleteItem','show');
		           },
		           success: function(response){
		           		if(response.status){
		           			notify(response.message,response.notify);
		           			setTimeout(function(){
	                            window.location.reload();
	                        }, 2000);
		           		}else{
		           			notify(response.message,response.notify);
		           		}
		           },
		           complete:function(data){
		           		imageOverlay('#deleteItem','hide');
		           },
		           error: function(data){
		                var msg = data.responseJSON.message;
	                notify(msg,'error');
		            }
		        });
		        //Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
		      }
		});
    }

    function editItem(id){
        $('#editModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        $.ajax({
            url: '{{ route("edit-user") }}',
            type: 'POST',
            data: { id : id },
            beforeSend: function() {
                imageOverlay('#edit-roles','show');
            },
            success: function (data){
                $('#edit-modal-body').html(data);
            },
            complete : function(){
                imageOverlay('#edit-roles','hide');
            },
            error: function(data){
                var msg = data.responseJSON.message;
	            notify(msg,'error');
            }
        });
    }


</script>
