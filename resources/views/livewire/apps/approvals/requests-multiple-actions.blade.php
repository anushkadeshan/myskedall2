<div class="py-4 col-md-12">
    <div class="flex flex-row-reverse ">
        {{--<div class="pl-3">Sum of Max Values : <span class="p-1 bg-blue-800 text-white">{{$max_sum}}</span></div>--}}
        <div class="pl-3">{{__('msg.Sum of Requests')}} :  <span class="p-1 bg-blue-600 text-white">{{number_format($value_sum, 2)}}</span></div>
    </div>
    @if(auth()->user()->approver->count() >0)
    <div class="grid grid-cols-2 justify-between">
        <div class="flex">
            <div class="flex-initial pt-2">
                <p class="font-bold">{{__('msg.Multiple Actions')}}</p>
            </div>
            <div class="flex-initial ml-10">
                <button wire:click.prevent="repproved" class="bg-white text-red-600 font-semibold hover:text-red-900 py-2 px-4 border border-red hover:border-transparent rounded">
                    <i class="fas fa-minus-circle"></i>
                      {{__('msg.Repproved')}}
                </button>
            </div>
            <div class="flex-initial ml-2">
                <button wire:click.prevent="approved" class="bg-white text-green-600 font-semibold hover:text-green-900 py-2 px-4 border border-green hover:border-transparent rounded">
                    <i class="fas fa-minus-circle"></i>
                      {{__('msg.Approved')}}
                </button>
            </div>
            <div class="flex-initial ml-2">
                <button wire:click.prevent="delete" class="bg-white text-red-600 font-semibold hover:text-red-900 py-2 px-4 border border-red hover:border-transparent rounded">
                    <i class="fas fa-times-circle"></i>
                      {{__('msg.delete')}}
                </button>
            </div>
        </div>

    </div>
    @endif
    @if(session()->has('message'))
        <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)" id="alert" class="flex py-10 items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ session('message') }}</p>
        </div>
    @endif
</div>
