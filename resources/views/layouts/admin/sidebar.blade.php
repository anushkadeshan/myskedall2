<div class="sidebar-wrapper" style="background-color:#ff4040; color:white">
    <style>
        .activemenu {
            background-color: brown;
        }
    </style>
	<div>
		<div class="logo-wrapper">
			<a href="{{route('home')}}"><img class="img-fluid for-light" src="{{asset('assets/admin/images/logo/logo.jpg')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/admin/images/logo/logo.jpg')}}" alt=""></a>
			<div class="back-btn"><i class="text-white fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="text-white status_toggle middle sidebar-toggle" data-toggle="sidebar-show" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('home')}}"><img class="img-fluid" src="{{asset('images/favicon-32x32.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links text-white" id="simple-bar">
					<li class="back-btn">
						<a href="{{route('home')}}"><img class="img-fluid" src="{{asset('images/favicon-32x32.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span class="text-white">Back</span><i class="text-white fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
					<li class="sidebar-list "><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'home' ? 'activemenu' : ''}}" href="{{ route('home') }}"><i class="text-white icon-home"></i> </i><span class="text-white"> {{__('msg.Home')}}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'users.index' ? 'activemenu' : ''}}" href="{{ route('users.index') }}"><i class="text-white icon-user"></i></i><span class="text-white"> {{__('msg.Users')}}</span></a></li>
                    @can('Super Admin')
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'roles.index' ? 'activemenu' : ''}}" href="{{ route('roles.index') }}"><i class="text-white icon-lock"></i><span class="text-white"> {{__('msg.Roles')}}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'permissions.index' ? 'activemenu' : ''}}" href="{{ route('permissions.index') }}"><i class="text-white icon-key"></i><span class="text-white"> {{__('msg.Permissions')}}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'groups.index' ? 'activemenu' : ''}}" href="{{ route('groups.index') }}"><i class="text-white icon-link"></i><span class="text-white"> {{__('msg.Groups')}}</span></a></li>
                    @endcan
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'groups.requests' ? 'activemenu' : ''}}" href="{{ route('groups.requests') }}"><i class="text-white icon-thumb-up"></i><span class="text-white"> {{__('msg.Group Requests')}}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'alerts.index' ? 'activemenu' : ''}}" href="{{ route('alerts.index') }}"><i class="text-white icon-bell"></i><span class="text-white"> {{__('msg.Alerts')}}</span></a></li>

					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == 'space' ? 'active' : '' }}"  href="#"><i class="text-white icon-layers text-white"></i><span class="text-white"> {{__('msg.My Spaces')}}</span>
							<div class="according-menu"><i class="text-white fa fa-angle-{{request()->route()->getPrefix() == '/space' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->route()->getPrefix() == '/space' ? 'block' : 'none;' }};">
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'materials.index' ? 'activemenu' : ''}}" href="{{ route('materials.index') }}"><i class="text-white icon-desktop"></i><span class="text-white"> {{__('msg.Materials')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'functions.index' ? 'activemenu' : ''}}" href="{{ route('functions.index') }}"><i class="text-white icon-paint-roller"></i><span class="text-white"> {{__('msg.Functions')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'types.index' ? 'activemenu' : ''}}" href="{{ route('types.index') }}"><i class="text-white icon-map-alt"></i><span class="text-white"> {{__('msg.Type of Locations')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'location-managament' ? 'activemenu' : ''}}" href="{{ route('location-managament') }}"><i class="text-white icon-location-pin"></i><span class="text-white"> {{__('msg.Location Management')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.index' ? 'activemenu' : ''}}" href="{{ route('approvals.index') }}"><i class="text-white icon-check-box"></i><span class="text-white"> {{__('msg.Approvals')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'reports.index' ? 'activemenu' : ''}}" href="{{ route('reports.index') }}"><i class="text-white icon-file"></i><span class="text-white"> {{__('msg.Reports')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'reasons.index' ? 'activemenu' : ''}}" href="{{ route('reasons.index') }}"><i class="text-white icon-clipboard"></i><span class="text-white"> {{__('msg.Reason Management')}}</span></a></li>

						</ul>
					</li>

                    <li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == 'apps/approvals' ? 'active' : '' }}"  href="#"><i class="text-white icon-layers"></i><span class="text-white"> {{__('msg.My Approvals')}}</span>
							<div class="according-menu"><i class="text-white fa fa-angle-{{request()->route()->getPrefix() == '/apps/approvals' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->route()->getPrefix() == '/apps/approvals' ? 'block' : 'none;' }};">
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.home' ? 'activemenu' : ''}}" href="{{ route('approvals.home') }}"><i class="text-white icon-home"></i><span class="text-white"> {{__('msg.Approvals Home')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.calender' ? 'activemenu' : ''}}" href="{{ route('approvals.calender') }}"><i class="text-white icon-calendar"></i><span class="text-white"> {{__('msg.Calender')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.create' ? 'activemenu' : ''}}" href="{{ route('approvals.create') }}"><i class="text-white icon-ink-pen"></i><span class="text-white"> {{__('msg.Create Request')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.requests' ? 'activemenu' : ''}}" href="{{ route('approvals.requests', ['null']) }}"><i class="text-white icon-tag"></i><span class="text-white"> {{__('msg.Requests')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'create.levels' ? 'activemenu' : ''}}" href="{{ route('create.levels') }}"><i class="text-white icon-ink-pen"></i><span class="text-white"> {{__('msg.Create Levels')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.levels' ? 'activemenu' : ''}}" href="{{ route('approvals.levels') }}"><i class="text-white icon-pencil-alt"></i><span class="text-white"> {{__('msg.Levels')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.types' ? 'activemenu' : ''}}" href="{{ route('approvals.types') }}"><i class="text-white icon-ink-pen"></i><span class="text-white"> {{__('msg.types')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.Sub Types' ? 'activemenu' : ''}}" href="{{ route('approvals.subtypes') }}"><i class="text-white icon-ink-pen"></i><span class="text-white"> {{__('msg.Sub Types')}}</span></a></li>

						</ul>
					</li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Request::is('languages*') ? 'active' : '' }}" href="{{url('languages/pt/translations?filter=&language=pt&group=msg')}}"><i class="text-white icon-cloud"></i><span class="text-white"> {{__('msg.Language Management')}}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'supports.index' ? 'active' : ''}}" href="{{ route('supports.index') }}"><i class="text-white icon-signal"></i><span class="text-white"> {{__('msg.Support Management')}}</span></a></li>
                </ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>
