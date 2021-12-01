<div>
    @if($is_draft)
    <button  style="color:pink"  class="bg-transparent w-28 text-pink-700 font-semibold hover:text-pink-900 py-2 px-4 border border-pink-500 hover:border-transparent rounded">
        {{__('msg.Draft')}}
    </button>
    @else
    @switch($current_status)
        @case(0)
        <button style="color:yellow" class="bg-transparent w-28 text-yellow-600 font-semibold hover:text-yellow-900 py-2 px-4 border border-yellow-600 hover:border-transparent rounded">
            {{__('msg.Pending')}}
        </button>
        @break
        @case(1)
        <button style="color:green" class="bg-transparent w-28 text-green-600 font-semibold hover:text-green-900 py-2 px-4 border border-green-600 hover:border-transparent rounded">
            {{__('msg.Approved')}}
        </button>
        @break
        @case(2)
        <button style="color:purple" class="bg-transparent w-28 text-purple-600 font-semibold hover:text-purple-900 py-2 px-4  border border-purple-600 hover:border-transparent rounded">
            {{__('msg.Repproved')}}
        </button>
        @break
        @case(3)
        <button style="color:blue" class="bg-transparent w-28 text-blue-600 font-semibold hover:text-blue-900 py-2 px-4 border border-blue-600 hover:border-transparent rounded">
            {{__('msg.Consulting')}}
        </button>
        @break
    @endswitch
    @endif
</div>
