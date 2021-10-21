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
                                        <h4 class="title nk-block-title">User Activaty Logs</h4>
                                    </div>
                                </div>

                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <div class="row gy-4">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Users</label>
                                                    <div class="form-control-wrap">
                                                        <select name="user_id" id="user_id" class="form-select form-control form-control-lg" data-search="on">
                                                            <option  value="All">All Users</option>
                                                            @foreach($uesrs as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Start Date</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-calendar"></em>
                                                        </div>
                                                        <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">End Date</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-right">
                                                            <em class="icon ni ni-calendar-alt"></em>
                                                        </div>
                                                        <input type="text" class="form-control date-picker">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">

                                                    <label class="form-label">Report</label>
                                                    <div class="toggle-wrap nk-block-tools-toggle">
                                                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                        <div class="toggle-expand-content" data-content="pageMenu">
                                                            <ul class="nk-block-tools g-3">
                                                                <!-- <li><a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li> -->
                                                                <li class="nk-block-tools-opt">
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-toggle="dropdown"><em class="icon ni ni-coins"></em>  </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li><a data-toggle="modal" data-target="#modalDefault" href="#"><span>Excel</span></a></li>
                                                                                <li><a data-toggle="modal" data-target="#modalDefault" href="#"><span>HTML</span></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card card-bordered">
                                    <div class="card-inner">

                                        <table class="table data-table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User Name</th>
                                                    <th>URL</th>
                                                    <th>IP Address</th>
                                                    <th style="width:15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

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

<div class="modal fade zoom" tabindex="-1" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">User Location</h5>
            </div>
            <div class="modal-body" id="edit-modal-body">
            </div>
        </div>
    </div>
</div>

<!-- Modal Trigger Code -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(function () {

    NioApp.DataTable.init = function () {
         NioApp.DataTable('.data-table', {
          processing: true,
            serverSide: true,
           // ajax: "{{ route('user-logs') }}",
            "ajax": {
                "url": "{{ route('user-logs') }}",
                "data": function(d) {
                    d.status = $('#user_id option:selected').val();
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'url', name: 'url'},
                {data: 'ip', name: 'ip'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
        $.fn.DataTable.ext.pager.numbers_length = 7;
    };

  });



</script>

@endsection
<script type="text/javascript">
    function getLocation(id){
        $('#editModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        $.ajax({
            url: '{{ route("get-user-location") }}',
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
