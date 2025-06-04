@if(Auth::user()->hasPermissionTo('add project'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('create-project')}}" href="{{route('create-project')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-square-plus text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Add Project</span>
										</a>
										<!--end:Menu link-->
									</div>

@endif