@extends('platform/template')
@section('content')

<table width="100%" class="painelNivel">
    <tbody>
        <tr>
            <td>{{ __('msg.group Requests') }}</td>
        </tr>
        <tr>
            <td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td>
        </tr>
    </tbody>
</table>
<table align="center" class="busca" style="width:96%; max-width:700px;">
    <tr>
        <td colspan="4">
            <form autocomplete="off">
                <div class="panel panel-default container-fluid">
                    <div class="input-group">
                        <input type="text" name="search-group-requests" id="search-group-requests" value=""
                            maxlength="100" class="form-control"  placeholder="{{ __('msg.search a User') }}">
                        <button type="button" name="btBuscar" id="btBuscar" onClick='fetch_group_data()'
                            class="btn btn-default"
                            style="height:35px; "><i class="fa fas-search"></i><span class="hidden-xs">
                                {{ __('msg.search') }}</span></button>
                    </div>
                </div>
            </form>
        </td>
    </tr>
</table>
<table align="center" class="busca table table-responsive table-striped" style="width:96%;" id="groupRequests">
    <div class="alert alert-danger" id="alert" role="alert" style="display: none">
        {{ __('msg.No records Found !') }}
    </div>
    <div class="alert alert-success" id="success-alert" role="alert" style="display: none">
        {{ __('msg.Request Accepted !') }}
    </div>
    <div class="alert alert-success" id="success-alert2" role="alert" style="display: none">
        {{ __('msg.Request Deleted !') }}
    </div>
    <tbody>

    </tbody>

</table>
@endsection
