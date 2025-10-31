@extends('layouts.app')

@section('title', 'جزئیات کاربر')

@section('content')
    <p><strong>شناسه:</strong> {{ $user['id'] }}</p>
    <p><strong>نام:</strong> {{ $user['name'] }}</p>
    <p><strong>ایمیل:</strong> {{ $user['email'] }}</p>
    <br>
    <a href="{{ route('users.index') }}" class="btn btn-primary">بازگشت به لیست</a>
@endsection