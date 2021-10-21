<input type="hidden" name="id" value="<?= $data->id ?>">
<div class="form-group">
    <label class="form-label" for="full-name">User Name <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
        <input type="text" value="<?= $data->name ?>" class="form-control" name="user_name" id="user_name" required="">
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="full-name">User Email <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
        <input type="email" value="<?= $data->email ?>" class="form-control" readonly name="email" id="email" required="">
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="full-name">Password <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
        <input type="password" class="form-control" name="user_password" id="user_password">
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="full-name">User Role</label>
    <div class="form-control-wrap">
        <select class="form-control" name="user_role">
           <?php  foreach($roles as $role): ?>
            <option <?= $data->role_id == $role->id ? 'selected' : '' ?> value="<?= $role->id ?>"><?= $role->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="form-group">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" <?= $data->is_super > 0 ? 'checked' : '' ?> name="is_super" class="custom-control-input" id="customCheck1">
        <label class="custom-control-label" for="customCheck1">Mark as SuperUser</label>
    </div>
</div>

<div class="form-group">
    <label class="form-label">Permissions</label>
    <ul class="custom-control-group g-3 align-center">
        <?php $add='';$edit='';$view='';$delete=''; if(isset($permissions[0]->permissions)): ?>
        <?php  $permission = $permissions ?>
        <?php foreach($permission as $row): ?>
            <?php if($row->permissions == 'add' ): ?>
                <?php $add = 'checked'; ?>
            <?php elseif($row->permissions == 'edit' ): ?>
                <?php $edit = 'checked'; ?>
            <?php elseif($row->permissions == 'view' ): ?>
                <?php $view = 'checked'; ?>
            <?php elseif($row->permissions == 'delete' ): ?>
                <?php $delete = 'checked'; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
        <li>
            <div class="custom-control custom-control-sm custom-checkbox">
                <input type="checkbox" <?= $add ?> class="custom-control-input" name="add" id="com-add-edit">
                <label class="custom-control-label" for="com-add-edit">Add</label>
            </div>
        </li>
        <li>
            <div class="custom-control custom-control-sm custom-checkbox">
                <input type="checkbox" <?= $edit ?> name="edit" class="custom-control-input" id="com-edit-edit">
                <label class="custom-control-label" for="com-edit-edit">Edit</label>
            </div>
        </li>
        <li>
            <div class="custom-control custom-control-sm custom-checkbox">
                <input type="checkbox" <?= $view ?> name="view" class="custom-control-input" id="com-view-edit">
                <label class="custom-control-label" for="com-view-edit">View</label>
            </div>
        </li>
        <li>
            <div class="custom-control custom-control-sm custom-checkbox">
                <input type="checkbox" <?= $delete ?> name="delete" class="custom-control-input" id="com-delete-edit">
                <label class="custom-control-label" for="com-delete-edit">Delete</label>
            </div>
        </li>



    </ul>
</div>
