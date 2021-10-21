<div id="accordion-2" class="accordion accordion-s3">
    @foreach( \App\Models\aqs::getParentMenuItems() as $parent)
    <div class="accordion-item">
        <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#accordion-item-{{ $parent->id }}">
            <h6 class="title"> <em class="{{ $parent->class }}"></em> {{ $parent->name }}</h6>
            <span class="accordion-icon"></span>
        </a>
        <div class="accordion-body collapse" id="accordion-item-{{ $parent->id }}" data-parent="#accordion-2" >
            <div class="accordion-inner">
                <form id="manage-roles-{{ $parent->id }}" action="#" class="form-validate manage-roles is-alter" novalidate="novalidate">
                    <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                    <input type="hidden" name="role_id" value="{{ $role_id }}">
                    <ul class="custom-control-group g-4 align-center">
                        @foreach(\App\Models\aqs::getChild($parent->id) as $child)
                        @php $status = \App\Models\aqs::activeChildMenu($role_id,$parent->id, $child->id) @endphp
                        <li>
                            <div style="padding:10">
                               <input type="checkbox" {{ isset($status) ? 'checked' : '' }}  id="submenu-{{ $child->id }}" name="submenu[]" value="{{ $child->id }}">
                                <label for="submenu-{{ $child->id }}">{{ $child->name }}</label><br><br>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @if(sizeOf(\App\Models\aqs::getChild($parent->id)) > 0)
                    <p style="text-align: right;">
                    <button type="button" onclick="manageRoles({{ $parent->id }});" class="btn btn-sm btn-primary">Update</button>
                    </p>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>