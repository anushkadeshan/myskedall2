<div class="page-header">
    <div class="header-wrapper row m-0">

      <div class="header-logo-wrapper col-auto p-0">
        <div class="logo-wrapper"><a href="{{route('home')}}"><img class="img-fluid" src="{{asset('assets/admin/images/logo/logo.jpg')}}" alt=""></a></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
      </div>
      <div class="left-header col horizontal-wrapper ps-0">
        <ul class="horizontal-menu">
            <li class="mega-menu outside p-0 m-0">
                <div class="">
                    <div class="page-title m-0 p-0">
                        <div class="col-12 mt-0">
                            <ol class="breadcrumb mb-0 pb-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a></li>
                                @yield('breadcrumb-items')
                              </ol>
                        </div>
                    </div>
                  </div>
              </li>

        </ul>
      </div>
      <div class="nav-right col-8 pull-right right-header p-0">
        <ul class="nav-menus">
            <li class="language-nav">
                <div class="translate_wrapper">
                  <div class="current_lang">
                    <div class="lang">
                        @if(App::getLocale() == 'en')
                        <i class="flag-icon flag-icon-us"></i>
                        @else
                        <i class="flag-icon flag-icon-br"></i>
                        @endif
                        <span class="lang-txt">{{ App::getLocale() }} </span></div>
                  </div>
                  <div class="more_lang">
                    <a href="{{ route('locale', 'en' )}}" class="{{ (App::getLocale()  == 'en') ? 'active' : ''}}">
                        <div class="lang {{ (App::getLocale()  == 'en') ? 'selected' : ''}}" data-value="en"><i class="flag-icon flag-icon-us"></i> <span class="lang-txt">English</span><span> (US)</span></div>
                      </a>
                    <a href="{{ ROUTE('locale', 'pt') }}" class="{{ (App::getLocale()  == 'pt') ? 'active' : ''}}">
                      <div class="lang {{ (App::getLocale()  == 'pt') ? 'selected' : ''}}" data-value="pt"><i class="flag-icon flag-icon-br"></i> <span class="lang-txt">Português</span><span> (BR)</span></div>
                    </a>

                  </div>
                </div>
              </li>
          <li class="onhover-dropdown">
            <div class="notification-box">{{$activeGroup->name}}</div>
            <ul class="notification-dropdown onhover-show-div">
              <li>
                <h6 class="f-18 mb-0">Groups</h6>
              </li>
              @if(!empty($userGroup))
                    @foreach($userGroup as $ugroup)
                    <li>
                        <a href="{{url('change-active-group/'.$ugroup->id)}}" data-original-title="" title=""><i @if($activeGroup->id==$ugroup->id) class="me-3 font-primary fa fa-check" @endif aria-hidden="true"></i><span>{{$ugroup->name}} </span></a>
                    </li>
                    @endforeach
                @endif
                @if(!empty($groupData))
                    <li data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalGrupoConectar"><a class="btn btn-primary" href="#">{{ __('msg.connect to a Group') }}</a></li>
                @endif

            </ul>
          <li class="profile-nav onhover-dropdown p-0 me-0">
            <div class="media profile-media">
              <img class="b-r-10" src="{{asset('assets/images/dashboard/profile.jpg')}}" alt="">
              <div class="media-body">
                <span>{{auth()->user()->name}}</span>
                <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
              </div>
            </div>
            <ul class="profile-dropdown onhover-show-div">
                <li><a href="#" data-bs-original-title="" title=""><i class="fa fa-user fa-lg"></i><span> @lang('msg.profile') </span></a></li>
              <li>

                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i><span> {{ __('Logout') }}</span></a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalGrupoConectar" tabindex="-1" role="dialog" aria-labelledby="modalGrupoConectarTitulo" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:95%; max-width:500px;">
        <div class="modal-content">
            <div class="modal-header" style="color:#000000">
                <h4 class="modal-title" id="modalGrupoConectarTitulo" style="clear:both">{{__('msg.Connect to a group')}}
                    <br>
                    <br>
                <p style="font-weight: normal">
                {{__('msg.Click on one of the banners to request to join a group. Remember that admission depends on the approval of the group administrator.')}}</p>
                </h4>

            </div>
            <div class="modal-body">
                <table class="listaGrupos">
                    <tbody>
                        @foreach($groupData as $group)
                        <tr>
                            <td style="padding-bottom:10px;" onclick="SendGroupRequest({{$group->id}})">
                                <div style="position:absolute; color:#ffffff; font-size:20px; margin:10px; text-shadow: 2px 2px 2px #000000;">
                                    {{$group->name}}
                                </div>
                                <img style="width:100%;"  id="imGrupo4" src="{{asset('_dados/plataforma/grupos/'.$group->id.'/banner.jpg')}}">
                            </td>
                        </tr>
                        @endforeach
                        @if(count($groupData)==0)
                            {{__('msg.Sorry! There are no more groups')}}
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width:90px;">{{__('msg.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
