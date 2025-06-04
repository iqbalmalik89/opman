@if(Auth::user()->hasPermissionTo('add project'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('project-archive')}}" href="{{route('project-archive')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-square-plus text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Project Archive</span>
										</a>
										<!--end:Menu link-->
									</div>

@endif