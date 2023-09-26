@extends('layouts.admin')

@section('content')
    @if($errors->any())
        {{ implode('', $errors->all(':message')) }}
    @endif
    <form action="{{route('admin.login')}}" method="POST">
        @csrf
        <label>
            <input type="email" name="email" placeholder="E-mail">
        </label>
        <label>
            <input type="password" name="password" placeholder="Password">
        </label>
        <button>Login</button>
    </form>
@endsection
