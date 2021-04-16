@extends('platform/template')
@section('content')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
	<div id="dvPainel">
		<table width="100%">
			<tbody>
				@foreach($data as $row)
				@if(session('locale')=='pt')
				<tr>
					<td width="150" style="padding:15px;"> <img src="{{asset($row->image)}}" width="100%"> </td>
					<td style="padding:15px; text-align:left;">
						<div class="appTitulo"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->title_pt}}</font></font>
						</div>
						<div class="appDescricao"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->description_pt}}</font></font>
						</div>
						<div style="padding-top:5px;">
							@if($row->active==1)
							<button disabled="" class="btn" type="button" style="padding:3px 5px 3px 5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activate</font></font>
							</button>
							@else
								<a class="btn btn-success" href="{{url('/app-permission/'.$row->key.'/1')}}" style="padding:3px 5px 3px 5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activate</font></font>
								</a>
							@endif
							@if($row->active==1)
								<a class="btn btn-danger" href="{{url('/app-permission/'.$row->key.'/0')}}"   style="padding:3px 5px 3px 5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Disable</font></font></button>
								</a>
							@else
								<button class="btn"  type="button" style="padding:3px 5px 3px 5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Disable</font></font></button>
								</button>
							@endif
						</div>
					</td>
				</tr>
				@else
				<tr>
					<td width="150" style="padding:15px;"> <img src="{{asset($row->image)}}" width="100%"> </td>
					<td style="padding:15px; text-align:left;">
						<div class="appTitulo"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->title_en}}</font></font>
						</div>
						<div class="appDescricao"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$row->description_en}}</font></font>
						</div>
						<div style="padding-top:5px;">
							@if($row->active==1)
							<button disabled="" class="btn" type="button" style="padding:3px 5px 3px 5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activate</font></font>
							</button>
							@else
								<a class="btn btn-success" href="{{url('/app-permission/'.$row->app_key.'/1')}}" style="padding:3px 5px 3px 5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activate</font></font>
								</a>
							@endif
							@if($row->active==1)
								<a class="btn btn-danger" href="{{url('/app-permission/'.$row->app_key.'/0')}}"   style="padding:3px 5px 3px 5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Disable</font></font></button>
								</a>
							@else
								<button class="btn"  type="button" style="padding:3px 5px 3px 5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Disable</font></font></button>
								</button>
							@endif
						</div>
					</td>
				</tr>
				@endif
				<tr>
					<td colspan="2">
						<hr style="padding:0px; margin:0px;">
					</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="2" align="center" style="height:60px;"> 
						<a href="{{url('/home')}}"><img src="{{asset('platform/images/voltar.png')}}" width="40"></a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
<script>
	$(window).scroll(function() {
  sessionStorage.scrollTop = $(this).scrollTop();
});

$(document).ready(function() {
  if (sessionStorage.scrollTop != "undefined") {
    $(window).scrollTop(sessionStorage.scrollTop);
  }
});
</script>
@endsection