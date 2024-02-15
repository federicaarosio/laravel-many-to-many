@extends('admin.projects.layouts.create-or-edit')

@section('page-title', 'Edit a project')

@section('form-action')
    {{ route('admin.projects.update', $project) }}
@endsection

@section('form-method')
    @method('PUT')
@endsection