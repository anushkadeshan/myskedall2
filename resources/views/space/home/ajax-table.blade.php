
		@forelse($data as $row)
			<tr @if($row->status==0 || $row->status==1 || ($row->status==2 && $row->is_repproved==1))onclick="OpenReuseRequestModel('{{url('space/reuse-request/'.$row->id)}}')" @endif>
				<td>{{date('d-M-Y',strtotime($row->initial_date))}}</td>
				<td>{{$row->initial_time}}</td>
				<td>{{$row->events}}</td>
				<td>{{$row->space}}</td>
				<td> 
					@if($row->status==0)
					<img src="{{asset('img/confused.png')}}" style="width:20px;"> 
					@elseif($row->status==1)
					<img src="{{asset('img/confused.png')}}" style="width:20px;">
					@elseif($row->status==2 && $row->is_repproved==0)
					<img src="{{asset('img/smiling-green.png')}}" style="width:20px;">						
					@elseif($row->status==2 && $row->is_repproved==1)
					<img src="{{asset('img/sad.png')}}" style="width:20px;">
					@endif
				</td>
			</tr>
		@empty
		@endforelse
	