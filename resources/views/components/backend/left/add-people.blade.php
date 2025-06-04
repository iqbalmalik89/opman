@if(Auth::user()->hasPermissionTo('add people'))
									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('create-people')}}" href="{{route('create-people')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-user-plus text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Add People</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif