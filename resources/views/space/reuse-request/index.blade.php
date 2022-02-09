@extends('space/template')
@section('content')
<div class="row">
    @if($data->is_draft==1)
    <div class="col-md-12 text-right">
        <span class="text-danger" style="padding-right: 20px"><b>Pending</b></span>
    </div>
    @endif
	<form action="" method="post">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.events') }} </label><strong style="color:red">{{$errors->first('events')}}</strong>
					<input type="text" class="form-control" name="events" value="{{$data->events}}">
				</div>
			</div>
			<div class="col-md-6"> 
				<div class="form-group">
					<label>{{ __('msg.No of people') }} </label><strong style="color:red">{{$errors->first('total_people')}}</strong>
					<input type="text" class="form-control" name="total_people" value="{{$data->total_people}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.reason') }} </label><strong style="color:red">{{$errors->first('reason')}} </strong>
					<!--input type="text" class="form-control" name="reason" value="{{$data->reason}}"-->
					<select class="form-control" name="reason">
						<option value="">{{ __('msg.Select Reason') }}</option>
						@foreach($reasonList as $reason)
							<option value="{{$reason->reason}}" @if($data->reason==$reason->reason) selected @endif>{{$reason->reason}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.price') }} </label><strong style="color:red">{{$errors->first('price')}}</strong>
					<input type="text" class="form-control" id="exact-price" name="price" value="{{$data->price}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Initial Date') }} </label><strong style="color:red">{{$errors->first('initial_date')}}</strong>
					<input type="text" id="datepicker1" autocomplete="off" class="form-control" name="initial_date" value="{{date('Y-m-d',strtotime($data->initial_date))}}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Initial Time') }} </label><strong style="color:red">{{$errors->first('initial_time')}}</strong>
					<input type="text" placeholder="24 Hours" autocomplete="off" class="form-control" name="initial_time" value="{{date('H:i',strtotime($data->initial_time))}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Final Date') }} </label><strong style="color:red">{{$errors->first('final_date')}}</strong>
					<input type="text" id="datepicker2" autocomplete="off" class="form-control" name="final_date" value="{{date('Y-m-d',strtotime($data->final_date))}}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Final Time') }} </label><strong style="color:red">{{$errors->first('final_time')}}</strong>
					<input type="text" placeholder="24 Hours" autocomplete="off" class="form-control" name="final_time" value="{{date('H:i',strtotime($data->final_time))}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.location') }} </label><strong style="color:red">{{$errors->first('location')}}</strong>
					<!--textarea class="form-control" name="location">{{$data->location}}</textarea-->
					<select class="form-control" onchange="CheckPriceByLocation()" id="space-location" name="location">
						<option value="">{{ __('msg.Select Location') }}</option>
						@foreach($locationList as $location)
					   	<option value="{{$location->id}}" @if($data->location==$location->id) selected @endif >{{$location->address}}
					    </option>
                    	@endforeach
					</select>
					<input type="hidden"  id="locationjson" name="locationjson" value="{{$locationjson}}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Space Manager') }} </label><strong style="color:red">{{$errors->first('space_manager')}}</strong>
                    <select class="form-control" name="space_manager">

                    <option value="">{{ __('msg.Select Manager') }}</option>
					@foreach($managers as $manager)
					    <option value="{{$manager->name}}" @if($data->space_manager==$manager->name) selected @endif >{{$manager->name}}
					    </option>
                    @endforeach
                    </select>
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
					<input type="hidden" id="fill-click-value" name="agreement" class="form-control">
					<input type="button" onclick="CheckRuleClick()" id="rules-of-use" class="form-control btn btn-warning" value="{{ __('msg.Rules For Use') }}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-12">
				<input type="button" onclick="RequestSpace()" style="color:green;font-weight: bold;" value="{{ __('msg.Request SPACE') }}">
				<button onclick="ShareSpaceRequest({{ $data->id }})" type="button" style="color:green;font-weight: bold;"><span class="glyphicon glyphicon-share" aria-hidden="true" style="font-size:15px;"></span> {{ __('msg.share request') }}</button>

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
				<button type="submit" class="btn btn-primary float-left">{{ __('msg.submit') }}</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ __('msg.close') }}</button>
				</div>
			</div>

			</div>
		</div>
    </form>

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
                        <a target="_blank"
                            href="https://api.whatsapp.com/send?text=Your Space Request ID is {{ session('new_sp_req_id') }}. You can See your Space request details via this link. {{ URL::to('/space/edit-request/'.$data->id) }}"
                            class="pr-5"><img src={{asset('/social/whatsapp.svg')}} height="40" alt=""></a>&nbsp&nbsp
                        <a target="_blank"
                            href="https://t.me/share/url?url={{ URL::to('/space/edit-request/'.$data->id) }}&text=Your Space Request ID is {{ session('new_sp_req_id') }}. You can See your Space request details via above link"><img

                                src={{asset('/social/telegram.svg')}} height="40" alt=""></a>
                    </div>
                    <br>
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
                            class="pr-5"><img src={{asset('/social/whatsapp.svg')}} height="40" alt=""></a>&nbsp&nbsp
                        <a target="_blank"
                            href="https://t.me/share/url?url={{ URL::to('/space/edit-request/'.session('new_sp_req_id')) }}&text=Your Space Request ID is {{ session('new_sp_req_id') }} . You can See your Space request details via above link"><img
                                src={{asset('/social/telegram.svg')}} height="40" alt=""></a>
                    </div>
                    <br>
                    <button type="button" class="btn btn-success" onclick="ShareSpaceRequestEmail()"
                        style="width:90px;">{{ __('msg.submit') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="width:90px; margin-left:10px;">{{ __('msg.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
