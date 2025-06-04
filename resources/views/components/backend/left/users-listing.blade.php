@if(Auth::user()->hasPermissionTo('view user listing'))
									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('users')}} {{Nav::isRoute('update-user')}}" href="{{route('users')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-users-between-lines text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Users</span>
										</a>
										<!--end:Menu link-->
									</div>

@endif