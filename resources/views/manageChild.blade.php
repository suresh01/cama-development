<ul>
@foreach($childs as $child)
	<li>
		
	<a onclick="openEditRole({{ $child->mod_id }})" href="#"> ( {{$child->mod_id}} )  {{ $child->mod_name }} </a>
	<input type="hidden" id="eparent_{{ $child->mod_id }}" value="{{ $child->mod_parent }}">
							<input type="hidden" id="eroleid_{{ $child->mod_id }}" value="{{ $child->rol_id }}">
						<input type="hidden" id="ename_{{ $child->mod_id }}" value="{{ $child->mod_name }}">
	@if(count($child->childs))
            @include('manageChild',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>