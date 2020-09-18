<div class="page-header">
	<h4 class="page-title">{{ $menuActive->name }}</h4>
	
	@foreach($menus as $parent)

      @if($parent['active'])
	
		<ul class="breadcrumbs">
			<li class="nav-home">
				<a href="{{ Route::has($parent['route']. '.index') ? route($parent['route']. '.index') : 'javascript:;' }}">
					<i class="{{ $parent['icon'] }}"></i>
				</a>
			</li>
	
			@if(!empty($parent['menu']))

				@foreach($parent['menu'] as $menu)

					@if($menu['active'])

						<li class="separator">
							<i class="flaticon-right-arrow"></i>
						</li>
						<li class="nav-item">
							<a href="{{ Route::has($menu['route']. '.index') ? route($menu['route']. '.index') : 'javascript:;' }}">{{ $menu['name'] }}</a>
						</li>

						@if(!empty($menu['submenu']))

							@foreach($menu['submenu'] as $submenu)

								@if($submenu['active'])

									<li class="separator">
										<i class="flaticon-right-arrow"></i>
									</li>
									<li class="nav-item">
										<a href="{{ Route::has($submenu['route']. '.index') ? route($submenu['route']. '.index') : 'javascript:;' }}">{{ $submenu['name'] }}</a>
									</li>

									<li class="separator">
										<i class="flaticon-right-arrow"></i>
									</li>

									<li class="nav-item">
										<a href="{{ url()->current() }}">
											{{ $permission['page'] }}
										</a>
									</li>

								@endif

							@endforeach

						@endif

					@endif

				@endforeach

			@endif

		</ul>

	  @endif

	@endforeach

</div>