@extends('admin::layouts.master')
@section('content')
<div class="nk-content">
    <div class="components-preview wide-md mx-auto">
        <livewire:roles::edit-page :role="$id"/>
        </div>
    </div>

    @endsection