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

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1">
                            <div x-show="step === 1">
                                <div class="text-lg font-bold text-gray-700 leading-tight">{{__('msg.Tutorials')}}
                                </div>
                            </div>

                            <div x-show="step === 2">
                                <div class="text-lg font-bold text-gray-700 leading-tight">{{__('msg.Tech Support')}}</div>
                            </div>

                        </div>


                    </div>
                </div>
                <!-- /Top Navigation -->

                <!-- Step Content -->
                <div class="pt-4">
                    <div x-show.transition.in="step === 1">
                        App Tutorial - How to Use
                    </div>
                    <div x-show.transition.in="step === 2">
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 m-10 bg-gray-50 p-10">
                            <div class="flex-initial">
                                <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.Support')}}</label>
                                <select name="role1" wire:model="support" id="type"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    <option value="">Select a Option</option>
                                    <option value="Error Related to ">Error Related to </option>
                                    <option value="Error Related to ">Error Related to </option>
                                </select> @error('support') <span class="text-danger">*{{ $message
                                    }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1 m-10 bg-gray-50 p-10">
                            <div class="flex-initial">
                                <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.Message')}}</label>
                                <textarea name="role1" wire:model="message" id="type"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                </textarea> @error('message') <span class="text-danger">*{{ $message
                                    }}</span> @enderror
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
                        <div class="w-1/2 text-right">
                            <button x-show="step < 2" @click="step++"
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">{{(__('msg.next'))}}
                                <i class="fas fa-step-forward"></i></button>
                            <button x-show="step === 2" wire:click.prevent="send"
                                class="text-white bg-green-700 hover:bg-green-600 font-bold py-2 px-4 rounded inline-flex items-center">
                                {{__('msg.send')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->
        </div>
    </div>
