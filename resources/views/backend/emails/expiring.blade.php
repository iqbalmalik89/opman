Hello,

@if(empty($days))
	Following skill(s) are expired.
@else
	Following skill(s) are going to expire in {{$days}} days.
@endif

<table cellpadding="10" cellspacing="10">
	<thead>
		<th>Name</th>
		<th>Skill</th>
		<th>Expire At</th>
	</thead>
	<tbody>
			@foreach($documents as $document)
			<tr>
				<td>
					@if($doc_type == 'people')
						<a href="{{tenant_route(tenant()->domains[0]->domain, 'edit-people', $document->people_id)}}">{{$document->people->first_name}} {{$document->people->last_name}}</a>
					@elseif($doc_type == 'subop')
						<a href="{{tenant_route(tenant()->domains[0]->domain, 'update-suboperative', $document->suboperative_id)}}">{{$document->people->first_name}} {{$document->people->last_name}}</a>
					@endif
				</td>
				<td>{{$document->skill->certification}}</td>
				<td>{{$document->expire_at}}</td>
			</tr>
			@endforeach
	</tbody>

</table>

