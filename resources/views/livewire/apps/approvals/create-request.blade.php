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
                        x-text="`Step: ${step} of 3`"></div>
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
                                <div class="text-lg font-bold text-gray-700 leading-tight">{{__('msg.observations')}}</div>
                            </div>
                        </div>

                        <div class="flex items-center md:w-64">
                            <div class="w-full bg-white rounded-full mr-2">
                                <div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white"
                                    :style="'width: '+ parseInt(step / 3 * 100) +'%'"></div>
                            </div>
                            <div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 3 * 100) +'%'"></div>
                        </div>
                    </div>
                </div>
                <!-- /Top Navigation -->
                <!-- Step Content -->
                <div class="pt-4">
                    <div x-show.transition.in="step === 1">
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3 m-10 bg-gray-50 p-10">
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="schol_given_on">{{__('msg.title')}}</label>
                                <input wire:model="title" id="schol_given_on" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('title') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="description">{{__('msg.description')}}</label>
                                <input wire:model="description" id="description" type="text"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('description') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.type')}}</label>
                                <select name="type" wire:model="type" id="type"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    <option value="">@lang('msg.Select a Option')</option>
                                    @foreach($typesColl as $type)
                                        <option value="{{$type->id}}">{{$type->type}}</option>
                                    @endforeach
                                </select> @error('type') <span class="text-danger">*{{ $message }}</span> @enderror

                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200">{{__('msg.sub type')}}</label>
                                <select name="sub_type" wire:model="sub_type" id="type"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    <option value="">@lang('msg.Select a Option')</option>
                                    @foreach($subtypes as $key => $subtype)
                                        <option value="{{$subtype->id}}">{{$subtype->sub_type}}</option>
                                    @endforeach
                                </select> @error('sub_type') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="due_date">{{__('msg.due_date')}}</label>
                                <input wire:model="due_date" id="due_date" type="date"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('due_date') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="limit_date">{{__('msg.limit_date')}}</label>
                                <input wire:model="limit_date" id="limit_date" type="date"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('limit_date') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="limit_date">{{__('msg.priority')}}</label>
                                <select name="priority" wire:model="priority" id="type"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    <option value="">@lang('msg.Select a Option')</option>
                                    <option value="Low">@lang('msg.Low')</option>
                                    <option value="Medium">@lang('msg.Medium')</option>
                                    <option value="High">@lang('msg.High')</option>

                                </select>

                                    @error('priority') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="limit_date">{{__('msg.level')}}</label>
                                <select name="level" wire:model="level" id="type"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                <option value="">@lang('msg.Select a Option')</option>
                                @foreach($levels as $key => $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                                </select>
                                @error('level') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div x-show.transition.in="step === 2">
                        <div class="flex justify-end mr-10 gap-3">
                            <button
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                                {{__('msg.Total Item Values')}} : {{$value_sum}}
                            </button>
                            <button
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-700 rounded-md hover:bg-green-600 focus:outline-none focus:bg-gray-600">
                                <i class="fas fa-file-export"></i> {{__('msg.export')}}
                            </button>
                            <button wire:click.prevent="add({{$i}})" wire:loading.attr="disabled"
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-gray-600">
                                <i class="fa fa-plus-square"></i> {{__('msg.Add Item')}}
                                <div wire:loading wire:target="add">
                                    <i class="fas fa-cog fa-spin"></i>
                                </div>
                            </button>
                        </div>

                        <div class="m-10 bg-gray-50 p-4" wire:ignore.self>
                            <div class="flex justify-between">
                                <b>{{__('msg.item')}} 1</b>
                                <div>
                                    <a style="cursor: pointer">
                                        <span style="color: green;"><i class="fas fa-print fa-lg"></i></span>
                                    </a>
                                </div>

                            </div>
                            <div class="grid grid-cols-1 gap-6 mt-2 sm:grid-cols-2" wire:ignore.self>
                                <div wire:key="name">
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.name')}}</label>
                                    <input wire:model.defer="name.0" id="name" type="text" wire:ignore
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @error('name') <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>
                                <div wire:key="value">
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.value')}}</label>
                                    <input wire:model.defer="value.0" id="value" type="number" wire:ignore
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @error('value') <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>
                                <div wire:key="details">
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.details')}}</label>
                                    <textarea wire:model.defer="details.0" id="details" wire:ignore
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </textarea>
                                    @error('details') <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>
                                <div wire:key="reference_link">
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.reference_link')}}</label>
                                    <input wire:model.defer="reference_link.0" id="value" type="text" wire:ignore
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @error('reference_link') <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>
                                <div >
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="type">{{__('msg.responsible_dept')}}</label>
                                    <select  wire:key="responsible_dept" name="responsible_dept" wire:model.defer="responsible_dept.0" id="type"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        <option value="">@lang('msg.Select a Option')</option>
                                        <option value="">CR- Department</option>
                                        <option value="">Other 2</option>
                                    </select> @error('responsible_dept') <span class="text-danger">*{{ $message
                                        }}</span> @enderror
                                </div>
                                <div  wire:ignore.self>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="type">{{__('msg.payment_method')}}</label>
                                    <select wire:key="payment_method" name="payment_method" wire:model="payment_method.0" id="type" wire.ignore
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        <option value="">@lang('msg.Select a Option')</option>
                                        <option value="Bank Transfer">{{__('msg.Bank Transfer')}}</option>
                                        <option value="APP (Paypal/QR/PIX)">@lang('msg.APP (Paypal/QR/PIX)')</option>
                                        <option value="Eletronic Invoice">{{__('msg.Eletronic Invoice')}}</option>
                                        <option value="Invoice Upload (Drive)">{{__('msg.Invoice Upload (Drive)')}}</option>
                                        <option value="Outro">{{__('msg.Outro')}}</option>
                                    </select> @error('payment_method') <span class="text-danger">*{{ $message
                                        }}</span> @enderror
                                </div>
                            </div>
                            @if(isset($payment_method[0]))
                            @if($payment_method[0]== 'Bank Transfer')
                                <div class="bg-white p-10" wire:key="payment_method1">
                                    <b class="p-10">{{__('msg.bank payment')}}</b>
                                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3 m-10 bg-gray-50 p-10">
                                        <div>
                                            <label class="text-gray-700 dark:text-gray-200"
                                                for="schol_given_on">{{__('msg.bank_id')}}</label>
                                            <input wire:model="bank_id.0" id="bank_id" type="text"
                                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            @error('bank_id') <span class="text-danger">*{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="text-gray-700 dark:text-gray-200"
                                                for="agency">{{__('msg.agency')}}</label>
                                            <input wire:model="agency.0" id="agency" type="text"
                                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            @error('agency') <span class="text-danger">*{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="text-gray-700 dark:text-gray-200"
                                                for="agency">{{__('msg.account')}}</label>
                                            <input wire:model="account.0" id="account" type="text"
                                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            @error('account') <span class="text-danger">*{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label class="text-gray-700 dark:text-gray-200"
                                                for="due_date">{{__('msg.account_owner')}}</label>
                                            <input wire:model="account_owner.0" id="due_date" type="text"
                                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            @error('account_owner') <span class="text-danger">*{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="text-gray-700 dark:text-gray-200"
                                                for="due_date">{{__('msg.cpf_cnpj')}}</label>
                                            <input wire:model="cpf_cnpj.0" id="cpf_cnpj" type="text"
                                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            @error('cpf_cnpj') <span class="text-danger">*{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($payment_method[0] == 'APP (Paypal/QR/PIX)' || $payment_method[0] == 'Eletronic Invoice')
                                <div class="bg-white p-10" wire:key="payment_method2">
                                    <b class="p-10">{{__('msg.App/Link/PIX/Electronic Invoice Payment')}}</b>
                                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 m-10 bg-gray-50 p-10">
                                        <div>
                                            <label class="text-gray-700 dark:text-gray-200"
                                                for="type">{{__('msg.app_type')}}</label>
                                            <select wire:key="app_type" name="app_type.0" wire:model="app_type" id="type" wire:ignore
                                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                <option value="">Select a Option</option>
                                                <option value="QR">QR</option>
                                                <option value="Paypal">Paypal</option>
                                                <option value="PIX">PIX</option>
                                                <option value="Electronic Invoice">{{__('msg.Eletronic Invoice')}}</option>
                                            </select> @error('app_type') <span class="text-danger">*{{ $message
                                                }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="text-gray-700 dark:text-gray-200"
                                                for="transaction_url">{{__('msg.transaction_url')}}</label>
                                            <input wire:model="transaction_url.0" id="transaction_url" type="text"
                                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            @error('transaction_url') <span class="text-danger">*{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($payment_method[0] =='Invoice Upload (Drive)')
                                <div class="bg-white p-10" wire:key="payment_method3">
                                    <b class="p-10"> {{__('msg.Invoice Upload (G Drive)')}}</b>
                                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 m-10 bg-gray-50 p-10">
                                        <div class="mb-2">
                                            <div
                                                class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                                                <div class="absolute">
                                                    <div class="flex flex-col items-center ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                        </svg>
                                                        <span class="block text-gray-400 font-normal">{{__('msg.Google Drive File Upload')}}</span> <span class="block text-gray-400 font-normal">{{__('msg.Browse files')}}</span>
                                                        <span id="" class="block text-blue-400 font-normal">
                                                            {{$invoice[0]}}</span>
                                                    </div>
                                                </div> <input type="file" id="invoice" wire:model="invoice.0" class="h-full w-full opacity-0"
                                                    name="">
                                                @error('invoice') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div>
                                            <span id="filename" class="block text-blue-400 font-normal"></span>
                                            <div wire:loading wire:target="invoice">{{__('msg.Uploading')}}...</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endif
                        </div>
                        @foreach($inputs as $key => $value)

                        <div class="m-10 bg-gray-50 p-4">
                            <div class="flex justify-between">
                                <b>Item {{$i+1}}</b>
                                <div>
                                    <a style="cursor: pointer">
                                        <span style="color: green;"><i class="fas fa-print fa-lg"></i></span>
                                    </a>
                                    <a wire:click.prevent="remove({{$key}})" wire:loading.attr="disabled"
                                        style="cursor: pointer">
                                        <span style="color: Tomato;"><i class="fas fa-times-circle fa-lg"></i></span>
                                    </a>
                                </div>

                            </div>
                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.name')}}</label>
                                    <input wire:model="name.{{ $value }}" id="name" type="text"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @error('name.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.value')}}</label>
                                    <input wire:model="value.{{ $value }}" id="value" type="number"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @error('value.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.details')}}</label>
                                    <textarea wire:model="details.{{ $value }}" id="details"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    </textarea>
                                    @error('details.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="status">{{__('msg.reference_link')}}</label>
                                    <input wire:model="reference_link.{{ $value }}" id="value" type="text"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @error('reference_link.'.$value) <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="type">{{__('msg.responsible_dept')}}</label>
                                    <select name="responsible_dept" wire:model="responsible_dept.{{ $value }}" id="type"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        <option value="">Select a Option</option>
                                        <option value="">CR- Department</option>
                                        <option value="">Other 2</option>
                                    </select> @error('responsible_dept.'.$value) <span class="text-danger">*{{ $message
                                        }}</span> @enderror
                                </div>
                                <div>
                                    <label class="text-gray-700 dark:text-gray-200"
                                        for="type">{{__('msg.payment_method')}}</label>
                                    <select name="payment_method" wire:model="payment_method.{{ $value }}"  id="type"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="APP (Paypal/QR/PIX)">APP (Paypal/QR/PIX)</option>
                                        <option value="Eletronic Invoice">Eletronic Invoice</option>
                                        <option value="Invoice Upload (Drive)">Invoice Upload (Drive)</option>
                                        <option value="Outro">Outro</option>
                                    </select> @error('payment_method.'.$value) <span class="text-danger">*{{ $message
                                        }}</span> @enderror
                                </div>
                            </div>
                            @if(isset($payment_method[$value]))
                            @switch($payment_method[$value])
                                @case('Bank Transfer')
                                <div class="bg-white p-10">
                                    <b class="p-10"> {{__('msg.bank payment')}}</b>
                                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3 m-10 bg-gray-50 p-10">
                                            <div>
                                                <label class="text-gray-700 dark:text-gray-200"
                                                    for="schol_given_on">{{__('msg.bank_id')}}</label>
                                                <input wire:model="bank_id.{{ $value }}" id="bank_id" type="text"
                                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                @error('bank_id.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <label class="text-gray-700 dark:text-gray-200"
                                                    for="agency">{{__('msg.agency')}}</label>
                                                <input wire:model="agency.{{ $value }}" id="agency" type="text"
                                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                @error('agency.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <label class="text-gray-700 dark:text-gray-200"
                                                    for="agency">{{__('msg.account')}}</label>
                                                <input wire:model="account.{{ $value }}" id="account" type="text"
                                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                @error('account.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                            </div>

                                            <div>
                                                <label class="text-gray-700 dark:text-gray-200"
                                                    for="due_date">{{__('msg.account_owner')}}</label>
                                                <input wire:model="account_owner.{{ $value }}" id="due_date" type="text"
                                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                @error('account_owner.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <label class="text-gray-700 dark:text-gray-200"
                                                    for="due_date">{{__('msg.cpf_cnpj')}}</label>
                                                <input wire:model="cpf_cnpj.{{ $value }}" id="cpf_cnpj" type="text"
                                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                @error('cpf_cnpj.'.$value) <span class="text-danger">*{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                @break
                                @case('APP (Paypal/QR/PIX)')
                                    <div class="bg-white p-10">
                                        <b class="p-10">{{__('msg.App/Link/PIX/Electronic Invoice Payment')}}</b>
                                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 m-10 bg-gray-50 p-10">
                                            <div>
                                                <label class="text-gray-700 dark:text-gray-200"
                                                    for="type">{{__('msg.app_type')}}</label>
                                                <select name="app_type.{{ $value }}" wire:model="app_type" id="type"
                                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                    <option value="">Select a Option</option>
                                                    <option value="QR">QR</option>
                                                    <option value="Paypal">Paypal</option>
                                                    <option value="PIX">PIX</option>
                                                    <option value="Electronic Invoice">Electronic Invoice</option>
                                                </select> @error('app_type') <span class="text-danger">*{{ $message
                                                    }}</span> @enderror
                                            </div>
                                            <div>
                                                <label class="text-gray-700 dark:text-gray-200"
                                                    for="transaction_url">{{__('msg.transaction_url')}}</label>
                                                <input wire:model="transaction_url.{{ $value }}" id="transaction_url" type="text"
                                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                @error('transaction_url') <span class="text-danger">*{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                @break
                                @case('Eletronic Invoice')
                                    <div class="bg-white p-10">
                                        <b class="p-10">{{__('msg.App/Link/PIX/Electronic Invoice Payment')}}</b>
                                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 m-10 bg-gray-50 p-10">
                                            <div>
                                                <label class="text-gray-700 dark:text-gray-200"
                                                    for="type">{{__('msg.app_type')}}</label>
                                                <select name="app_type.{{ $value }}" wire:model="app_type" id="type"
                                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                    <option value="">Select a Option</option>
                                                    <option value="QR">QR</option>
                                                    <option value="Paypal">Paypal</option>
                                                    <option value="PIX">PIX</option>
                                                    <option value="Electronic Invoice">Electronic Invoice</option>
                                                </select> @error('app_type') <span class="text-danger">*{{ $message
                                                    }}</span> @enderror
                                            </div>
                                            <div>
                                                <label class="text-gray-700 dark:text-gray-200"
                                                    for="transaction_url">{{__('msg.transaction_url')}}</label>
                                                <input wire:model="transaction_url.{{ $value }}" id="transaction_url" type="text"
                                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                @error('transaction_url') <span class="text-danger">*{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                @break
                                @case('Invoice Upload (Drive)')
                                    <div class="bg-white p-10">
                                        <b class="p-10"> {{__('msg.Invoice Upload (G Drive)')}}</b>
                                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 m-10 bg-gray-50 p-10">
                                            <div class="mb-2">
                                                <div
                                                    class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                                                    <div class="absolute">
                                                        <div class="flex flex-col items-center ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                            </svg>
                                                            <span class="block text-gray-400 font-normal">{{__('msg.Google Drive File Upload')}}</span> <span class="block text-gray-400 font-normal">{{__('msg.Browse files')}}</span>
                                                            <span id="" class="block text-blue-400 font-normal">
                                                                @if(isset($invoice[$value]))
                                                                {{$invoice[$value]}}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div> <input type="file" id="invoice" wire:model="invoice.{{ $value }}" class="h-full w-full opacity-0"
                                                        name="">
                                                    @error('invoice') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div>
                                                <span id="filename" class="block text-blue-400 font-normal"></span>
                                                <div wire:loading wire:target="invoice.{{ $value }}">Uploading...</div>
                                            </div>
                                        </div>
                                    </div>
                                @break
                                @default

                                @break
                                @endswitch
                            @endif
                        </div>

                        @endforeach
                    </div>
                        <div x-show.transition.in="step === 3">
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
                                    class="fas fa-step-backward"></i>{{ __('msg.Previous')}}</button>
                        </div>
                        <div class="w-1/2 text-right">
                            <button x-show="step === 1" wire:click="requestSaveDraft"   {{ $unseen_requets ? 'disabled' : ' '}}
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-700 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">{{__('msg.save as draft')}}
                                <i class="fas fa-save"></i></button>
                            @if($is_draft)
                            <button x-show="step === 2" wire:click="itemsSaveDraft"  {{ $unseen_requets ? 'disabled' : ' '}} 
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-700 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">{{__('msg.save as draft')}}
                                <i class="fas fa-save"></i></button>
                            @else
                            <button x-show="step === 2" wire:click="save"   {{ $unseen_requets ? 'disabled' : ' '}}
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-700 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">{{__('msg.save all')}}
                                <i class="fas fa-save"></i></button>
                            @endif

                            <button x-show="step < 2" @click="step++"   {{ $unseen_requets ? 'disabled' : ' '}}
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">{{(__('msg.next'))}}
                                <i class="fas fa-step-forward"></i></button>
                            <button x-show="step === 2" @click="step++"   {{ $unseen_requets ? 'disabled' : ' '}}
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">{{(__('msg.chat'))}}
                                <i class="fas fa-step-forward"></i></button>
                            <button x-show="step === 3" wire:click.prevent="finish"  {{ $unseen_requets ? 'disabled' : ' '}}
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
