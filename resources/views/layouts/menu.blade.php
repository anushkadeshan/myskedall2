<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home"></i><span> {{__('msg.Home')}}</span></a>
</li>
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}"><i class="fa fa-users"></i><span> {{__('msg.Users')}}</span></a>
</li>

@can('Super Admin')
<li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('roles.index') }}"><i class="fa fa-lock"></i><span> {{__('msg.Roles')}}</span></a>
</li>

<li class="nav-item {{ Request::is('permissions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('permissions.index') }}"><i class="fa fa-key"></i><span> {{__('msg.Permissions')}}</span></a>
</li>

<li class="nav-item {{ Request::is('groups*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('groups.index') }}"><i class="fa fa-object-group"></i><span> {{__('msg.Groups')}}</span></a>
</li>

@endcan

<li class="nav-item {{ Request::is('group-requests*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('groups.requests') }}"><i class="fa fa-thumbs-up"></i><span> {{__('msg.Group Requests')}}</span></a>
</li><li class="{{ Request::is('alerts*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('alerts.index') }}"><i class="fa fa-bell"></i><span> {{__('msg.Alerts')}} </span></a>
</li>

<li class="nav-item {{ Request::is('materials*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('materials.index') }}"><i class="fa fa-desktop"></i><span> {{__('msg.Materials')}} </span></a>
</li>

<li class="nav-item {{ Request::is('functions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('functions.index') }}"><i class="fa fa-universal-access"></i><span> Functions</span></a>
</li>

<li class="nav-item {{ Request::is('location-types*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('types.index') }}"><i class="fa fa-location-arrow"></i><span> {{ __('msg.Type of Locations') }} </span></a>
</li>

<li class="nav-item {{ Request::is('admin/location-management*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('admin/location-management') }}"><i class="fa fa-compass"></i><span> {{ __('msg.Location Management') }} </span></a>
</li>

<li class="nav-item {{ Request::is('approvals*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('approvals.index') }}"><i class="fa fa-check"></i><span> Approvals</span></a>
</li>

<li class="nav-item {{ Request::is('admin/reports*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('admin/reports') }}"><i class="fa fa-file"></i><span> Reports</span></a>
</li>

<li class="nav-item {{ Request::is('languages*') ? 'active' : '' }}">
    <a class="nav-link" href="{{url('languages/pt/translations?filter=&language=pt&group=msg')}}"><i class="fa fa-language"></i><span> {{ __('msg.Language Management') }} </span></a>
</li>

<li class="nav-item {{ Request::is('space-reasons*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('reasons.index') }}"><i class="fa fa-question-circle"></i><span> {{ __('msg.Reason Management') }} </span></a>
</li>



<li class="nav-item {{ Request::is('admin/supports*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('admin/supports') }}"><i class="fa fa-headset"></i><span> {{ __('msg.Support Management') }} </span></a>
</li>
