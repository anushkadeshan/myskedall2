<div>
    <div x-data="app()" x-cloak>
        <div class="mx-auto px-4 py-4">
            @if (session()->has('message'))
            <div id="alert" class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
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
                        x-text="`Step: ${step} of 4`"></div>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1">
                            <div x-show="step === 1">
                                <div class="text-lg font-bold text-gray-700 leading-tight">{{__('msg.Request Data')}}
                                </div>
                            </div>

                            <div x-show="step === 2">
                                <div class="text-lg font-bold text-gray-700 leading-tight">{{__('msg.items')}}</div>
                            </div>

                            <div x-show="step === 3">
                                <div class="text-lg font-bold text-gray-700 leading-tight">{{__('msg.financial')}}</div>
                            </div>

                            <div x-show="step === 4">
                                <div class="text-lg font-bold text-gray-700 leading-tight">{{__('msg.observations')}}</div>
                            </div>
                        </div>

                        <div class="flex items-center md:w-64">
                            <div class="w-full bg-white rounded-full mr-2">
                                <div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white"
                                    :style="'width: '+ parseInt(step / 4 * 100) +'%'"></div>
                            </div>
                            <div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 4 * 100) +'%'"></div>
                        </div>
                    </div>
                </div>
                <!-- /Top Navigation -->

                <!-- Step Content -->
                <div class="pt-4">
                    <div x-show.transition.in="step === 1">
                        <div class="flex m-10 bg-gray-50 p-2 justify-end">
                            <p>{{$requester}} </p>
                            <span style="color: white;" class="bg-blue px-2 ml-2">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3 m-10 bg-gray-50 p-10">
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="title">{{__('msg.title')}}</label>
                                <input disabled wire:model="title" id="schol_given_on" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('title') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="description">{{__('msg.description')}}</label>
                                <input disabled wire:model="description" id="description" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('description') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.type')}}</label>
                                <input disabled wire:model="type" id="description" type="text"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"> @error('type') <span class="text-danger">*{{ $message }}</span> @enderror

                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200">{{__('msg.sub type')}}</label>
                                <input disabled wire:model="sub_type" id="sub_type" type="text"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                 @error('sub_type') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="due_date">{{__('msg.due_date')}}</label>
                                <input disabled wire:model="due_date" id="due_date" type="date"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('due_date') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="limit_date">{{__('msg.limit_date')}}</label>
                                <input disabled wire:model="limit_date" id="limit_date" type="date"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('limit_date') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="limit_date">{{__('msg.priority')}}</label>
                                <input disabled wire:model="priority" id="priority" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('priority') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="limit_date">{{__('msg.level')}}</label>
                                <select disabled name="level" wire:model="level" id="type"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                <option value="">Select a Option</option>
                                @foreach($levels as $key => $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                                </select>
                                @error('level') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="status">{{__('msg.status')}}</label>
                                <input disabled wire:model="status" id="status" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('status') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="m-10 bg-gray-50 p-10">
                            <label class="text-gray-700 dark:text-gray-200"
                                for="status">{{__('msg.approvers')}}</label>
                            <textarea disabled  id="status" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">@foreach($approvers as $a){{$a->name}} [{{$a->phone}}],
                            @endforeach</textarea>
                        </div>
                    </div>
                    <div x-show.transition.in="step === 2">
                        @hasanyrole('Secretary|User')
                        <div class="text-right mr-10 p-4">
                            <button data-toggle="modal" data-target="#exampleModal"
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-gray-600">{{(__('msg.Add New'))}}
                                <i class="fas fa-plus"></i></button>

                        </div>
                        @endhasanyrole
                        @foreach($inputs as $key => $value)
                        <div class="m-10 bg-gray-50 p-4">
                            <div class="flex justify-between">
                                <b>Item {{$key+1}}</b>
                                @role('Super Admin|Module Admin|Local Admin')
                                <div>
                                    <a style="cursor: pointer" wire:click.prevent="approve({{$value->id}})">
                                        <span  style="color: green;"><i class="fas fa-check-circle fa-lg"></i></span>
                                    </a>
                                    <a wire:click.prevent="change({{$value->id}})" wire:loading.attr="disabled"
                                        style="cursor: pointer">
                                        <span style="color: yellow;"><i class="fas fa-minus-circle fa-lg"></i></span>
                                    </a>
                                    <a wire:click.prevent="repprove({{$value->id}})" wire:loading.attr="disabled"
                                        style="cursor: pointer">
                                        <span style="color: Tomato;"><i class="fas fa-times-circle fa-lg"></i></span>
                                    </a>

                                </div>
                                @endrole
                            </div>
                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.name')}}</label>
                                    <input disabled id="name" type="text" value="{{$value->name}}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @error('name.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.details')}}</label>
                                    <textarea disabled id="details"
                                        class="block w-full  px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">{{$value->details}}
                                    </textarea>
                                    @error('details.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.reference_link')}}</label>
                                    <input disabled  id="value" type="text" value="{{$value->reference_link}}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @error('reference_link.'.$value) <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="type">{{__('msg.responsible_dept')}}</label>
                                    <input disabled name="responsible_dept"  id="type" value="{{$value->responsible_dept}}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                     @error('responsible_dept.'.$value) <span class="text-danger">*{{ $message
                                        }}</span> @enderror
                                </div>
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="type">{{__('msg.payment_method')}}</label>
                                    <input disabled name="payment_method" id="type" value="{{$value->payment_method}}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        @error('payment_method.'.$value) <span class="text-danger">*{{ $message
                                        }}</span> @enderror
                                </div>
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.value')}}</label>
                                    <input disabled id="value" type="text" value="{{$value->value}}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @error('value.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>
                                @role('Super Admin|Module Admin|Local Admin')
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.approved_value')}} </label>
                                    <input id="approved_value" type="text" wire:key="{{ $loop->index }}" wire:model="approved_value.{{$value->id}}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                     <span class="text-primary">@if($value->approved_value)  {{$value->approved_value}} @endif</span>
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.approve_observations')}} </label>
                                    <input id="approve_observations"  type="text" wire:key="{{ $loop->index }}" wire:model="approver_oberservation.{{$value->id}}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        <span class="text-primary">@if($value->approver_oberservation)  {{$value->approver_oberservation}} @endif</span>
                                </div>
                                @else
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.approved_value')}} </label>
                                    <input disabled id="approved_value" type="text" wire:key="{{ $loop->index }}" value="{{$value->approved_value}}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.approve_observations')}} </label>
                                    <input disabled id="approve_observations"  type="text" wire:key="{{ $loop->index }}" value="{{$value->approver_oberservation}}"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                </div>
                                @endhasanyrole
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div x-show.transition.in="step === 3">
                        @hasanyrole('Secretary|User')
                        <div class="text-right mr-10 p-4">
                            <button data-toggle="modal" data-target="#exampleModal"
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-gray-600">{{(__('msg.Add New'))}}
                                <i class="fas fa-plus"></i></button>

                        </div>
                        @endhasanyrole
                        <div class="m-10 bg-gray-50 p-10">
                            <label class="text-gray-700 dark:text-gray-200"
                                for="status">{{__('msg.Approved')}}</label>
                            <textarea disabled  id="status" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">@foreach($approved_items as $a){{$a->name}} ,
                            @endforeach</textarea>
                        </div>
                        <div class="m-10 bg-gray-50 p-10">
                            <label class="text-gray-700 dark:text-gray-200"
                                for="status">{{__('msg.Repproved')}}</label>
                            <textarea disabled  id="status" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">@foreach($changed_items as $a){{$a->name}} ,
                            @endforeach</textarea>
                        </div>
                        <div class="m-10 bg-gray-50 p-10">
                            <label class="text-gray-700 dark:text-gray-200"
                                for="status">{{__('msg.Changed')}}</label>
                            <textarea disabled  id="status" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">@foreach($repproved_items as $a){{$a->name}} ,
                            @endforeach</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-4 sm:grid-cols-2 m-10 bg-gray-50 p-10">
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="title">{{__('msg.requested value')}}</label>
                                <input disabled wire:model="sum_requested_value" id="schol_given_on" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('title') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="title">{{__('msg.approved value')}}</label>
                                <input disabled wire:model="sum_approved_value" id="schol_given_on" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('title') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                        <div x-show.transition.in="step === 4">
                            <div class="flex flex-col bg-white">
                                <div id="chat"  class="flex flex-col mt-2 flex-col-reverse overflow-y-scroll space-y-3 mb-20 pb-3 ">
                                @foreach($chats as $chat)
                                    <div class="flex  justify-between">
                                        <div class="mb-4">

                                            <span class="other break-all mt-2  ml-5 rounded-bl-none float-none bg-gray-300  rounded-2xl p-2">
                                                {{$chat['message']}}
                                            </span>

                                            <br>
                                            <span class="ml-5 mt-2 text-sm text-gray-500">
                                                {{$chat['user']['name']}} | {{$chat['date']}} | {{$chat['time']}}
                                            </span>

                                        </div>
                                        <div class="grid-cols-2 gap-10 mr-10">
                                            <span class="float-left" style="cursor: pointer;">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                </svg>
                                            </span>
                                            <span class="float-right" style="cursor: pointer;">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                                </svg>
                                            </span>

                                        </div>
                                    </div>
                                @endforeach
                                </div>
                                <div class="flex flex-row  items-center  bottom-0 my-2 w-full">

                                    <div class="w-full">
                                      <input wire:model="message"
                                        type="text"
                                        id="message"
                                        class="border rounded-2xl border-transparent w-full focus:outline-none text-sm pl-2 h-10 flex items-center"
                                        placeholder=" {{(__('msg.Type your message'))}}...."
                                      />
                                    </div>

                                  <div class="ml-3 mr-2">
                                      <button wire:click="chat"
                                       id="self"
                                      class="flex items-center justify-center h-10 w-10 mr-2 rounded-full bg-blue-400 hover:bg-blue-500 text-indigo-800 text-white focus:outline-none"
                                    >
                                      <svg
                                        class="w-5 h-5 transform rotate-90 -mr-px"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                      >
                                        <path
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                        ></path>
                                      </svg>
                                    </button>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                    <div wire:ignore>
                                        <label class="text-gray-700 dark:text-gray-200"
                                            for="status">{{__('msg.name')}}</label>
                                        <input wire:model="new_name" id="name" type="text"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        @error('new_name') <span class="text-danger">*{{ $message }}</span> @enderror
                                    </div>
                                    <div wire:ignore>
                                        <label class="text-gray-700 dark:text-gray-200"
                                            for="status">{{__('msg.value')}}</label>
                                        <input wire:model="new_value" id="value" type="number"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        @error('new_value') <span class="text-danger">*{{ $message }}</span> @enderror
                                    </div>
                                    <div wire:ignore>
                                        <label class="text-gray-700 dark:text-gray-200"
                                            for="status">{{__('msg.details')}}</label>
                                        <textarea wire:model="new_details" id="details"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        </textarea>
                                        @error('new_details') <span class="text-danger">*{{ $message }}</span> @enderror
                                    </div>
                                    <div wire:ignore>
                                        <label class="text-gray-700 dark:text-gray-200"
                                            for="status">{{__('msg.reference_link')}}</label>
                                        <input wire:model="new_reference_link" id="value" type="text"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        @error('new_reference_link') <span class="text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div wire:ignore>
                                        <label class="text-gray-700 dark:text-gray-200"
                                            for="type">{{__('msg.responsible_dept')}}</label>
                                        <select name="new_responsible_dept" wire:model="new_responsible_dept" id="type"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            <option value="">Select a Option</option>
                                            <option value="">CR- Department</option>
                                            <option value="">Other 2</option>
                                        </select> @error('new_responsible_dept') <span class="text-danger">*{{ $message
                                            }}</span> @enderror
                                    </div>
                                    <div wire:ignore>
                                        <label class="text-gray-700 dark:text-gray-200"
                                            for="type">{{__('msg.payment_method')}}</label>
                                        <select name="payment_method" wire:model="new_payment_method" id="type"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            <option value="">Select a Option</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="APP (Paypal/QR/PIX)">APP (Paypal/QR/PIX)</option>
                                            <option value="Eletronic Invoice">Eletronic Invoice</option>
                                            <option value="Invoice Upload (Drive)">Invoice Upload (Drive)</option>
                                            <option value="Outro">Outro</option>
                                        </select> @error('new_payment_method') <span class="text-danger">*{{ $message
                                            }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" wire:click.prevent="AddNewItem" class="btn btn-primary">Save changes</button>
                            </div>
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
                                    class="fas fa-step-backward"></i> Previous</button>
                        </div>
                        @role('Super Admin|Module Admin|Local Admin')
                        <div class="w-1/2">
                            @if($current_status==1)
                            <button wire:click.prevent="Approved" class="bg-green w-40 text-white font-semibold hover:text-white-900 py-2 px-4 border border-green-600 hover:border-transparent rounded">
                                {{__('msg.Approved')}}
                            </button>
                            @else
                            <button wire:click.prevent="Approved" class="bg-transparent w-40 text-green-600 font-semibold hover:text-green-900 py-2 px-4 border border-green-600 hover:border-transparent rounded">
                                {{__('msg.Approved')}}
                            </button>
                            @endif
                        </div>
                        <div class="w-1/2">
                        @if($current_status==2)
                            <button wire:click.prevent="Repproved" class="bg-purple w-40 text-white font-semibold hover:text-white-900 py-2 px-4 border border-green-600 hover:border-transparent rounded">
                                {{__('msg.Repproved')}}
                            </button>
                            @else
                            <button wire:click.prevent="Repproved" class="bg-transparent w-40 text-purple-600 font-semibold hover:text-green-900 py-2 px-4 border border-green-600 hover:border-transparent rounded">
                                {{__('msg.Repproved')}}
                            </button>
                        @endif
                        </div>
                        <div class="w-1/2">
                        @if($current_status==4)
                            <button wire:click.prevent="Return" class="bg-pink w-40 text-white font-semibold hover:text-white-900 py-2 px-4 border border-green-600 hover:border-transparent rounded">
                                {{__('msg.Return')}}
                            </button>
                            @else
                            <button wire:click.prevent="Return" class="bg-transparent w-40 text-pink-600 font-semibold hover:text-green-900 py-2 px-4 border border-green-600 hover:border-transparent rounded">
                                {{__('msg.Return')}}
                            </button>
                        @endif
                        </div>
                        <div class="w-1/2">
                        @if($current_status==3)
                            <button wire:click.prevent="Consulting" class="bg-blue w-40 text-white font-semibold hover:text-white-900 py-2 px-4 border border-green-600 hover:border-transparent rounded">
                                {{__('msg.Consulting')}}
                            </button>
                            @else
                            <button wire:click.prevent="Consulting" class="bg-transparent w-40 text-blue-600 font-semibold hover:text-green-900 py-2 px-4 border border-green-600 hover:border-transparent rounded">
                                {{__('msg.Consulting')}}
                            </button>
                        @endif
                        </div>
                        @endrole
                        <div class="w-1/2 text-right">
                            <button x-show="step < 4" @click="step++"
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">{{(__('msg.next'))}}
                                <i class="fas fa-step-forward"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
            <script>
                window.livewire.on('postUpdated', () => {
                    $('#exampleModal').modal('hide');
                })
                </script>

    </div>
