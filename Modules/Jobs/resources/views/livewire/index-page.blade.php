

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class=" nowrap table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Khách hàng</th>
                        <th>Loại dịch vụ</th>
                        <th>Assignee</th>
                        <th>Photographer</th>
                        <th>Start date</th>
                        <th>Status</th>
                        <th>Originals</th>
                        <th>Incomplete</th>
                        <th>Compeled</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($listJob) --}}
                    @foreach ($listJob as $listJob)
                    <tr>
                        <td>{{ $listJob['name']}}</td>
                        <td>{{ Modules\Customers\Entities\Customer::where('id',$listJob['customer_id'])->value('name')}}</td>
                        @php
                        //    $abc =  Modules\Jobs\Entities\Jobs_have_type_service::where('job_id',$listJob['id'])->innerjoin(Modules\Jobs\Entities\Type_service) on Type_service.id = Jobs_have_type_service.type_service_id ->get(Type_service.name)
                        @endphp
                        <td>{!! $listJob->types->pluck('name')->implode('<br>') !!}</td>
                        <td>{{ Modules\Users\Entities\User::where('id', $listJob['user_id'])->value('name') ?? 'Chưa phân' }}</td>
                        <td>{{ Modules\Users\Entities\User::where('id', $listJob['marketing_user_id'])->value('name') ?? 'Chưa phân' }}</td>
                        <td>{{ $listJob['start_date']}}</td>
                        <td>{{ $listJob['status']}}</td>
                        <td>
                            @if ($listJob['fixed_link'] !== null)
                                {{-- Nếu fixed_link có giá trị, hiển thị một liên kết --}}
                                <a href="{{ $listJob['fixed_link'] }}">Original Link</a>
                            @else
                                {{-- Nếu không có fixed_link, hiển thị văn bản --}}
                                Chưa có
                            @endif
                        </td>
                        <td>
                            @if ($listJob['edited_link'] !== null)
                                {{-- Nếu fixed_link có giá trị, hiển thị một liên kết --}}
                                <a href="{{ $listJob['edited_link']}}">Incomplete Link</a>
                            @else
                                {{-- Nếu không có fixed_link, hiển thị văn bản --}}
                                Chưa có
                            @endif
                        </td>
                        <td>
                            @if ($listJob['checked_link'] !== null)
                                {{-- Nếu fixed_link có giá trị, hiển thị một liên kết --}}
                                <a href="{{ $listJob['checked_link'] }}">Compeled Link</a>
                            @else
                                {{-- Nếu không có fixed_link, hiển thị văn bản --}}
                                Chưa có
                            @endif
                        </td>
                        <td>
                            @include('jobs::tables.actions.button', ['id' => $listJob['id']])
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
