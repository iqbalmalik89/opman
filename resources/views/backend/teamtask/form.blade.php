@php
$date = '';
if(!empty($task->start_date))
	$date = date('d/m/Y', strtotime($task->start_date));

if(!empty($task->end_date))
	$date .= ' - ' . date('d/m/Y', strtotime($task->end_date));

@endphp

<input type="hidden" name="module_id" id="module_id" value="{{$task->id ?? ''}}" />

<div class="row">
	<div class="col-lg-6">
		<div class="fv-row mb-2">
			<label class="fs-6 fw-semibold form-label">
				<span>Project</span>
			</label>
			<select name="project_id" id="project_id" aria-label="Select a Project" class="form-select form-select-solid form-select-lg">
					<option value="">Select Project</option>
				@foreach($projects as $project)
					<option @if(!empty($task->project_id) && $task->project_id == $project->id) selected @endif value="{{$project->id}}">{{$project->name}}</option>
				@endforeach
			</select>									
		</div>
	</div>
	<div class="col-lg-5">
		<div class="fv-row mb-2">
			<label class="fs-6 fw-semibold form-label">
				<span>Start/End</span>
			</label>
			<input type="text" name="start_end" class="form-control range-picker form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Start/End" value="{{$date ?? ''}}" />
		</div>

	</div>

</div>

<div class="row">
	<div class="col-lg-11">
		<div class="fv-row mb-2">
			<label class="fs-6 fw-semibold form-label">
				<span>Task</span>
			</label>
			<textarea name="task" class="form-control form-control-solid">{{$task->task ?? ''}}</textarea>
		</div>
	</div>
</div>
	
<div class="suboperatives-list">

	@if(isset($task->suboperatives) && !empty($task->suboperatives->count()))
		@foreach($task->suboperatives as $subop)

			<div class="row">
				<div class="col-lg-6">
					<div class="fv-row mb-2">
						<label class="fs-6 fw-semibold form-label">
							<span>Suboperative</span>
						</label>
						<select name="suboperative[]" onchange="getSuboperativeSkills(this);" aria-label="Select a Suboperative" class="form-select form-select-solid form-select-lg">
							@foreach($suboperatives as $suboperative)
								<option @if($subop->suboperative_id == $suboperative->id) selected @endif value="{{$suboperative->id}}">{{$suboperative->first_name}} {{$suboperative->last_name}}</option>
							@endforeach
						</select>									
					</div>
				</div>
				<div class="col-lg-5">
					<div class="fv-row mb-2">
						<label class="fs-6 fw-semibold form-label">
							<span>Skill</span>
						</label>

						<select name="skill[]" aria-label="Select Skill" class="form-select skills form-select-solid form-select-lg">

							@foreach($subop->suboperative->documents as $document)
								<option @if($document->id == $subop->doc_id) selected @endif value="{{$document->id}}">{{$document->skill->certification}}</option>
							@endforeach

						</select>									
					</div>
				</div>
				<div class="col-lg-1">
					<a onclick="removeSubop(this);" href="javascript:void(0);"><i class="fa-solid fa-trash fs-1 text-danger" style="margin-top: 42px;"></i></a>


				</div>
			</div>

		@endforeach
		<div class="row">
				<a style="text-align:right;" onclick="addMoreSuboperative();" href="javascript:void(0);"><i class="fa-solid fa-circle-plus fs-1 text-info" style="margin-top: 5px;"></i> Add More Suboperatives</a>
		</div>
	@else

	<div class="row">
		<div class="col-lg-6">
			<div class="fv-row mb-2">
				<label class="fs-6 fw-semibold form-label">
					<span>Suboperative</span>
				</label>
				<select name="suboperative[]" onchange="getSuboperativeSkills(this);" aria-label="Select a Suboperative" class="form-select form-select-solid form-select-lg">
						<option value="">Select Suboperative</option>
					@foreach($suboperatives as $suboperative)
						<option value="{{$suboperative->id}}">{{$suboperative->first_name}} {{$suboperative->last_name}}</option>
					@endforeach
				</select>									
			</div>
		</div>
		<div class="col-lg-5">
			<div class="fv-row mb-2">
				<label class="fs-6 fw-semibold form-label">
					<span>Skill</span>
				</label>
				<select name="skill[]" aria-label="Select Skill" class="form-select skills form-select-solid form-select-lg">
				</select>									
			</div>
		</div>
		<div class="col-lg-1">
			<a onclick="addMoreSuboperative();" href="javascript:void(0);"><i class="fa-solid fa-circle-plus fs-1 text-info" style="margin-top: 42px;"></i></a>
		</div>
	</div>
	@endif
</div>
