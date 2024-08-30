<div>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Báo cáo công việc theo <code>{{$selected_editor ?? 'Tất cả khách hàng'}}</code></h3>
                                <div class="nk-block-des text-soft">
                                    <p>Tổng số <b>{{ number_format($customerList->links()->paginator->total(), 0) }}</b> jobs.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="input-daterange date-picker-range input-group">
                                                            <input type="text" id="site-startday" autocomplete="off" class="form-control date-picker @error('startday') error @enderror" wire:model.lazy="startday" placeholder="{{ __('Start Day') }}" data-date-format="yyyy-mm-dd">
                                                            <div class="input-group-addon">TO</div>
                                                            <input type="text" id="site-stopday" autocomplete="off" class="form-control date-picker @error('stopday') error @enderror" wire:model.lazy="stopday" placeholder="{{ __('Stop Day') }}" data-date-format="yyyy-mm-dd">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="drodown">
                                                    <a href="javascript:void(0);"
                                                        class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                        data-bs-toggle="dropdown">
                                                        <em class="d-none d-sm-inline icon ni ni-user-c"></em>
                                                        <span>{{ $selected_editor ?? 'Chọn khách hàng' }}</span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end style-scrollbar">
                                                        <ul class="link-list-opt no-bdr scrollbar_custom">
                                                            <li><a href="javascript:void(0);"  wire:click="filterEditor(null,'Xem tất cả')" >Xem tất cả</a></li>
                                                            @foreach($editorList as $item)
                                                            <li><a href="javascript:void(0);"
                                                                    wire:click="filterEditor('{{ $item['id'] }}', '{{ $item['name'] }}')"><span>{{ $item['code'] }}</span></a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <div class="drodown">
                                                    <a href="javascript:void(0);" wire:click="exportCustomers" class="btn btn-primary"><em class=" icon ni ni-download btn-icon"></em><span>Xuất Excel</span></a>
                                                </div>
                                            </li>
                                            {{-- <li>
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
                                            </li> --}}
                                            {{-- <li>
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
                                            </li> --}}
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

                                            <th>Ngày tạo job</th>
                                            <th>Tên jobs</th>
                                            {{-- <th>Tên Khách hàng</th> --}}
                                            @foreach ($listType as $key)
                                              <!-- dùng as như này, thì nó sẽ set key = mảng luôn (1)-->
                                            <th>{{$key['name']}}</th>
                                            @endforeach
                                            <th>Thành tiền</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customerList as $cusLists)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($cusLists['created_at'])->format('d-m-Y') }}</td>
                                            {{-- <td>{{ $cusLists['name']}}</td> --}}
                                            <td>{!!getNameJobByID($cusLists['job_id'])!!}</td>

                                            {{-- <td>{!!getNameCustomerByID($cusLists['customer_id'])!!}</td> --}}
                                            @foreach ($listType as $key)
                                            <td>{!!hasTypeServices($key['id'],$cusLists['id'])!!}</td>
                                                   <!-- dùng helper nhiều vào -->
                                            @endforeach
                                            <td>{!!invoiceCustomer($cusLists['id'])!!}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    
                                </table>
                                <div class="card-inner">
                                    <div class="nk-block-between-md g-3">
                                        {{ $customerList->links() }}
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
			   $('#site-stopday').on('change', function (e) {
                  @this.set('stopday', e.target.value);
             });
			 $('#site-starttime').on('change', function (e) {
                  @this.set('starttime', e.target.value);
             });
			

            $('#site-stoptime').on('change', function (e) {
               @this.set('stoptime', e.target.value);
           });
		    
			  $('#site-startday').on('change', function (e) {
                  @this.set('startday', e.target.value);
             });
			   $('#site-stopday').on('change', function (e) {
                  @this.set('stopday', e.target.value);
             });  
	        
        });
    </script>
</div>

