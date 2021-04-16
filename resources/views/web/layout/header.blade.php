<header class="top-header" style="z-index:999999;">
	<div class="container">
		<div class="row">
			<div class="col-xs-3 header-logo">
				<br>
				<a href="index.php"><img src="img/logo.png" alt="" class="img-responsive logo" style="margin-top: -15px; margin-bottom: 25px;"></a>
			</div>
			<div class="col-md-9">
				<nav class="navbar navbar-default" style="margin-top: 12px; margin-bottom: 0px;">
					<div class="container-fluid nav-bar">
						<div class="navbar-header" style="margin-top:-30px;">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Toggle navigation</font></font></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right">
								<li><a class="menu" href="#home"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.main')}} </font></font></a></li>
								<li><a class="menu" href="#about"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.about Us')}} </font></font></a></li>
								<li><a class="menu" href="#action"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.actions')}}  </font></font></a></li>
								<li><a class="menu active" href="#contact"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.contact')}} </font></font></a></li>
								<li><a class="menu" href="{{url('login')}}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{__('msg.platform')}} </font></font></a></li>
								<li style="margin-top: -5px"><a class="menu" href="https://prakshop.commercesuite.com.br" target="###"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> {{__('msg.store')}} </font></font></a></li>
								<li>
									<a class="translation-links" href="{{ ROUTE('locale', 'en') }}" class="english" ><img style="max-height:18px;  position: relative; top:-3px; margin-right: 3px;margin-top:3px" src="{{asset('img/england.png')}}"></a>
								</li>
								<li>
									<a class="translation-links" href="{{ ROUTE('locale', 'pt') }}" class="portuguese" ><img style="max-height:18px; position: relative; top:-3px; margin-right: 10px;margin-top:3px" src="{{asset('img/brazil.png')}}"></a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>
