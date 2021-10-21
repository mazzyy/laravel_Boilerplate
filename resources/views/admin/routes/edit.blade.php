<input type="hidden" name="id" value="{{ $data->id }}">
<div class="form-group">
    <label class="form-label" for="full-name">Role Name <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
        <input type="text" value="{{ $data->route }}" class="form-control" name="route_name" id="role_name" required="">
    </div>
</div>
<div class="form-group">
    <label class="form-label" for="full-name">Role Slug <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
        <input type="text" value="{{ $data->slug }}" class="form-control" name="route_slug" id="role_slug" required="">
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#role_name').keyup(function(e){
            var str = $('#role_name').val();
            str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
            $('#role_slug').val(str);
            $('#role_slug').attr('placeholder', str);
        });
    });
</script>
