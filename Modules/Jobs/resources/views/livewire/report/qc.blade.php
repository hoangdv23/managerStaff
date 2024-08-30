<div>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Báo cáo công việc theo <code>QC</code></h3>
                                <div class="nk-block-des text-soft">
                                    {{-- <p>Tổng số <b>{{ number_format($listJobs->links()->paginator->total(), 0) }}</b> jobs.</p> --}}
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
                                                            {{-- @foreach($editorList as $item)
                                                            <li><a href="javascript:void(0);"
                                                                    wire:click="filterEditor('{{ $item['id'] }}', '{{ $item['name'] }}')"><span>{{ $item['name'] }}</span></a>
                                                            </li>
                                                            @endforeach --}}
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
                                                            {{-- @foreach($QCList as $item)
                                                            <li><a href="javascript:void(0);"
                                                                    wire:click="filterQC('{{ $item['id'] }}', '{{ $item['name'] }}')"><span>{{ $item['name'] }}</span></a>
                                                            </li>
                                                            @endforeach --}}
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
                                            {{-- <th>Ngày tạo</th> --}}
                                            <th>Khách hàng</th>
                                            <th>Tổng Jobs</th>
                                            <th>Số lượng Ảnh</th>
                                            <th>Tổng thanh toán</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($customerList) --}}
                                        {{-- @foreach ($customerList as $cusLists)
                                        <tr>
                                            <td>{{ $cusLists['code']}}</td>
                                            <td >{{ Modules\Jobs\Entities\Job::where('customer_id',$cusLists['id'])->sum('id')}}</td>
                                            <td >{{ Modules\Jobs\Entities\Jobs_have_type_service::where('customer_id',$cusLists['id'])->where('status','3')->sum('amount')}}</td>
                                            <td>{{ number_format(Modules\Jobs\Entities\Jobs_have_type_service::where('customer_id', $cusLists['id'])->where('status','3')->sum('total_price'), 0, ',', '.') }}</td>
                                            <td>
                                                @include('jobs::tables.actions.button_detail', ['id' => $cusLists['id']])
                                            </td>
                                        </tr>
                                        @endforeach --}}
                                        
                                    </tbody>
                                    
                                </table>
                                <div class="card-inner">
                                    <div class="nk-block-between-md g-3">
                                        {{-- {{ $listJobs->links() }} --}}
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

