<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<?php if (preg_match("/voyyp/", $_SERVER['HTTP_HOST'])) { ?>
			<a class="navbar-brand" href="{{url('/')}}">
				<img src="{{asset('img/logo-white.svg')}}" height="30px">
			</a>
			<? } ?>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navb">
				<ul class="navbar-nav mr-auto">
					<li class="{{$page_info['menu'] == 'DASHBOARD' ? 'active' : ''}} nav-item">
						<a class="waves-effect waves-dark text-capitalize na-link" href="{{route('client.dashboard')}}"><i class="icon-speedometer"></i><span class="hide-menu"> Dashboard </a>
					</li>
					<li class="{{$page_info['menu'] == 'BALANCE' ? 'active' : ''}} nav-item">
						<a class="waves-effect waves-dark text-capitalize nav-link" href="{{route('client.balance')}}"><i class="icon-wallet"></i><span class="hide-menu"> Balance <span class="balance" >$<span id="header-balance">{{number_format($balance ,2, '.', ',')}}</span></span></a>
					</li>
					<li class="{{$page_info['menu'] == 'SETTINGS' ? 'active' : ''}} nav-item">
						<a class="waves-effect waves-dark text-capitalize na-link" href="{{route('client.settings')}}"><i class="icon-settings"></i><span class="hide-menu"> Settings </a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							<i class="icon-power"></i>
							Sign Out
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
				    </li>
				</ul>
			</div>
		</div>
	</nav>
</header>
