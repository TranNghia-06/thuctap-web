@extends('layouts.app')

@section('title')
    {{ __('Danh sách bài viết') }}
@endsection

@php
    $searching = request()->get('q') ?? '';
@endphp

@section('content')
    
@endsection
