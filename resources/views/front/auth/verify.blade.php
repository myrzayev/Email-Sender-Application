@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(session('warning'))
                        <div class="alert alert-danger">
                            {{ session('warning') }}
                        </div>
                    @endif
                    <form action="{{ route('auth.tesdiqleStore') }}" method="POST">
                        @csrf
                        <div class="card-header bg-success" style="color:#fff;">
                            <h3>Sistemə Daxil ol</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Təsdiqləmə kodu</label>
                                <input type="text" value="{{ old('code') }}" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" autofocus>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Təsdiqlə</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
