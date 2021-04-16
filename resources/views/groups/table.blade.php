<div class="table-responsive">
    <table class="table" id="groups-table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('msg.name')}} </th>
                <th>{{__('msg.Address')}} </th>
                <th>{{__('msg.Phone')}} </th>
                <th>{{__('msg.Apps')}} </th>
                <th>{{__('msg.Managers')}} </th>
                <th colspan="3">{{__('msg.Action')}} </th>
            </tr>
        </thead>
        <tbody>
            @php
                $no=1;
            @endphp
            @foreach($groups as $group)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->address }}</td>
                    <td>{{ $group->phone }}</td>
                    <td style="min-width:200px">
                        <form action="{{url('assign-apps-to-group')}}" method="POST">
                        <div class="ui form">
                            <div class="inline field" style="float:left">
                                @csrf
                                <input type="hidden" name="group_id" value="{{$group->id}}">
                                <select name="apps[]" multiple="" class="label ui selection fluid dropdown">
                                <option value="">Use All Apps</option>
                                @foreach($apps as $app)
                                    @php
                                        $app_groups = \DB::table('group_apps')->where('group_id',$group->id)->get();
                                    @endphp                               
                                    <option @foreach($app_groups as $app_group)
                                            @if($app_group->app_id==$app->id) selected @endif
                                            @endforeach value="{{$app->id}}">{{$app->title_en}}</option>
                                @endforeach
                                </select>
                                
                            </div>  
                            <div style="float:left; margin-left:5px">
                            <button type="submit" class="btn btn-success">{{__('msg.update')}}</button>
                            </div>
                        </div>
                    </form>
                    </td>
                    <td>
                        <form action="{{url('assign-managers-to-group')}}" method="POST">
                            <div class="ui form">
                                <div class="inline field" style="float:left">
                                    @csrf
                                    <input type="hidden" name="group_id" value="{{$group->id}}">
                                    <select name="managers[]" multiple="" class="label ui selection fluid dropdown">
                                        <option value="">Select Managers</option>
                                        @foreach($managers as $manager)
                                            @php
                                                $group_managers = \DB::table('groups_managers')->where('group_id',$group->id)->pluck('user_id')->toArray();
                                            @endphp                               
                                            <option @if(!is_null($group_managers)) @if(in_array($manager->id,$group_managers)) selected @endif @endif value="{{$manager->id}}">{{$manager->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>  
                                <div style="float:left; margin-left:5px">
                                <button type="submit" class="btn btn-success">{{__('msg.update')}}</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td>
                        {!! Form::open(['route' => ['groups.destroy', $group->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('groups.show', [$group->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-eye"></i></a>
                            <a href="{{ route('groups.edit', [$group->id]) }}" class='btn btn-success btn-xs'><i class="fa fa-edit"></i></a>
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js"></script>
    <script>
        
    $('.label.ui.dropdown')
        .dropdown();
    $('.no.label.ui.dropdown')
    .dropdown({
    useLabels: false
    });

    $('.ui.button').on('click', function () {
    $('.ui.dropdown')
        .dropdown('restore defaults')
    })
    
    </script>
@endpush