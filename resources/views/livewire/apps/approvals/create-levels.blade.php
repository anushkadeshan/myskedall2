<div>
    <div x-data="app()" x-cloak>
        <div class="mx-auto px-4 py-4">
            @if (session()->has('message'))
            <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)" id="alert" class="flex py-10 items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>{{ session('message') }}</p>
            </div>
            @endif
            <div x-show.transition="step != 'complete'">
                <!-- Top Navigation -->
                <div class="border-b-2 py-2">
                    <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight"
                        x-text="`Step: ${step} of 2`"></div>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1">
                            <div x-show="step === 1">
                                <div class="text-lg font-bold text-gray-700 leading-tight">{{__('msg.Level Data')}}
                                </div>
                            </div>

                            <div x-show="step === 2">
                                <div class="text-lg font-bold text-gray-700 leading-tight">{{__('msg.approvers')}}</div>
                            </div>
                        </div>

                        <div class="flex items-center md:w-64">
                            <div class="w-full bg-white rounded-full mr-2">
                                <div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white"
                                    :style="'width: '+ parseInt(step / 2 * 100) +'%'"></div>
                            </div>
                            <div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 2 * 100) +'%'"></div>
                        </div>
                    </div>
                </div>
                <!-- /Top Navigation -->

                <!-- Step Content -->
                <div class="pt-4">
                    <div x-show.transition.in="step === 1">
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 m-10 bg-gray-50 p-10">
                            <div>
                                <label class="text-gray-700 dark:text-gray-200" for="name">{{__('msg.name')}}</label>
                                <input wire:model="name" id="name" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('name') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="description">{{__('msg.type')}}</label>
                                <input wire:model="type" id="type" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('type') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="type">{{__('msg.description')}}</label>
                                <input wire:model="description" id="description" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('description') <span class="text-danger">*{{ $message }}</span> @enderror

                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="max_value">{{__('msg.max_value')}}</label>
                                <input wire:model="max_value" id="max_value" type="number"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('max_value') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>

                        </div>
                    </div>
                    <div x-show.transition.in="step === 2">
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 m-10 bg-gray-50 p-10">
                                <div class="flex-initial">
                                    <label class="text-gray-700 dark:text-gray-200" for="query">@lang('msg.Approver') 1</label>
                                    <input wire:model="querya" wire:keydown.escape="reset"
                                        placeholder="Name/User Search" wire:keydown.tab="reset"
                                        wire:keydown.ArrowUp="decrementHighlight"
                                        wire:keydown.ArrowDown="incrementHighlight" wire:keydown.enter="selectStudent"
                                        id="query" type="text"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
                                    <div wire:loading wire:target="querya"
                                        class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        <div class="">@lang('msg.Searching')...</div>
                                    </div>
                                    @if(!empty($users))

                                    <ul class="bg-white border border-gray-100 w-full mt-2 ">
                                        @foreach($users as $i => $user)
                                        <li wire:click.prevent="selectUser1({{$user['id']}})"
                                            class="pl-8 pr-2 py-1 border-b-2 border-gray-100 relative cursor-pointer hover:bg-yellow-50 hover:text-gray-900">
                                            <b>{{$user['name']}}</b>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>

                                <div class="flex-initial ">
                                    <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.Level Role')}}</label>
                                    <select name="role1" wire:model="role1" id="type"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        <option value="">@lang('msg.Select a Option')</option>
                                        <option value="Role 1">Role 1</option>
                                        <option value="Role 2">Role 2</option>
                                    </select> @error('role1') <span class="text-danger">*{{ $message
                                        }}</span> @enderror
                                </div>


                            <div class="z-500">
                                <label class="text-gray-700 dark:text-gray-200" for="query">@lang('msg.Approver') 2</label>
                                <input wire:model="queryb" wire:keydown.escape="reset" placeholder="Name/User Search"
                                    wire:keydown.tab="reset" wire:keydown.ArrowUp="decrementHighlight"
                                    wire:keydown.ArrowDown="incrementHighlight" wire:keydown.enter="selectStudent"
                                    id="query" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
                                <div wire:loading wire:target="queryb"
                                    class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                    <div class="">@lang('msg.Searching')...</div>
                                </div>
                                @if(!empty($users2))

                                <ul class="bg-white border border-gray-100 w-full mt-2 ">
                                    @foreach($users2 as $i => $user)
                                    <li wire:click.prevent="selectUser2({{$user['id']}})"
                                        class="pl-8 pr-2 py-1 border-b-2 border-gray-100 relative cursor-pointer hover:bg-yellow-50 hover:text-gray-900">
                                        <b>{{$user['name']}}</b>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.Level Role')}}</label>
                                <select name="role2" wire:model="role2" id="type"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    <option value="">@lang('msg.Select a Option')</option>
                                    <option value="Role 1">Role 1</option>
                                    <option value="Role 2">Role 2</option>
                                </select> @error('role2') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div class="z-500">
                                <label class="text-gray-700 dark:text-gray-200" for="query">@lang('msg.Approver') 3</label>
                                <input wire:model="queryc" wire:keydown.escape="reset" placeholder="Name/User Search"
                                    wire:keydown.tab="reset" wire:keydown.ArrowUp="decrementHighlight"
                                    wire:keydown.ArrowDown="incrementHighlight" wire:keydown.enter="selectStudent"
                                    id="query" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
                                <div wire:loading wire:target="queryc"
                                    class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                    <div class="">@lang('msg.Searching')...</div>
                                </div>
                                @if(!empty($users3))

                                <ul class="bg-white border border-gray-100 w-full mt-2 ">
                                    @foreach($users3 as $i => $user)
                                    <li wire:click.prevent="selectUser3({{$user['id']}})"
                                        class="pl-8 pr-2 py-1 border-b-2 border-gray-100 relative cursor-pointer hover:bg-yellow-50 hover:text-gray-900">
                                        <b>{{$user['name']}}</b>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.Level Role')}}</label>
                                <select name="role3" wire:model="role3" id="type"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    <option value="">@lang('msg.Select a Option')</option>
                                    <option value="Role 1">Role 1</option>
                                    <option value="Role 2">Role 2</option>
                                </select> @error('role3') <span class="text-danger">*{{ $message
                                    }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <!-- / Step Content -->
                </div>
            </div>

            <!-- Bottom Navigation -->
            <div class=" mx-auto px-4 py-4" x-show="step != 'complete'">

                <div class="mx-auto px-4">
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <button x-show="step > 1" @click="step--"
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-gray-600"><i
                                    class="fas fa-step-backward"></i> @lang('msg.Previous')</button>
                        </div>
                        <div class="w-1/2 text-right">
                            <button x-show="step < 2" @click="step++"
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">{{(__('msg.next'))}}
                                <i class="fas fa-step-forward"></i></button>

                            <button x-show="step === 2" wire:click.prevent="finish"
                                class="text-white bg-green-700 hover:bg-green-600 font-bold py-2 px-4 rounded inline-flex items-center">
                                {{__('msg.finish')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->
        </div>

        <script>
            function showname() {
                var name = document.getElementById('invoice_file');
                console.log(name.files.item(0).name);
                $("#filename").html(name.files.item(0).name);
                //alert('Selected file: ' + name.files.item(0).name);
                //alert('Selected file: ' + name.files.item(0).size);
                //alert('Selected file: ' + name.files.item(0).type);
            }
        </script>

    </div>
