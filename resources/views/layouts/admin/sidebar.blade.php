<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{route('home')}}"><img class="img-fluid for-light" src="{{asset('assets/admin/images/logo/logo.jpg')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/admin/images/logo/logo.jpg')}}" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-toggle="sidebar-show" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('home')}}"><img class="img-fluid" src="{{asset('images/favicon-32x32.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{route('home')}}"><img class="img-fluid" src="{{asset('images/favicon-32x32.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'home' ? 'active' : ''}}" href="{{ route('home') }}"><i class="icon-home"></i> </i><span> {{__('msg.Home')}}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'users.index' ? 'active' : ''}}" href="{{ route('users.index') }}"><i class="icon-user"></i></i><span> {{__('msg.Users')}}</span></a></li>
                    @can('Super Admin')
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'roles.index' ? 'active' : ''}}" href="{{ route('roles.index') }}"><i class="icon-lock"></i><span> {{__('msg.Roles')}}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'permissions.index' ? 'active' : ''}}" href="{{ route('permissions.index') }}"><i class="icon-key"></i><span> {{__('msg.Permissions')}}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'groups.index' ? 'active' : ''}}" href="{{ route('groups.index') }}"><i class="icon-link"></i><span> {{__('msg.Groups')}}</span></a></li>
                    @endcan
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'groups.requests' ? 'active' : ''}}" href="{{ route('groups.requests') }}"><i class="icon-thumb-up"></i><span> {{__('msg.Group Requests')}}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'alerts.index' ? 'active' : ''}}" href="{{ route('alerts.index') }}"><i class="icon-bell"></i><span> {{__('msg.Alerts')}}</span></a></li>

					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == 'space' ? 'active' : '' }}" href="#"><i class="icon-layers"></i><span> {{__('msg.My Spaces')}}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/space' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->route()->getPrefix() == '/space' ? 'block' : 'none;' }};">
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'materials.index' ? 'active' : ''}}" href="{{ route('materials.index') }}"><i class="icon-desktop"></i><span> {{__('msg.Materials')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'functions.index' ? 'active' : ''}}" href="{{ route('functions.index') }}"><i class="icon-paint-roller"></i><span> {{__('msg.Functions')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'types.index' ? 'active' : ''}}" href="{{ route('types.index') }}"><i class="icon-map-alt"></i><span> {{__('msg.Type of Locations')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'location-managament' ? 'active' : ''}}" href="{{ route('location-managament') }}"><i class="icon-location-pin"></i><span> {{__('msg.Location Management')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.index' ? 'active' : ''}}" href="{{ route('approvals.index') }}"><i class="icon-check-box"></i><span> {{__('msg.Approvals')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'reports.index' ? 'active' : ''}}" href="{{ route('reports.index') }}"><i class="icon-file"></i><span> {{__('msg.Reports')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'reasons.index' ? 'active' : ''}}" href="{{ route('reasons.index') }}"><i class="icon-clipboard"></i><span> {{__('msg.Reason Management')}}</span></a></li>

						</ul>
					</li>

                    <li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == 'apps/approvals' ? 'active' : '' }}" href="#"><i class="icon-layers"></i><span> {{__('msg.My Approvals')}}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/apps/approvals' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->route()->getPrefix() == '/apps/approvals' ? 'block' : 'none;' }};">
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.home' ? 'active' : ''}}" href="{{ route('approvals.home') }}"><i class="icon-home"></i><span> {{__('msg.Approvals Home')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.calender' ? 'active' : ''}}" href="{{ route('approvals.calender') }}"><i class="icon-calendar"></i><span> {{__('msg.Calender')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.create' ? 'active' : ''}}" href="{{ route('approvals.create') }}"><i class="icon-ink-pen"></i><span> {{__('msg.Create Request')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.requests' ? 'active' : ''}}" href="{{ route('approvals.requests', ['null']) }}"><i class="icon-tag"></i><span> {{__('msg.Requests')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'create.levels' ? 'active' : ''}}" href="{{ route('create.levels') }}"><i class="icon-ink-pen"></i><span> {{__('msg.Create Levels')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.levels' ? 'active' : ''}}" href="{{ route('approvals.levels') }}"><i class="icon-pencil-alt"></i><span> {{__('msg.Levels')}}</span></a></li>
					        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'approvals.types' ? 'active' : ''}}" href="{{ route('approvals.types') }}"><i class="icon-ink-pen"></i><span> {{__('msg.Create Types')}}</span></a></li>

						</ul>
					</li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Request::is('languages*') ? 'active' : '' }}" href="{{url('languages/pt/translations?filter=&language=pt&group=msg')}}"><i class="icon-cloud"></i><span> {{__('msg.Language Management')}}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'supports.index' ? 'active' : ''}}" href="{{ route('supports.index') }}"><i class="icon-signal"></i><span> {{__('msg.Support Management')}}</span></a></li>
                </ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>
