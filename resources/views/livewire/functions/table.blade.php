<div>
    @if (session()->has('message'))
    <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)" id="alert" class="flex py-10 items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path
                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
        </svg>
        <p>{{ session('message') }}</p>
    </div>
    @endif
    <div class="table-responsive">
        <table class="table" id="functions-table">
            <thead>
                <tr>
                    <th>@lang('msg.Professional')</th>
                    <th>@lang('msg.Quantity')</th>
                    <th>@lang('msg.Allocated')</th>
                    <th>@lang('msg.Available')</th>
                    <th>@lang('msg.Group')</th>
                    <th colspan="3">@lang('msg.Action')</th>
                </tr>
            </thead>
            <tbody>
            @foreach($functions as $function)
                <tr>
                    <td>{{ $function->professional }}</td>
                    <td>{{ $function->quantity }}</td>
                    <td>{{ $function->allocated }}</td>
                    <td>{{ $function->quantity - $function->allocated }}</td>
                    <td>{{ $function->group->name }}</td>
                    <td>
                        {!! Form::open(['route' => ['functions.destroy', $function->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a wire:click.prevent="view({{$function->id}})" class='btn btn-warning btn-xs'><i class="fa fa-eye"></i></a>
                            <a wire:click.prevent="edit({{$function->id}})" class='btn btn-success btn-xs'><i class="fa fa-edit"></i></a>
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModalCenterEdit" tabindex="-1" aria-labelledby="exampleModalCenter"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('msg.update') </h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
           
            <div class="modal-body">
                <!-- Material Field -->
                <div class="form-group col-sm-12 mb-4">
                    <label for="">@lang('msg.Professional')</label>
                    <input type="text" name="" id="" class="form-control" wire:model.defer="professional">
                    @error('material') <span class="text-danger">*{{ $message }}</span> @enderror
                </div>

                <!-- Quantity Field -->
                <div class="form-group col-sm-12 mb-4">
                    <label for="">@lang('msg.Quantity')</label>
                    <input type="number" name="" id="" class="form-control" wire:model.defer="quantity">
                    @error('quantity') <span class="text-danger">*{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-sm-12 mb-4">
                    <label for="">@lang('msg.Group')</label>
                    <select class="form-control" name="group_id" wire:model.defer="group_id" required>
                        <option value="">Select a Group</option>
                        @foreach($groups as $group)
                        <option 
                            value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
                    @error('group_id') <span class="text-danger">*{{ $message }}</span> @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-bs-original-title=""
                    title="">Close</button>
                <button class="btn btn-primary" type="button" data-bs-original-title="" wire:click.prevent="update" title="">@lang('msg.update')</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenterView" tabindex="-1" aria-labelledby="exampleModalCenter"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('msg.view') </h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
           
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Material Field -->
                        <div class="form-group col-sm-12 mb-4">
                            <label for="">@lang('msg.Professional')</label>
                            <input type="text" name="" id="" class="form-control" wire:model.defer="professional">
                            @error('material') <span class="text-danger">*{{ $message }}</span> @enderror
                        </div>

                        <!-- Quantity Field -->
                        <div class="form-group col-sm-12 mb-4">
                            <label for="">@lang('msg.Quantity')</label>
                            <input type="number" name="" id="" class="form-control" wire:model.defer="quantity">
                            @error('quantity') <span class="text-danger">*{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-sm-12 mb-4">
                            <label for="">@lang('msg.Group')</label>
                            <select class="form-control" name="group_id" wire:model.defer="group_id" required>
                                <option value="">Select a Group</option>
                                @foreach($groups as $group)
                                <option 
                                    value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                            @error('group_id') <span class="text-danger">*{{ $message }}</span> @enderror
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
               

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-bs-original-title=""
                    title="">@lang('msg.close')</button>
            </div>
        </div>
    </div>
</div>
</div>
