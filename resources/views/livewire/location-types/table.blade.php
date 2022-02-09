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
    <div class="table table-responsive">
        <table id="showExternalLocationList" class="table">
            <thead>
                <th>{{ __('msg.Id') }}</th>
                <th>{{ __('msg.title') }}</th>
                <th>{{ __('msg.edit') }}</th>
            </thead>
            <tbody>
                @foreach($locations as $l)
                <tr>
                    <td>{{$l->id}}</td>
                    <td>{{$l->location_type}}</td>
                    <td>
                        <a wire:click.prevent="edit({{$l->id}})" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                        <a style="margin-left: 10px;"  type="button" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>
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
                <div class="form-group col-sm-12 mb-4">
                    <label for="">{{ __('msg.Location Type') }}</label>
                    <input type="text" name="" class="form-control" id="" wire:model.defer="location_type">
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
</div>
