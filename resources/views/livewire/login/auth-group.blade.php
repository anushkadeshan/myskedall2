<div>
    <!-- login page start-->
    <div class="container-fluid p-0">
       <div class="row m-0">
           <div class="col-12 p-0">
               <div class="login-card">
                   <div>
                       <div></div>
                       <div class="login-main">
                           @if (session()->has('register.success'))
                           <div class="alert alert-success alert-dismissible" role="alert">
                               <strong>{{__('msg.congragulations')}} !</strong> {{session('register.success')}}
                           </div>
                           @endif
                           <form class="theme-form" action="" method="POST">
                               <span class="text-right" style="float:right">

                                   <a class="translation-links" href="{{ ROUTE('locale', 'en') }}" class="english" ><img style="max-height:18px;  position: relative; top:-3px; margin-right: 3px;margin-top:3px" src="{{asset('img/england.png')}}"></a>
                                   <a class="translation-links" href="{{ ROUTE('locale', 'pt') }}" class="portuguese" ><img style="max-height:18px; position: relative; top:-3px; margin-right: 10px;margin-top:3px" src="{{asset('img/brazil.png')}}"></a>
                               </span>
                               <h4>{{__('msg.Please Select a Group to Continue')}}
                               </h4>

                               <div class="form-group">
                                   <label class="col-form-label">{{__('msg.Preffered Group')}} </label>
                                   <select wire:model="group" name="group_id" id="" class="form-control">
                                        <option value="">Select a Group</option>
                                    @foreach($groups as $group)
                                       <option value="{{$group->id}}">{{$group->name}}</option>
                                       @endforeach
                                   </select>
                               </div>

                               </form>

                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div>
