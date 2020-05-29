@foreach ($info as $k=>$v)
		<tr @if($k%2==0) class="warning" @else class="danger" @endif>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_sn}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_number}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->is_show==1?'√':'×'}}</td>
			<td>{{$v->is_new==1?'√':'×'}}</td>
			<td>{{$v->is_best==1?'√':'×'}}</td>
			<td>
				@if($v->goods_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="50">
				@endif
			</td>
			<td>相册</td>
			<td>{{$v->goods_desc}}</td>
			<td>
				<a href="{{url('goods/edit/'.$v->goods_id)}}" class="btn btn-warning">编辑</a> || 
				<a href="{{url('goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	<tr><td colspan=14 align="center">{{$info->links()}}</td></tr>