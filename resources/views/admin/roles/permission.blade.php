{{-- mainPermissions --}}
<div class="card-body">
    <h4 class="card-title">@lang('admin.Permissions')</h4>
    <p class="card-description"></p>
    <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">

        @if (!empty($mainPermissions))
            @php
                $i = 0;
            @endphp
            @foreach ($mainPermissions as $mainPermission)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : '' }}" id="pills-{{ $mainPermission->id }}-tab"
                        data-bs-toggle="pill" href="#pills-{{ $mainPermission->id }}" role="tab"
                        aria-controls="pills-{{ $mainPermission->id }}" aria-selected="true">
                        {{ __('admin.' . $mainPermission->title) }}
                    </a>
                </li>
                @php
                    $i++;
                @endphp
            @endforeach

        @endif
    </ul>
    <div class="tab-content" id="pills-tabContent">

        @if (!empty($mainPermissions))
            @php
                $i = 0;
            @endphp
            @foreach ($mainPermissions as $mainPermission)
                <div class="tab-pane fade {{ $i == 0 ? 'active show' : '' }} " id="pills-{{ $mainPermission->id }}"
                    role="tabpanel" aria-labelledby="pills-{{ $mainPermission->id }}-tab">
                    <div class="row">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-danger">
                                    <th>{{ __('admin.ModuleTitle') }}</th>
                                    @if (in_array(0, $mainPermission->permissions_types))
                                        <th>
                                            {{ __('admin.List') }}
                                        </th>
                                    @endif
                                    @if (in_array(1, $mainPermission->permissions_types))
                                        <th>
                                            {{ __('admin.Show') }}
                                        </th>
                                    @endif
                                    @if (in_array(2, $mainPermission->permissions_types))
                                        <th>
                                            {{ __('admin.Create') }}
                                        </th>
                                    @endif
                                    @if (in_array(3, $mainPermission->permissions_types))
                                        <th>
                                            {{ __('admin.Edit') }}
                                        </th>
                                    @endif
                                    @if (in_array(4, $mainPermission->permissions_types))
                                        <th>
                                            {{ __('admin.Delete') }}
                                        </th>
                                    @endif
                                    @if (in_array(5, $mainPermission->permissions_types))
                                        <th>
                                            {{ __('admin.ChangeStatus') }}
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($mainPermission->children))
                                    @foreach ($mainPermission->children as $row)
                                        <tr>
                                            <td>
                                                {{ __('admin.' . $row->title) }}

                                            </td>
                                            @if (!empty($mainPermission->permissions_types))
                                                @foreach ($mainPermission->permissions_types as $td)
                                                    <td>
                                                        @if (!empty($row->sub_permissions_arr[$td]))
                                                            <input type="checkbox"
                                                                value="{{ $row->sub_permissions_arr[$td] }}"
                                                                name="permissions[]"
                                                                {{ in_array($row->sub_permissions_arr[$td], old('permissions', $item->permissions_ids ?? [])) ? 'checked' : '' }} />
                                                        @endif
                                                    </td>
                                                @endforeach
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach

        @endif

    </div>
</div>
