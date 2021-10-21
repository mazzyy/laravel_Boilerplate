    <input type="hidden" name="id" value="{{ $menu->id }}">
    <div class="form-group">
        <label class="form-label" for="full-name">User Role</label>
        <div class="form-control-wrap">
            <select class="form-control" name="mmenu_id">
                <option value="0">Main</option>
                @foreach($data as $row)
                @if( $row->parent == 0)
                <option {{ $menu->id == $row->id ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label" for="full-name">Menu Name <span class="text-danger">*</span></label>
        <div class="form-control-wrap">
            <input type="text" value="{{ $menu->name }}" class="form-control" name="menu_name" id="role_name" required="">
        </div>
    </div>

    <div class="form-group">
        <label class="form-label" for="full-name">Menu Icon</label>
        <div class="form-control-wrap">
            <select class="form-control" name="menu_icon">
                <option value="icon ni ni-users">Users</option>
                <option value="icon ni ni-menu">Menu</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="full-name">Menu Route</label>
        <div class="form-control-wrap">
            <select class="form-control" name="menu_route">
                @foreach($routes as $row)
                <option {{ $menu->url == $row->slug ? 'selected' : '' }} value="{{ $row->slug }}">{{ $row->route }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label" for="full-name">Menu Order <span class="text-danger">*</span></label>
        <div class="form-control-wrap">
            <input type="text" value="{{ $menu->display_order }}" class="form-control" name="menu_order" id="role_slug" required="">
        </div>
    </div>
