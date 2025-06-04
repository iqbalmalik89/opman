@if(Auth::check() && Auth::user()->getRoleNames()[0] != 'owner')
		<script>
			const p = {
				editUser : {{!empty(Auth::user()->hasPermissionTo('update user')) ? 1 : 0}},
				deleteUser : {{!empty(Auth::user()->hasPermissionTo('delete user')) ? 1 : 0}},
				editCategory : {{!empty(Auth::user()->hasPermissionTo('update category')) ? 1 : 0}},
				deleteCategory : {{!empty(Auth::user()->hasPermissionTo('delete category')) ? 1 : 0}},
				editCertification : {{!empty(Auth::user()->hasPermissionTo('update certification')) ? 1 : 0}},
				deleteCertification : {{!empty(Auth::user()->hasPermissionTo('delete certification')) ? 1 : 0}},
				editPeople : {{!empty(Auth::user()->hasPermissionTo('update people')) ? 1 : 0}},
				deletePeople : {{!empty(Auth::user()->hasPermissionTo('delete people')) ? 1 : 0}},
				editSite : {{!empty(Auth::user()->hasPermissionTo('update site')) ? 1 : 0}},
				deleteSite : {{!empty(Auth::user()->hasPermissionTo('delete site')) ? 1 : 0}},
				editSubcontractor : {{!empty(Auth::user()->hasPermissionTo('update subcontractor')) ? 1 : 0}},
				deleteSubcontractor : {{!empty(Auth::user()->hasPermissionTo('delete subcontractor')) ? 1 : 0}},
				viewTeam : {{!empty(Auth::user()->hasPermissionTo('view subcontractor teams')) ? 1 : 0}},
				editTeam : {{!empty(Auth::user()->hasPermissionTo('edit subcontractor team')) ? 1 : 0}},
				deleteTeam : {{!empty(Auth::user()->hasPermissionTo('delete subcontractor team')) ? 1 : 0}},
				editProject : {{!empty(Auth::user()->hasPermissionTo('update project')) ? 1 : 0}},
				deleteProject : {{!empty(Auth::user()->hasPermissionTo('delete project')) ? 1 : 0}},
				editPeopleDocument : {{!empty(Auth::user()->hasPermissionTo('edit people document')) ? 1 : 0}},
				deletePeopleDocument : {{!empty(Auth::user()->hasPermissionTo('delete people document')) ? 1 : 0}},
				viewPeopleDocument : {{!empty(Auth::user()->hasPermissionTo('edit people document')) ? 1 : 0}},	
				editSuboperativeDocument : {{!empty(Auth::user()->hasPermissionTo('upload suboperative document')) ? 1 : 0}},
				deleteSuboperativeDocument : {{!empty(Auth::user()->hasPermissionTo('delete suboperative document')) ? 1 : 0}},

				viewPeopleDocument : {{!empty(Auth::user()->hasPermissionTo('view people document')) ? 1 : 0}},

				viewSuboperatives : {{!empty(Auth::user()->hasPermissionTo('view suboperatives of a subcontractor')) ? 1 : 0}},
				editSuboperative : {{!empty(Auth::user()->hasPermissionTo('update suboperative')) ? 1 : 0}},
				deleteSuboperative : {{!empty(Auth::user()->hasPermissionTo('delete suboperative')) ? 1 : 0}},


			}

		</script>
	@endif