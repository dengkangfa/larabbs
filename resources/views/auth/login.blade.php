@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">登录</div>

                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">邮 箱</label>

                            <input id="email" type="email" class="form-control" name="email" placeholder="请填写 Email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">密 码</label>

                            <input id="password" type="password" class="form-control" name="password" placeholder="请填写密码" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success btn-block">
                            <span class="glyphicon glyphicon-log-in"></span> 登 录
                        </button>

                        <hr>

                        <fieldset class="form-group">
                            <div class="alert alert-info">使用以下方法注册或者登录（<a href="#">忘记密码？</a>）</div>
                            <a type="button" class="btn btn-default btn-block" href="{{ route('auth.oauth', ['driver' => 'github']) }}"><span class="icon-github"></span> GitHub 登录</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
