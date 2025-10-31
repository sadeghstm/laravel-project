@extends('layouts.app')

@section('title', 'لیست کاربران')

@section('content')
<div style="max-width: 900px; margin: 40px auto;">

    <a href="{{ route('users.create') }}" 
       style="display:inline-block; padding:10px 20px; background-color:#28a745; color:white; border-radius:4px; text-decoration:none; margin-bottom:20px;">
       ایجاد کاربر جدید
    </a>

    <table style="width:100%; border-collapse: collapse; background-color:#fff; box-shadow:0 0 5px rgba(0,0,0,0.1);">
        <thead style="background-color:#007bff; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">شناسه</th>
                <th style="padding:10px; text-align:left;">نام</th>
                <th style="padding:10px; text-align:left;">ایمیل</th>
                <th style="padding:10px; text-align:left;">عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $user['id'] }}</td>
                    <td style="padding:10px;">{{ $user['name'] }}</td>
                    <td style="padding:10px;">{{ $user['email'] }}</td>
                    <td style="padding:10px;">
                        <a href="{{ route('users.show', $user['id']) }}" style="padding:5px 10px; background-color:#17a2b8; color:white; border-radius:4px; text-decoration:none; margin-right:5px;">نمایش</a>
                        <a href="{{ route('users.edit', $user['id']) }}" style="padding:5px 10px; background-color:#6c757d; color:white; border-radius:4px; text-decoration:none; margin-right:5px;">ویرایش</a>
                        <form action="{{ route('users.destroy', $user['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')" 
                                    style="padding:5px 10px; background-color:#dc3545; color:white; border:none; border-radius:4px; cursor:pointer;">
                                حذف
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:20px;">هیچ کاربری یافت نشد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
