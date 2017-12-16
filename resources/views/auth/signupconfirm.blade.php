@extends('layouts.app')

@section('title')
    Create New Account
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">创建新账号</h3>
                </div>
                <div class="panel-body">
                    <form action="{{ route('signup') }}" method="POST" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="control-label">头像</label>
                            <div class="form-group">
                                <img src="{{ $oauthData['avatar'] }}" width="100%">
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="control-label" for="name">昵 称</label>
                            <input class="form-control" name="name" type="text" value="{{ $oauthData['name'] ?: '' }}">
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>

                        @if($oauthData['driver'] == 'github')
                            <div class="form-group {{ $errors->has('github_name') ? 'has-error' : '' }}">
                                <label class="control-label" for="github_name">Github Name</label>
                                <input class="form-control" readonly="readonly" name="github_name" type="text" value="{{ isset($oauthData['github_name']) ? $oauthData['github_name'] : $oauthData['name'] }}">
                                {!! $errors->first('github_name', '<span class="help-block">:message</span>') !!}
                            </div>
                        @endif

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="control-label" for="email">邮 箱</label>
                            <input class="form-control" name="email" type="text" value="{{ $oauthData['email'] ?: '' }}">
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label class="control-label" for="password">密 码</label>
                            <input class="form-control" name="password" type="password" value="{{ old('password') }}">
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label class="control-label" for="password_confirmation">确认密码</label>
                            <input class="form-control" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}">
                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                        </div>

                        <input class="btn btn-lg btn-success btn-block" type="submit" value="确定">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop