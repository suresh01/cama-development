@foreach ($codemaintenance as $sub_rec)
	@if($rec->pd_name == $sub_rec->pd_parent && $rec->pd_parent == 'Root')	
			<option value="{{ $sub_rec->pd_name }}">  {{ $rec->pd_name }} ->{{ $sub_rec->pd_name }}   </option>							
	@endif
	@foreach ($codemaintenance as $sub_sub_rec)
		@if($rec->pd_name == $sub_rec->pd_parent && $sub_rec->pd_name == $sub_sub_rec->pd_parent && $rec->pd_parent == 'Root')
			<option value="{{ $sub_sub_rec->pd_name }}">  {{ $rec->pd_name }} ->{{ $sub_rec->pd_name }}-> {{ $sub_sub_rec->pd_name }}   </option>	
		@endif
		@foreach ($codemaintenance as $sub_sub_sub_rec)
			@if($rec->pd_name == $sub_rec->pd_parent && $sub_rec->pd_name == $sub_sub_rec->pd_parent && $sub_sub_rec->pd_name == $sub_sub_sub_rec->pd_parent && $rec->pd_parent == 'Root')	
				<option onclick="blockParent(1)" value="{{ $sub_sub_sub_rec->pd_name }}">  {{ $rec->pd_name }} ->{{ $sub_rec->pd_name }}-> {{ $sub_sub_rec->pd_name }}-> {{ $sub_sub_sub_rec->pd_name }}   </option>		
			@endif		
		@endforeach	
	@endforeach											
@endforeach