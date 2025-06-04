@if(Auth::user()->hasPermissionTo('add user'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('create-user')}}" href="{{route('create-user')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-person-circle-plus text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Create User</span>
										</a>
										<!--end:Menu link-->
									</div>

@endif