@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-header bg-info" style="color:#fff;">
                        <h3>Göndərilən E-Mailərin Siyahısı</h3>
                        <span style="float:right;top:-30px;position:relative;">
                            Xoş Gəldiniz : {{ Auth::user()->name }}
                            <a href="{{ route('auth.cixis') }}" style="color:#fff;">(Çıxış)</a>
                        </span>
                        <a href="{{ route('home.index') }}" class="btn btn-dark">Ana Səhifə</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Həftə</th>
                                        <th>Saat</th>
                                        <th>Əməliyyat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($senders as $k => $v)
                                    <tr>
                                        <td>{{ $v['week_day'] }}</td>
                                        <td>{{ $v['time'] }}</td>
                                        <td>
                                            <a href="{{ route('senders.edit',['id'=>$v['id']]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('senders.delete',['id'=>$v['id']]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
