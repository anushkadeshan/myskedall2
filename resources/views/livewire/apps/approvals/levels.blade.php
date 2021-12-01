<div>
    <div class="m-4 p-4">
        <div class="flex justify-center">
            <div class="relative w-3/4 text-lg bg-transparent text-gray-800">
                <div class="flex items-center border-b border-b-2 border-teal-500 py-2">
                    <input class=" bg-transparent border-none mr-3 px-2 leading-tight focus:outline-none" type="text"
                        wire:model="search" wire:keydown.escape="reset" placeholder="Name/User Search"
                        wire:keydown.tab="reset" wire:keydown.ArrowUp="decrementHighlight"
                        wire:keydown.ArrowDown="incrementHighlight" placeholder="Search Levels">
                    <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                            xml:space="preserve" width="512px" height="512px">
                            <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('message'))
    <div class="ml-6 pl-6 mr-6 pr-6 mb-2">
        <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)" id="alert"
            class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ session('message') }}</p>
        </div>
    </div>
    @endif
    <div class="grid grid-cols-2 gap-4 px-16">
        @foreach($levels as $level)
        <div class="grid grid-cols-2 gap-4 bg-gray-100 p-6 rounded-md">
            <span class="col-span-2">
                Level ID: {{$level['id']}}
                <span class="float-right">
                    <span class="float-right" wire:click="deleteLevel({{$level['id']}})">
                        <svg xmlns="http://www.w3.org/2000/svg" style="cursor:pointer" class="h-5 w-5"
                            viewBox="0 0 20 20" fill="red">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                    <svg wire:click="edit({{$level['id']}})" xmlns="http://www.w3.org/2000/svg" style="cursor:pointer"
                        class="h-5 w-5" viewBox="0 0 20 20" fill="green">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                        <path fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                            clip-rule="evenodd" />
                    </svg>
                </span>

            </span>
            <div class="grid grid-flow-row auto-rows-max gap-4">
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="name">{{__('msg.name')}}</label>
                    <input value="{{$level['name']}}" id="name" type="text"
                        class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('name') <span class="text-danger">*{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="description">{{__('msg.type')}}</label>
                    <input value="{{$level['type']}}" id="type" type="text"
                        class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('type') <span class="text-danger">*{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="type">{{__('msg.description')}}</label>
                    <input value="{{$level['description']}}" id="description" type="text"
                        class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('description') <span class="text-danger">*{{ $message }}</span> @enderror

                </div>
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="max_value">{{__('msg.max_value')}}</label>
                    <input value="{{$level['max_value']}}" id="max_value" type="number"
                        class="block w-full px-4 py-2  text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('max_value') <span class="text-danger">*{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                Approvers
                <div class="border-2 border-gray-500 rounded-sm p-2">
                    <div class="grid grid-cols-2">
                        @foreach($level['approvers'] as $app)
                        <div class="flex mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-initial" viewBox="0 0 20 20"
                                fill="blue">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="flex-initial">{{$app['name']}}</span>
                        </div>

                        <div class="grid justify-items-end mb-2">
                            <span class="flex">
                                <div class="flex-initial">
                                    {{$app['pivot']['level_role']}}
                                </div>
                                <div class="flex-initial pl-2">
                                    <a wire:click="deleteApprover({{$app['pivot']['id']}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="red">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </span>
                        </div>
                        @endforeach
                    </div>


                </div>
            </div>

        </div>
        @endforeach
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{__('msg.Edit Level Data')}} - {{$name}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="grid grid-cols-1 gap-10 mt-4 sm:grid-cols-3 bg-gray-50 p-2">
                        <div>
                            <h5 class="my-10">Update Basic Data</h5>

                            <div>
                                <label class="text-gray-700 dark:text-gray-200" for="name">{{__('msg.name')}}</label>
                                <input wire:model="name" id="name" type="text"
                                    class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('name') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="description">{{__('msg.type')}}</label>
                                <input wire:model="type" id="type" type="text"
                                    class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('type') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="type">{{__('msg.description')}}</label>
                                <input wire:model="description" id="description" type="text"
                                    class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('description') <span class="text-danger">*{{ $message }}</span> @enderror

                            </div>
                            <div>
                                <label class="text-gray-700 dark:text-gray-200"
                                    for="max_value">{{__('msg.max_value')}}</label>
                                <input wire:model="max_value" id="max_value" type="number"
                                    class="block w-full px-4 py-2  text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                @error('max_value') <span class="text-danger">*{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div wire:ignore.self>
                            <h5 class="my-10">Update Approvers Role</h5>

                            @foreach($levelApprovers as $la)
                            <div class="row" wire:ignore.self>
                                <div class="col-md-3 ">
                                    <p class="mt-2">{{$la->name}}</p>
                                </div>
                                <div class="col-md-3 ">
                                    <p class="mt-2">{{$la->level_role}}</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="flex-initial">
                                        <select name="roleEdit" wire:model="roleEdit" id="type"
                                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                            <option value="">Select a Option</option>
                                            <option value="{{$la->app_id}}Role New">Role New</option>
                                            <option value="{{$la->app_id}}Role Update">Role Update</option>
                                        </select> @error('roleEdit') <span class="text-danger">*{{ $message
                                            }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                        <div>
                            <h5 class="my-10">Add New Apporvers</h5>
                            <div class="grid grid-cols-1 gap-6  sm:grid-cols-2 bg-gray-50">
                                <div class="flex-initial">
                                    <label class="text-gray-700 dark:text-gray-200" for="query">Approver 1</label>
                                    <input wire:model="querya" wire:keydown.escape="reset"
                                        placeholder="Name/User Search" wire:keydown.tab="reset"
                                        wire:keydown.ArrowUp="decrementHighlight"
                                        wire:keydown.ArrowDown="incrementHighlight" wire:keydown.enter="selectStudent"
                                        id="query" type="text"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
                                    <div wire:loading wire:target="querya"
                                        class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        <div class="">Searching...</div>
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
                                        <option value="">Select a Option</option>
                                        <option value="Role 1">Role 1</option>
                                        <option value="Role 2">Role 2</option>
                                    </select> @error('role1') <span class="text-danger">*{{ $message
                                        }}</span> @enderror
                                </div>


                                <div class="z-500">
                                    <label class="text-gray-700 dark:text-gray-200" for="query">Approver 2</label>
                                    <input wire:model="queryb" wire:keydown.escape="reset"
                                        placeholder="Name/User Search" wire:keydown.tab="reset"
                                        wire:keydown.ArrowUp="decrementHighlight"
                                        wire:keydown.ArrowDown="incrementHighlight" wire:keydown.enter="selectStudent"
                                        id="query" type="text"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
                                    <div wire:loading wire:target="queryb"
                                        class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        <div class="">Searching...</div>
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
                                        <option value="">Select a Option</option>
                                        <option value="Role 1">Role 1</option>
                                        <option value="Role 2">Role 2</option>
                                    </select> @error('role2') <span class="text-danger">*{{ $message }}</span> @enderror
                                </div>
                                <div class="z-500">
                                    <label class="text-gray-700 dark:text-gray-200" for="query">Approver 3</label>
                                    <input wire:model="queryc" wire:keydown.escape="reset"
                                        placeholder="Name/User Search" wire:keydown.tab="reset"
                                        wire:keydown.ArrowUp="decrementHighlight"
                                        wire:keydown.ArrowDown="incrementHighlight" wire:keydown.enter="selectStudent"
                                        id="query" type="text"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
                                    <div wire:loading wire:target="queryc"
                                        class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                                        <div class="">Searching...</div>
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
                                        <option value="">Select a Option</option>
                                        <option value="Role 1">Role 1</option>
                                        <option value="Role 2">Role 2</option>
                                    </select> @error('role3') <span class="text-danger">*{{ $message
                                        }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="update">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('name-updated', event => {
            $('#exampleModal').modal('show');
        });

        window.addEventListener('data-updated', event => {
            $('#exampleModal').modal('hide');
        })
    </script>
</div>
