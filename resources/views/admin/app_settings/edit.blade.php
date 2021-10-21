<input type="hidden" name="id" value="{{ $data->id ?? '' }}">
<div class="form-group">
    <label class="form-label" for="full-name">Host</label>
    <div class="form-control-wrap">
        <input type="text" value="{{ $data->host }}" class="form-control" name="host" id="role_name" required="">
    </div>
</div>
<div class="form-group">
    <label class="form-label" for="full-name">User</label>
    <div class="form-control-wrap">
        <input type="text" value="{{ $data->username }}" class="form-control" name="username" id="role_slug" required="">
    </div>
</div>
<div class="form-group">
    <label class="form-label" for="full-name">Password</label>
    <div class="form-control-wrap">
        <input type="text" value="{{ $data->password }}" class="form-control" name="password" id="role_slug" required="">
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="full-name">Mail Encryption</label>
    <div class="form-control-wrap">
        <select class="form-control" name="mail_enc">
            <option {{ $data->email_enc == 'SSL' ? 'selected' : '' }} value="SSL">SSL</option>
            <option {{ $data->email_enc == 'TLS' ? 'selected' : '' }} value="TLS">TLS</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="full-name">Port</label>
    <div class="form-control-wrap">
        <input type="text" value="{{ $data->port }}" class="form-control" name="port" id="role_slug" required="">
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="full-name">Email Title</label>
    <div class="form-control-wrap">
        <input type="text" value="{{ $data->sent_title }}" class="form-control" name="title" id="role_slug" required="">
    </div>
</div>
<div class="form-group">
    <label class="form-label" for="full-name">Status</label>
    <div class="form-control-wrap">
        <select class="form-control" name="status">
            <option {{ $data->status == 'Active' ? 'selected' : '' }} value="Active">Active</option>
            <option {{ $data->status == 'Inactive' ? 'selected' : '' }} value="Inactive">Inactive</option>
        </select>
    </div>
</div>