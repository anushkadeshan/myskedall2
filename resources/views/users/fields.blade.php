
<div class="row">
    <div class="col-md-6">
        <!-- Name Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('name', trans('msg.name :')) !!}
            {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Nickname Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('nickname', trans('msg.nickname:')) !!}
            {!! Form::text('nickname', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
        </div>

        <!-- Email Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Password Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Sex Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('sex', trans('msg.sex:')) !!}
            {!! Form::select('sex', array('' => 'Select','m' => 'Male', 'f' => 'Female'),null,['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Birth Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('birth', trans('msg.birth:')) !!}
            {!! Form::date('birth', null, ['class' => 'form-control','maxlength' => 20,'maxlength' => 20]) !!}
        </div>

        <!-- Phone Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('phone', trans('msg.phone:')) !!}
            {!! Form::text('phone', null, ['class' => 'form-control','maxlength' => 15,'maxlength' => 15, 'onkeydown'=> "phoneMaskBrazil()", 'placeholder'=> '(99) 99999-9999']) !!}
        </div>

        <!-- Address Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('address', trans('msg.address:')) !!}
            {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Zipcode Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('zipcode', trans('msg.zipcode:')) !!}
            {!! Form::text('zipcode', null, ['class' => 'form-control','maxlength' => 15,'maxlength' => 15]) !!}
        </div>
        <!-- Neighborhood Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('neighborhood', trans('msg.neighborhood:')) !!}
            {!! Form::text('neighborhood', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <!-- City Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('city', trans('msg.city:')) !!}
            {!! Form::text('city', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Uf Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('uf', trans('msg.uf:')) !!}
            {!! Form::text('uf', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10]) !!}
        </div>

        <!-- Profession Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('profession', trans('msg.profession:')) !!}
            {!! Form::text('profession', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>
        <!-- Rg Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('rg', trans('msg.rg:')) !!}
            {!! Form::text('rg', null, ['class' => 'form-control','maxlength' => 30,'maxlength' => 30]) !!}
        </div>

        <!-- Cpf Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('cpf', trans('msg.cpf:')) !!}
            {!! Form::text('cpf', null, ['class' => 'form-control','maxlength' => 30,'maxlength' => 30]) !!}
        </div>

        <!-- Level Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('level',  trans('msg.level:')) !!}
            {!! Form::select('level', array('' => 'Select','1' => 'Admin', '0' => 'Non Admin'),null,['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>

        <!-- Status Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('status', trans('msg.status:')) !!}
            {!! Form::select('status', array('' => 'Select','1' => 'Aprove', '0' => 'Reject'),null,['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>
        <!-- Have Warning Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('have_warning', trans('msg.have_warning:')) !!}
            <label class="checkbox-inline">
                {!! Form::hidden('have_warning', 0) !!}
                {!! Form::checkbox('have_warning', '1', null) !!}
            </label>
        </div>
        <!-- Have Group Warning Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('have_group_warning', trans('msg.have_group_warning:')) !!}
            <label class="checkbox-inline">
                {!! Form::hidden('have_group_warning', 0) !!}
                {!! Form::checkbox('have_group_warning', '1', null) !!}
            </label>
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit(trans('msg.Save'), ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('users.index') }}" class="btn btn-default">{{__('msg.cancel')}}</a>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        function phoneMaskBrazil() {
            var key = window.event.key;
            var element = window.event.target;
            var isAllowed = /\d|Backspace|Tab/;
            if(!isAllowed.test(key)) window.event.preventDefault();
            
            var inputValue = element.value;
            inputValue = inputValue.replace(/\D/g,'');
            inputValue = inputValue.replace(/(^\d{2})(\d)/,'($1) $2');
            inputValue = inputValue.replace(/(\d{4,5})(\d{4}$)/,'$1-$2');
            
            element.value = inputValue;
        }
    </script>
@endpush