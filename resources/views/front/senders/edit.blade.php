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
                    @if(session('warning'))
                        <div class="alert alert-success">
                            {{ session('warning') }}
                        </div>
                    @endif
                    <div class="card-header bg-primary" style="color:#fff;">
                        <h3>Email Sender Application</h3>
                        <span style="float:right;top:-30px;position:relative;">
                            Xoş Gəldiniz : {{ Auth::user()->name }}
                            <a href="{{ route('auth.cixis') }}" style="color:#fff;">(Çıxış)</a>
                        </span>
                    </div>
                    <form action="{{ route('senders.update',['id'=>$data[0]['id']]) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>E-Mail</label>
                                <select name="email[]" multiple class="form-control">
                                    @foreach(json_decode($data[0]['email'],true) as $k => $v)
                                        <option value="{{ $v }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Həftənin günü</label>
                                <select name="week_day" class="form-control">
                                    <option value="Monday">Bazar ertəsi</option>
                                    <option value="Tuesday">Çərşənbə axşamı</option>
                                    <option value="Wednesday">Çərşənbə</option>
                                    <option value="Thursday">Cümə axşamı</option>
                                    <option value="Friday">Cümə</option>
                                    <option value="Saturday">Şənbə</option>
                                    <option value="Sunday">Bazar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Saat</label>
                                <input type="time" name="time" value="{{ $data[0]['time'] }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mövzu</label>
                                <input type="text" name="subject" class="form-control" value="{{ $data[0]['subject'] }}">
                            </div>
                            <div class="form-group">
                                <label>Mesaj</label>
                                <textarea name="text" cols="30" rows="5" class="form-control">{{ $data[0]['text'] }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Redaktə et</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
