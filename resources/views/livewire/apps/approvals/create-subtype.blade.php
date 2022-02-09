<div>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <font class="text-xl bold">{{__('msg.Create Sub Types')}}</font>
            <button type="button" class="btn-bsclose" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if(session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" id="alert" class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p>{{ session('message') }}</p>
            </div>
            @endif
            <section class="mx-auto bg-white">
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
                    <div class="rounded-md shadow-md dark:bg-blue-800 p-8">
                        <div class="mb-4">
                            <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.Select Type')}}</label>
                            <select wire:model="type_id" id="type" type="text"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                <option value="">Select Option</option>
                                @foreach($types as $key => $type)
                                <option value="{{$type->id}}">{{$type->type}}</option>
                                @endforeach
                            </select>
                            @error('type_id') <span class="text-danger">*{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4 mt-4">
                            <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.sub type')}}</label>
                            <input wire:model="sub_type" id="sub_type" type="text"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                            @error('sub_type') <span class="text-danger">*{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.description')}}</label>
                            <input wire:model="description_sub" id="type" type="text"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                            @error('description_sub') <span class="text-danger">*{{ $message }}</span> @enderror
                        </div>
                        <div class="flex justify-start gap-1">
                            @if (session()->has('message1'))
                            <div  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert-box2 float-right">
                                <span class="bg-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-green-500 h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                      </svg>
                                </span>

                            </div>
                            @endif
                          </div>

                    </div>
                </div>
            </section>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('msg.close')}}</button>
            <button type="button" wire:click="saveSub()" class="btn btn-primary">{{__('msg.Save changes')}}</button>
        </div>
        </div>
    </div>

</div>
<script>
    setTimeout(function() {
        $('.alert-box').remove();
    }, 5000);

    setTimeout(function() {
        $('.alert-box2').remove();
    }, 5000);
</script>

