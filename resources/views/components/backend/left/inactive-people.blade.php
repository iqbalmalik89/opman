@if(Auth::user()->hasPermissionTo('people listing'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('inactive-people')}} {{Nav::isRoute('edit-people')}}" href="{{route('inactive-people')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-list text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Inactive People</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif