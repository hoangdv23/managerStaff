<div>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Danh sách Jobs</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Tổng số <b>{{ number_format($listJobs->links()->paginator->total(), 0) }}</b> jobs.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input wire:model.debounce.500ms="search" id="search" type="search"
                                                        class="form-control" id="default-04"
                                                        placeholder="Từ khóa tìm kiếm" autocomplete="off">
                                                </div>
                                            </li>
                                            <li>
                                                <div class="drodown">
                                                    <a href="javascript:void(0);"
                                                        class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                        data-bs-toggle="dropdown">
                                                        <em class="d-none d-sm-inline icon ni ni-user-c"></em>
                                                        <span>{{ $selected_editor ?? 'Chọn Editor' }}</span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end style-scrollbar">
                                                        <ul class="link-list-opt no-bdr scrollbar_custom">
                                                            <li><a href="javascript:void(0);"  wire:click="filterEditor(null,'Xem tất cả')" >Xem tất cả</a></li>
                                                            @foreach($editorList as $item)
                                                            <li><a href="javascript:void(0);"
                                                                    wire:click="filterEditor('{{ $item['id'] }}', '{{ $item['name'] }}')"><span>{{ $item['name'] }}</span></a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="drodown">
                                                    <a href="javascript:void(0);"
                                                        class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                        data-bs-toggle="dropdown">
                                                        <em class="d-none d-sm-inline icon ni ni-user-check"></em>
                                                        <span>{{ $selected_QC ?? 'Chọn QC' }}</span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end style-scrollbar">
                                                        <ul class="link-list-opt no-bdr scrollbar_custom">
                                                            <li><a href="javascript:void(0);" wire:click="filterQC(null,'Xem tất cả')">Xem tất cả</a></li>
                                                            @foreach($QCList as $item)
                                                            <li><a href="javascript:void(0);"
                                                                    wire:click="filterQC('{{ $item['id'] }}', '{{ $item['name'] }}')"><span>{{ $item['name'] }}</span></a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="drodown">
                                                    <a href="javascript:void(0);"
                                                        class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                        data-bs-toggle="dropdown">
                                                        <em class="d-none d-sm-inline icon ni ni-clipboad-check-fill"></em>
                                                        <span>{{ $selected_status ?? 'Status' }}</span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end style-scrollbar">
                                                        <ul class="link-list-opt no-bdr scrollbar_custom">                                                            
                                                            <li><a href="javascript:void(0);"  wire:click="filterEditor(null,'Status')" >Xem tất cả</a></li>
                                                            <li><a href="javascript:void(0);"  wire:click="filterEditor(1,'PROCESS')" >PROCESS</a></li>
                                                            <li><a href="javascript:void(0);"  wire:click="filterEditor(0,'REJECT')" >REJECT</a></li>
                                                            <li><a href="javascript:void(0);"  wire:click="filterEditor(2,'DONE')" >DONE</a></li>
                                                            <li><a href="javascript:void(0);"  wire:click="filterEditor(3,'APPROVE')" >APPROVE</a></li>
                                                            <li><a href="javascript:void(0);"  wire:click="filterEditor(4,'SENT')" >SENT</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            @can('user-create')
                                            <li class="nk-block-tools-opt">
                                                <div class="drodown">
                                                    <a href="{{route('jobs.create')}}" class="btn btn-primary"><em class=" icon ni ni-plus btn-icon"></em><span>Thêm jobs mới</span></a>
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
                        
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="nowrap table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Khách hàng</th>
                                            <th>Loại dịch vụ</th>
                                            <th>Ghi chú</th>
                                            <th>Actions</th>
                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($listJob) --}}
                                        @foreach ($listJobs as $listJob)
                                        <tr>
                                            <td>{{ $listJob['name']}}</td>
                                            <td >{{ Modules\Customers\Entities\Customer::where('id',$listJob['customer_id'])->value('name')}}</td>
                                            <td>
                                                @foreach ($listJob->types as $type)
                                                {{-- Cái này ở bảng Job->> link với bảng type --}}
                                                {{-- class="badge rounded-pill badge-sm " style="background-color: {{colorType($listJob['type_service_id'])}} !important" --}}
                                                <span style="color: {{ $type->color }} !important;">{{ $type->name }}</span><br>
                                                @endforeach
                                            </td>
                                            <td>{{ $listJob['note']}}</td>

                                            <td>
                                                @include('jobs::tables.actions.button', ['id' => $listJob['id']])
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    
                                </table>
                                <div class="card-inner">
                                    <div class="nk-block-between-md g-3">
                                        {{ $listJobs->links() }}
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>

