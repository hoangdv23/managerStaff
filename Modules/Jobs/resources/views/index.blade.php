@extends('admin::layouts.master')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Jobs list</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        {{--<li><a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>--}}
                                        @can('user-create')
                                        {{-- @include('jobs::type') --}}
                                        <li class="nk-block-tools-opt">
                                            <div class="drodown">
                                                <a href="{{route('jobs.create')}}" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                            </div>
                                        </li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <livewire:jobs::index-page />
                    <livewire:jobs::edit-page />
                    <livewire:jobs::storage-page />

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection