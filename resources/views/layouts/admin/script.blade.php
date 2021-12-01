<script src="{{asset('assets/admin/js/jquery-3.5.1.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/admin/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/admin/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/admin/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{asset('assets/admin/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('assets/admin/js/scrollbar/custom.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/admin/js/config.js')}}"></script>
<!-- Plugins JS start-->
<script id="menu" src="{{asset('assets/admin/js/sidebar-menu.js')}}"></script>
@yield('script')

@if(Route::current()->getName() != 'popover')
	<script src="{{asset('assets/admin/js/tooltip-init.js')}}"></script>
@endif

<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('assets/admin/js/script.js')}}"></script>


{{-- @if(Route::current()->getName() == 'index')
	<script src="{{asset('assets/admin/js/layout-change.js')}}"></script>
@endif --}}
