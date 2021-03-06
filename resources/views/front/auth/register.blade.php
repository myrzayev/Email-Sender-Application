@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(session('info'))
                        <div class="alert alert-danger">
                            {{ session('info') }}
                        </div>
                    @endif
                    @if(session('warning'))
                        <div class="alert alert-danger">
                            {{ session('warning') }}
                        </div>
                    @endif
                    <form action="{{ route('auth.qeydStore') }}" method="POST">
                        @csrf
                        <div class="card-header bg-success" style="color:#fff;">
                            <h3>Sistemə Qeyd ol</h3>
                            <button type="button" class="btn btn-dark" style="float:right;top:-40px;position:relative;">
                                <a href="{{ route('auth.giris') }}" style="color:#fff;">Daxil ol</a>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Adı Soyadı</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autofocus>
                            </div>
                            <div class="form-group">
                                <label>İstifadəçi Adı</label>
                                <input type="text" value="{{ old('username') }}" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}">
                            </div>
                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                            </div>
                            <div class="form-group">
                                <label>Şifrə</label>
                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Qeyd ol</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
