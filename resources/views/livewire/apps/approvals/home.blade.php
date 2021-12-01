<div class="container-fluid">

    <br>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card">
            <section class="card-header">
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <h1 class="pull-left">{{__('msg.My Approvals')}}</h1>
                    </div>
                    {{--
                    <div class="col-md-9">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg"
                                placeholder="Search REQUEST DATE/ID/TITLE/DESCRIPTON/REQUESTER, ETC"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2">Search</button>
                        </div>
                    </div>
                    --}}
                </div>

                <br>
            </section>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4" data-bs-toggle="collapse" href="#collapseExample" role="button">
                            <div class="card-counter primary">
                                <i class="fa fa-eye"></i>
                                <span class="count-numbers">{{$blue}}</span>
                                <span class="count-name">CIÊNCIA e providências</span>
                            </div>
                            @if($approver)
                            <div class="collapse primary" id="collapseExample">
                                @foreach($blue_levels as $bl)
                                <a href="{{ route('approvals.requests', [$bl->current_status]) }}">
                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <h5>{{$bl->name}}</h5>
                                    </div>
                                    <div class="col-md-6 text-right" style="float:right;">
                                        <span class="badge badge-primary lead"  style="float:right;">
                                            <h5>{{$bl->count}}</h5>
                                        </span>
                                    </div>
                                </div>
                            </a>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <div class="col-md-4" data-bs-toggle="collapse" href="#collapseExample2" role="button">
                            <div class="card-counter success">
                                <i class="far fa-smile"></i>
                                <span class="count-numbers">{{$green}}</span>
                                <span class="count-name">APROVADOS com considerações</span>
                            </div>
                            @if($approver)
                            <div class="collapse success" id="collapseExample2">
                                @foreach($green_levels as $gl)
                                <a href="{{ route('approvals.requests', [$gl->current_status]) }}">
                                <div class="row mb-1">
                                    <div class="col-md-6 ">
                                        <h5>{{$gl->name}}</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span class="badge badge-primary lead">
                                            <h5>{{$gl->count}}</h5>
                                        </span>
                                    </div>
                                </div>
                            </a>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <div class="col-md-4" data-bs-toggle="collapse" href="#collapseExample3" role="button">
                            <div class="card-counter danger">
                                <i class="far fa-frown"></i>
                                <span class="count-numbers">{{$red}}</span>
                                <span class="count-name">REPROVADOS com justificativa</span>
                            </div>
                            @if($approver)
                            <div class="collapse danger" id="collapseExample3">
                                @foreach($red_levels as $rl)
                                <a href="{{ route('approvals.requests', [$rl->current_status]) }}">
                                <div class="row mb-1">
                                    <div class="col-md-6 ">
                                        <h5>{{$rl->name}}</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span class="badge badge-danger lead" style="float:right;">
                                            <h5>{{$rl->count}}</h5>
                                        </span>
                                    </div>
                                </div>
                            </a>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <div class="col-md-4" data-bs-toggle="collapse" href="#collapseExample4" role="button">
                            <div class="card-counter warning">
                                <i class="far fa-meh"></i>
                                <span class="count-numbers">{{$yellow}}</span>
                                <span class="count-name">PENDENTES em análise</span>
                            </div>
                            @if($approver)
                            <div class="collapse warning" id="collapseExample4">
                                @foreach($yellow_levels as $yl)
                                <a href="{{ route('approvals.requests', [$yl->current_status]) }}">
                                    <div class="row mb-1">
                                    <div class="col-md-6 ">
                                        <h5>{{$yl->name}}</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span class="badge badge-danger lead" style="float:right;">
                                            <h5>{{$yl->count}}</h5>
                                        </span>
                                    </div>
                                </div>
                                </a>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="col-md-4" data-bs-toggle="collapse" href="#collapseExample5" role="button">
                            <div class="card-counter pink">
                                <i class="fa fa-clock"></i>
                                <span class="count-numbers">{{$pink}}</span>
                                <span class="count-name">Esboços em elaboração</span>
                            </div>
                            @if($approver)
                            <div class="collapse pink" id="collapseExample5">
                                @foreach($pink_levels as $pl)
                                <a href="{{ route('approvals.requests', [$pl->current_status]) }}">
                                <div class="row mb-1">
                                    <div class="col-md-6 ">
                                        <h5>{{$pl->name}}</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span class="badge badge-danger lead" style="float:right;">
                                            <h5>{{$pl->count}}</h5>
                                        </span>
                                    </div>
                                </div>
                            </a>
                                @endforeach

                            </div>
                            @endif
                        </div>
                        <div class="col-md-4" data-bs-toggle="collapse" href="#collapseExample6" role="button">
                            <div class="card-counter purple">
                                <i class="fa fa-repeat"></i>
                                <span class="count-numbers">{{$purple}}</span>
                                <span class="count-name">DEVOLVIDOS com observações</span>
                            </div>
                            @if($approver)
                            <div class="collapse purple" id="collapseExample6">
                                @foreach($purple_levels as $pl)
                                <a href="{{ route('approvals.requests', [$pl->current_status]) }}">
                                <div class="row mb-1">
                                    <div class="col-md-6 ">
                                        <h5>{{$pl->name}}</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span class="badge badge-danger lead" style="float:right;">
                                            <h5>{{$pl->count}}</h5>
                                        </span>
                                    </div>
                                </div>
                                </a>
                                @endforeach

                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="text-center">

        </div>
    </div>
</div>
