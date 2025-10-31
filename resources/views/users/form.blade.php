@extends('layouts.app')

@section('title', isset($user) ? 'ویرایش کاربر' : 'ایجاد کاربر جدید')

@section('content')
<div style="max-width: 600px; margin: 40px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
    <h2 style="margin-bottom: 20px; text-align: center;">
        {{ isset($user) ? 'ویرایش کاربر' : 'ایجاد کاربر جدید' }}
    </h2>

    <form action="{{ isset($user) ? route('users.update', $user['id']) : route('users.store') }}" method="POST">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif

        <div style="margin-bottom: 15px;">
            <label for="name" style="display:block; margin-bottom:5px; font-weight:bold;">نام:</label>
            <input type="text" id="name" name="name" value="{{ $user['name'] ?? '' }}" required
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email" style="display:block; margin-bottom:5px; font-weight:bold;">ایمیل:</label>
            <input type="email" id="email" name="email" value="{{ $user['email'] ?? '' }}" required
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" style="padding: 10px 20px; background-color:#007bff; color:white; border:none; border-radius:4px; cursor:pointer;">
                {{ isset($user) ? 'به‌روزرسانی' : 'ذخیره' }}
            </button>
            <a href="{{ route('users.index') }}" style="padding: 10px 20px; background-color:#6c757d; color:white; border-radius:4px; text-decoration:none; margin-left:10px;">
                انصراف
            </a>
        </div>
    </form>
</div>
@endsection
