<!-- Material Field -->
<div class="row">
    <br>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('professional', 'Professional:') !!}
            <p>{{ $function->professional }}</p>
        </div>

        <!-- Quantity Field -->
        <div class="form-group">
            {!! Form::label('quantity', 'Quantity:') !!}
            <p>{{ $function->quantity }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <h5>Allocated Locations</h5> 
        @php
            $locations = DB::table('location_functions')
            ->join('space_location','space_location.id','=','location_functions.location_id')
            ->select('location_functions.*','space_location.name as name')
            ->where('location_functions.function_id',$function->id)
            ->get();
        @endphp

        @foreach($locations as $location)
            <li class="text-muted">{{$location->name}}({{$location->quantity}})</li>
        @endforeach
    </div>
</div>



