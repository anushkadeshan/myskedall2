<div>
    <div class="mx-auto px-4 py-4">
        <div class="max-w-9xl mx-auto py-6 sm:px-2 lg:px-4">
            <section class="content-header">
                <div class="m-4">
                    <font class="text-xl bold">Create Request Types</font>
                </div>
            </section>
            <div class="content px-3">
                <section class="mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div class=" rounded-md shadow-md dark:bg-blue-800 p-8">
                            <span class="text-blue-600 text-xl font-medium pb-4">{{__('msg.types')}}</span>
                            <div class="mb-4 mt-4">
                                <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.type')}}</label>
                                <input wire:model="type" id="type" type="text"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('type') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.description')}}</label>
                                <input wire:model="description" id="type" type="text"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('description') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div class="flex justify-start gap-1">
                                <button wire:click="save"
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-700 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">{{__('msg.save type')}}
                                <i class="fas fa-save"></i></button>
                                @if (session()->has('message'))
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
                        <div class="rounded-md shadow-md dark:bg-blue-800 p-8">
                            <span class="text-blue-600 text-xl font-medium pb-4">{{__('msg.Sub Types')}}</span>
                            <div class="mb-4 mt-4">
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
                                <button wire:click="saveSub"
                                class="float-left px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-700 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">{{__('msg.save sub type')}}
                                <i class="fas fa-save"></i></button>
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
