<input type="hidden" name="id" value="<?= $data->id ?>">
<div class="form-group">
    <label class="form-label" for="full-name">Role Name <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" name="role_name" id="role_name" required="" value="<?= $data->name ?>">
    </div>
</div>
<div class="form-group">
    <label class="form-label" for="full-name">Role Slug <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" name="role_slug" id="role_slug" required="" value="<?= $data->slug ?>">
    </div>
</div>
