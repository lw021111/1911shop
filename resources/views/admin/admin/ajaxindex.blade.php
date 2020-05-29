@foreach ($info as $k=>$v)
		<tr @if($k%2==0) class="warning" @else class="danger" @endif>
			<td>{{$v->admin_id}}</td>
			<td>
				@if($v->admin_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->admin_img}}" width="50">
				@endif
			</td>
			<td>{{$v->admin_name}}</td>
			<td>{{$v->admin_tel}}</td>			
			<td>{{$v->admin_email}}</td>
			<td>{{date('Y-m-d h:i:s',$v->create_time)}}</td>
			<td>
				<a href="{{url('admin/edit/'.$v->admin_id)}}" class="btn btn-warning">编辑</a> || 
				<a href="{{url('admin/destroy/'.$v->admin_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	<tr><td colspan=7 align="center">{{$info->links()}}</td></tr>