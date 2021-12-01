@extends('platform/template')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
	#overlay {
		pointer-events:none;
  		background-color: rgba(220,220,220,0.5); /* Black background with opacity */
  		z-index: 2; /* Specify a stack order in case you're using a different order for other elements */ /* Add a pointer on hover */
	}
</style>
@section('content')
	<table width="100%" class="painelNivel">
      <tbody><tr><td>{{ __('msg.Location Management') }}</td></tr>
      <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
    </tbody></table>
	<div style="margin-top:10; margin-left:10px">
		@can('Create Location')
			<a href="{{url('admin/new-location')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __('msg.Add New') }}</a>
		@endcan

			<a href="{{url('admin/change-view/list')}}" class="btn btn-success"><i class="fa fa-list"></i> {{ __('msg.List View') }}</a>
			<a href="{{url('admin/change-view/grid')}}" class="btn btn-warning"><i class="fa fa-th"></i> {{ __('msg.Grid View') }}</a>

	</div>
	@if(session('location-view')=='list')
		<table id="showLocationlist" class="table table-stripe">
			<thead>
				<th>ID</th>
				<th>{{ __('msg.name') }}</th>
				<th>{{ __('msg.address') }}</th>
				<th>{{ __('msg.quantity') }}</th>
				@can('Change Location Status')
				<th>{{ __('msg.status') }}</th>
				@endcan
				@can('Block Location')
				<th>{{ __('msg.block') }}</th>
				@endcan
				@hasanyrole('Super Admin|Local Admin|Module Admin')
				<th>{{ __('msg.Action') }}</th>
				@endhasanyrole
			</thead>
			<tbody>

			</tbody>
		</table>
	@else
		<div class="row" style="margin-top: 10px; padding-left:5px; padding-right:5px;">
			@foreach($locations as  $location)
				<div class="col-md-6">
					<div class="card mb-3" @if($location->is_flag==1) id="overlay" @endif>
					<div id="carouselExampleControls{{$location->id}}" class="carousel slide" style="padding:10px" data-interval="false">
							<div class="carousel-inner">
								@if($location->photos != "")
									@foreach(explode(',', $location->photos) as $info)
										@if(preg_match('/(\.jpg|\.png|\.bmp|\.jpeg|\.JPG)$/i',$info))
											<div class="carousel-item {{ $loop->first ?  'active' : '' }}">
												<img class="d-block w-100" height="250" src="{{asset('_dados/plataforma/location/images/'.$info)}}">
											</div>
										@endif
									@endforeach
								@endif
								<a class="carousel-control-prev" href="#carouselExampleControls{{$location->id}}" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleControls{{$location->id}}" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>

						</div>
                        <div class="mt-10" style="margin-top: 10px; pad">
                            <a class="carousel-control-prev" style="color: red; font-weight; font-weight:bold" href="#carouselExampleControls{{$location->id}}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                                <i class="fa fa-chevron-left"></i>Previous</a>
                            <a class="carousel-control-next" style="color: red; font-weight; font-weight:bold" href="#carouselExampleControls{{$location->id}}" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next </span>
                                Next <i class="fa fa-chevron-right"></i></a>
                        </div>

						<div class="card-body">
							<h5 class="card-title"><b>{{$location->name}}</b>
								@if($location->is_flag==0)
									<span style="float: right;font-size:12px" class="label label-success">{{__('msg.Available')}} </span>
								@else
									<span style="float: right; font-size:12px" style="background-color: red" class="label label-danger ">{{__('msg.Not Available')}} </span>
								@endif
							</h5>

							<p class="card-text">{{__('msg.Address')}}  : <span class="text-muted">{{$location->address}}</span></p>
							<p class="card-text">{{__('msg.Contact Name')}}  : <span class="text-muted">{{$location->contact}} | <span class="card-text text-black" style="color: black">{{__('msg.Contact No')}}  : <span class="text-muted">{{$location->telephone}}</span></span></span></p>

							<p class="card-text">{{__('msg.No of People')}}  : <span class="text-muted">{{$location->total_people}} | <span class="card-text text-black" style="color: black">{{__('msg.Size')}}  : <span class="text-muted">{{$location->size}}</span></span></span></p>
							<p class="card-text">{{__('msg.Price')}}  : <span class="text-muted">{{$location->price}}</span></p>
							<p class="card-text">{{__('msg.Area Type')}} : <span class="text-muted">{{$location->area_type}} | <span class="card-text text-black" style="color: black">{{__('msg.Air Conditioned')}}  : <span class="text-muted">{{$location->air_conditioner}}</span></span>
								| <span class="card-text text-black" style="color: black">{{__('msg.Parking')}}  : <span class="text-muted">{{$location->parking}}</span></span>
							</span></p>

							<p class="card-text">{{__('msg.Period')}} : <span class="text-muted">{{$location->period}} | <span class="card-text text-black" style="color: black">{{__('msg.Date')}}  : <span class="text-muted">{{$location->date}}</span></span>
								| <span class="card-text text-black" style="color: black">{{__('msg.Budget')}}  : <span class="text-muted">{{$location->budget}}</span></span>
							</span></p>
							<div class="btn-group" style="float:right" role="group" aria-label="Basic" >
								<a type="button" class="btn btn-primary" href="{{url("admin/edit-location")}}/{{$location->id}}"><i class="fa fa-pencil"></i></a>
								<a type="button" class="btn btn-warning" href="{{url("admin/view-location")}}/{{$location->id}}"><i class="fa fa-eye"></i></a>
								@if(session('SuperAdmin')==1)
									<button type="button" class="btn btn-danger" onclick="DeleteConfirm(`{{url("admin/delete-location")}}/{{$location->id}}`)"><i class="fa fa-trash"></i></button>
								@endif
							</div>
						</div>
					</div>
				</div>
			@endforeach

		</div>



	@endif
	<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
