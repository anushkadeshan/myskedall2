
<div class="row">
    <br>
    <div class="col-md-6">
        <!-- Material Field -->
        <div class="form-group">
            {!! Form::label('material', trans('msg.material')) !!}
            <p class="text-muted">{{ $material->material }}</p>
        </div>

        <!-- Quantity Field -->
        <div class="form-group">
            {!! Form::label('quantity',trans('msg.Quantity:')) !!}
            <p class="text-muted">{{ $material->quantity }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <h5>Allocated Locations</h5> 
        @php
            $locations = DB::table('location_materials')
            ->join('space_location','space_location.id','=','location_materials.location_id')
            ->select('location_materials.*','space_location.name as name')
            ->where('location_materials.material_id',$material->id)
            ->get();
           
        @endphp

        @foreach($locations as $location)
            <li class="text-muted">{{$location->name}} ({{$location->quantity}})</li>
        @endforeach
    </div>
</div>

