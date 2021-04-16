@extends('space/template')
@section('content')
<div class="row">
	<form action="" method="post" id="request_form">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.events') }} </label><strong style="color:red">{{$errors->first('events')}}</strong>
					<input type="text" class="form-control" name="events" value="@if(old('events')){{old('events')}}@elseif(!empty($data->events)){{$data->events}}@endif">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.No of people') }} </label><strong style="color:red">{{$errors->first('total_people')}}</strong>
					<input type="text" class="form-control" name="total_people" value="@if(old('total_people')){{old('total_people')}}@elseif(!empty($data->total_people)){{$data->total_people}}@endif">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.reason') }} </label><strong style="color:red">{{$errors->first('reason')}}</strong>
					<!--input type="text" class="form-control" name="reason" value="{{old('reason')}}"-->
					<select class="form-control" name="reason">
						<option value="">{{ __('msg.Select Reason') }}</option>
						@foreach($reasonList as $reason)
							<option value="{{$reason->reason}}" @if(old('reason')==$reason->reason) selected @elseif(!empty($data->reason) && $data->reason=$reason->reason) selected @endif>{{$reason->reason}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.price') }} </label><strong style="color:red">{{$errors->first('price')}}</strong>
					<input type="text" id="exact-price" class="form-control" name="price" value="@if(old('price')){{old('price')}}@elseif(!empty($data->price)){{$data->price}} @else {{ 0.00 }} @endif">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Initial Date') }} </label><strong style="color:red">{{$errors->first('initial_date')}}</strong>
					<input type="text" id="datepicker1" autocomplete="off" class="form-control" name="initial_date" value="@if(old('initial_date')){{old('initial_date')}}@elseif(!empty($data->initial_date)){{$data->initial_date}}@endif">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Initial Time') }} </label><strong style="color:red">{{$errors->first('initial_time')}}</strong>
					{{--<input type="time" placeholder="24 Hours" autocomplete="off" class="form-control" name="initial_time" value="@if(old('initial_time')){{old('initial_time')}}@elseif(!empty($data->initial_time)){{date('H:i',strtotime($data->initial_time))}}@endif"> --}}
					<div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
					    <input type="text" class="form-control" name="initial_time" value="@if(old('initial_time')){{old('initial_time')}}@elseif(!empty($data->initial_time)){{date('H:i',strtotime($data->initial_time))}}@endif">
					    <span class="input-group-addon">
					        <span class="glyphicon glyphicon-time"></span>
					    </span>
					</div>

				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Final Date') }} </label><strong style="color:red">{{$errors->first('final_date')}}</strong>
					<input type="text" id="datepicker2" autocomplete="off" class="form-control" name="final_date" value="@if(old('final_date')){{old('final_date')}}@elseif(!empty($data->final_date)){{$data->final_date}}@endif">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Final Time') }} </label><strong style="color:red">{{$errors->first('final_time')}}</strong>
					{{--<input type="time"  placeholder="24 Hours" autocomplete="off" class="form-control" name="final_time" value="@if(old('final_time')){{old('final_time')}}@elseif(!empty($data->final_time)){{date('H:i',strtotime($data->final_time))}}@endif">--}}
					<div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
					    <input type="text" class="form-control" name="final_time" value="@if(old('final_time')){{old('final_time')}}@elseif(!empty($data->final_time)){{date('H:i',strtotime($data->final_time))}}@endif">

					    <span class="input-group-addon">
					        <span class="glyphicon glyphicon-time"></span>
					    </span>
					</div>

				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.location') }} </label><strong style="color:red">{{$errors->first('location')}}</strong>
					<!--textarea class="form-control" name="location">{{old('location')}}</textarea-->
					<select class="form-control" onchange="CheckPriceByLocation()" id="space-location" name="location">
						<option value="">{{ __('msg.Select Location') }}</option>
						@foreach($locationList as $location)
					   	<option value="{{$location->id}}" @if(!empty($data->location) && $data->location==$location->id) selected @endif>{{$location->location_name}} - {{$location->address}}
					    </option>
                    	@endforeach
					</select>
					<input type="hidden"  id="locationjson" name="locationjson" value="@if(old('locationjson')){{old('locationjson')}}@elseif(!empty($locationjson)){{$locationjson}}@endif">
				</div>
            </div>

			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Space Manager') }} </label><strong style="color:red">{{$errors->first('space_manager')}}</strong>
					<input type="text" class="form-control"  value="@if(!empty($data->location)){{$data->space_manager}}@endif" id="space_manager"  name="space_manager" value="@if(old('space_manager')){{old('space_manager')}}@elseif(!empty($space_manager)){{$space_manager}}@endif">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Location Requester') }} </label><strong style="color:red">{{$errors->first('location_requester')}}</strong>
					<input type="text" name="location_requester" class="form-control" value="@if(old('location_requester')){{old('location_requester')}}@elseif(!empty($data->location_requester)){{$data->location_requester}}@else{{session('name')}}@endif">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label></label><strong style="color:red">{{$errors->first('agreement')}}</strong>
					<input type="hidden" id="fill-click-value" name="agreement">
					<input type="button" onclick="CheckRuleClick()" id="rules-of-use" class="form-control btn btn-warning" value="{{ __('msg.Rules For Use') }}">
				</div>
			</div>
		</div>
		<input type="hidden" value="1" name="tactic">
		<div class="col-md-12">
			<div class="col-md-12">
                <input type="button" style="color:green;font-weight: bold;" onclick="RequestSpace()" value="{{ __('msg.Request SPACE') }}">
                <button type="submit" style="color:green;font-weight: bold;" name="saveAsDraft" value="1">{{ __('msg.save as draft') }}</button>
                @if(session('new_sp_req_id'))
				    <button onclick="ShareSpaceRequest({{ session('new_sp_req_id') }})" type="button" style="color:green;font-weight: bold;"><span class="glyphicon glyphicon-share" aria-hidden="true" style="font-size:15px;"></span> {{ __('msg.share request') }}</button>
                @endif

            </div>
		</div>
		

		
		<div class="modal fade" id="UserAgreement" role="dialog">
			<div class="modal-dialog modal-lg" style="top:30%" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">{{ __('msg.Read and Accept the Agreement') }}</h4>
				</div>
				<div class="modal-body">
					<div id="rules">
					</div>
				</div>
				<div class="modal-footer">
				<button type="button" onclick="acceptAgreement()" class="btn btn-primary float-left" >{{ __('msg.accept') }}</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ __('msg.close') }}</button>
				</div>
			</div>

			</div>
		</div>
		<div class="modal fade" id="location_card" role="dialog">
			<div class="modal-dialog " >
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="location_title"></h4>
				</div>
				<div class="modal-body text-center">
							<div class="carousel-inner">
								<div class="carousel-item">
									<img class="d-block w-100" id="location_img" height="250" src="">
								</div>
							</div>
							<h5 class="card-title" ><b id="location_title2"></b></h5>
							<p class="card-text">{{__('msg.Address')}}  : <span class="text-muted" id="location_address"></span></p>
							<p class="card-text">{{__('msg.Contact Name')}}  : <span class="text-muted" id="location_contact"> | <span class="card-text text-black" style="color: black">{{__('msg.Contact No')}}  : <span class="text-muted" id="location_telephone"></span></span></span></p>
							<p class="card-text">{{__('msg.Contact No')}}  : <span class="text-muted" id="location_telephone"></span></span></span></p>
							 
							<p class="card-text">{{__('msg.No of People')}}  : <span class="text-muted" id="location_people"> | <span class="card-text text-black" style="color: black">{{__('msg.Size')}}  : <span class="text-muted" id="location_size"></span></span></span></p>
							<p class="card-text">{{__('msg.Price')}}  : <span class="text-muted" id="location_price"></span></p>
							<p class="card-text">{{__('msg.Area Type')}} : <span class="text-muted" id="location_area_type"> | <span class="card-text text-black" style="color: black">{{__('msg.Air Conditioned')}}  : <span class="text-muted" id="location_air"></span></span>
								| <span class="card-text text-black" style="color: black">{{__('msg.Parking')}}  : <span class="text-muted" id="location_parking"></span></span>
							</span></p>

							<a href="" id="seemore" target="_blank">
								<button type="button" class="btn btn-success" >{{ __('msg.View More') }}</button>
							</a>

					
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ __('msg.close') }}</button>
				</div>
			</div>

			</div>
		</div>
		<div class="modal fade" id="SubmitConfirmModel" role="dialog">
			<div class="modal-dialog modal-sm" style="top:30%">
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">{{ __('msg.Submit Confirmation') }}</h4>
					</div>
					<div class="modal-body">
					<p>{{ __('msg.Are you sure? You want to submit this request') }}</p>
					</div>
					<div class="modal-footer">
					<button type="submit" class="btn btn-primary float-left" >{{ __('msg.submit') }}</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">{{ __('msg.close') }}</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="ModelId12" role="dialog">
			<div class="modal-dialog modal-sm" style="top:30%">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">{{ __('msg.The time for this location is already reserved') }}</h4>
				</div>
				<div class="modal-body">
				<p>{{ __('msg.Do you wishes submit request priority for your event') }}</p>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="SaveRequestPriority()" class="btn btn-primary float-left" >{{ __('msg.yes') }}</button>
					<a href="{{url('app/space/12')}}"><button type="button" class="btn btn-default" data-dismiss="modal">{{ __('msg.no') }}</button></a>
				</div>
			</div>

			</div>
        </div>
        <div class="modal fade" id="successModel" role="dialog">
            <div class="modal-dialog modal-sm" style="top:30%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ __('msg.congragulations') }}</h4>
                    </div>
                    <div class="modal-body">
                        @if(session('is_draft'))
                        <p>{{ __('msg.Your request saved as draft and Your request id is') }} {{ session('new_sp_req_id') }}</p>
                        @else
                        <p>{{ __('msg.Your request is confirmed and Your request id is') }} {{ session('new_sp_req_id') }}</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <a href="{{url('app/space/12')}}"><button type="button" class="btn btn-default" data-dismiss="modal">{{ __('msg.close') }}</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ShareSpaceRequest_pc" style="z-index:9999">
            <div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
                <div class="modal-content">
                    <div class="modal-body" style="text-align:left">
                        <div style="font-size:20px;">{{ __('msg.To Share Space Request') }}</div>
                        <div class="input-group" style="margin-top:15px; width:100%;">
                            <font style="color:#999999">{{ __('msg.Enter Your Email') }}</font>
                            <br>
                            <input type="text" id="share-request-email" value="" maxlength="255" class="form-control">
                            <input type="hidden" id="share-request-id" value="">
                        </div>
                        <br>

                        <button type="button" class="btn btn-success" onclick="ShareSpaceRequestEmail()"
                            style="width:90px;">{{ __('msg.submit') }}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            style="width:90px; margin-left:10px;">{{ __('msg.cancel') }}</button>
                        <div class="input-group" style="margin-top:15px; width:100%;">
                            <font style="color:#999999">{{ __('msg.or Share With') }}</font>
                            <br>
                             <br>
                            <a target="_blank" href="https://api.whatsapp.com/send?text=Your Space Request ID is {{ session('new_sp_req_id') }} . You can See your Space request details via this link. {{ URL::to('/space/edit-request/'.session('new_sp_req_id')) }}" class="pr-5"><img src={{asset('/social/whatsapp.svg')}} height="40" alt=""></a>&nbsp&nbsp
                            <a target="_blank" href="https://t.me/share/url?url={{ URL::to('/space/edit-request/'.session('new_sp_req_id')) }}&text=Your Space Request ID is {{ session('new_sp_req_id') }} . You can See your Space request details via above link"><img
                                    src={{asset('/social/telegram.svg')}} height="40" alt=""></a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ShareRequest" role="dialog">
            <div class="modal-dialog modal-sm" style="top:30%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ __('msg.The time for this location is already reserved') }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('msg.Do you wishes submit request priority for your event') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="SaveRequestPriority()"
                            class="btn btn-primary float-left">{{ __('msg.yes') }}</a>
                            <a href="{{url('app/space/12')}}"><button type="button" class="btn btn-default"
                                data-dismiss="modal">{{ __('msg.no') }}</button></a>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade" id="ShareSpaceRequest_mobile" style="z-index:9999">
            <div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
                <div class="modal-content">
                    <div class="modal-body" style="text-align:left">
                        <div style="font-size:20px;">{{ __('msg.To Share Space Request') }}</div>

                        <div class="input-group" style="margin-top:15px; width:100%;">
                            <font style="color:#999999">{{ __('msg.Share With') }}</font>
                            <br>
                            <br>
                            <a target="_blank"
                                href="https://api.whatsapp.com/send?text=Your Space Request ID is {{ session('new_sp_req_id') }} . You can See your Space request details via this link. {{ URL::to('/space/edit-request/'.session('new_sp_req_id')) }}"
                                class="pr-5"><img src={{asset('/social/whatsapp.svg')}} height="40"
                                    alt=""></a>&nbsp&nbsp
                            <a target="_blank"
                                href="https://t.me/share/url?url={{ URL::to('/space/edit-request/'.session('new_sp_req_id')) }}&text=Your Space Request ID is {{ session('new_sp_req_id') }} . You can See your Space request details via above link"><img
                                    src={{asset('/social/telegram.svg')}} height="40" alt=""></a>
                        </div>
                        <br>
                        <button type="button" class="btn btn-success" onclick="ShareSpaceRequestEmail()"
                            style="width:90px;">{{ __('msg.submit') }}</button>
                        <a href="{{url('app/space/12')}}"><button type="button" class="btn btn-default" data-dismiss="modal"
                            style="width:90px; margin-left:10px;">{{ __('msg.cancel') }}</button></a>
                    </div>
                </div>
            </div>
        </div>
	</form>
</div>
@endsection
