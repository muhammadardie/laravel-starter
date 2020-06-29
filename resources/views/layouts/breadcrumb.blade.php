<div class="page-header">

	@foreach($menus as $parent)

      @if($parent['active'])
	
		<h4 class="page-title">{{ $parent['name'] }}</h4>
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