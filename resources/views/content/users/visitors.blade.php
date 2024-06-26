@extends('layouts/contentNavbarLayout')
@section('title', 'Այցելուներ - Ցանկ')
@section('page-script')
    <script src="{{ asset('assets/js/change-status.js') }}"></script>
    <script src="{{ asset('assets/js/delete-item.js') }}"></script>
@endsection

@section('content')

    <h4 class="py-3 mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Այցելուներ</a>
                </li>
                <li class="breadcrumb-item active">Ցանկ</li>
            </ol>
        </nav>
    </h4>
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-header">Այցելուների ցանկ</h5>
            </div>

        </div>
        <div class="card-body">

                <div>
                    <form action="{{route('users_visitors')}}" method="get" class="row g-3 mt-2" style="display: flex">
                        <div class="mb-3 justify-content-end" style="display: flex; gap: 8px">
                            <div class="col-2">
                                <input type="text" class="form-control" id="name" placeholder="Անուն" name="name" value="{{ request()->input('name') }}">
                            </div>

                            <div class="col-2">
                                <input type="text" class="form-control" id="surname" placeholder="Ազգանուն" name="surname" value="{{ request()->input('surname') }}">
                            </div>

                            <div class="col-2">
                                <input type="text" class="form-control" id="inputEmail" placeholder="Էլ․ հասցե" name="email" value="{{ request()->input('email') }}">
                            </div>

                            <div class="col-2">
                                <input type="text" class="form-control" id="inputPhone" placeholder="Հեռախոս" name="phone" value="{{ request()->input('phone') }}">
                            </div>

                            <button class="btn btn-primary col-2">Որոնել</button>

                        </div>
                    </form>
                </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Անուն</th>
                            <th>Ազգանուն</th>
                            <th>Էլ․ հասցե</th>
                            <th>Հեռախոս</th>
                            <th>Կարգավիճակ</th>
                            <th>Դերեր</th>
                            <th>Գործողություն</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td class="status">
                                    @if ($user->status)
                                        <span class="badge bg-label-success me-1">Ակտիվ</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">Ապաակտիվ</span>
                                    @endif
                                </td>

                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <label>{{ __("roles.$v") }}</label>
                                        @endforeach
                                    @endif
                                </td>

                                <td>
                                    <div class="dropdown action" data-id="{{ $user->id }}" data-tb-name="users">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex" href="javascript:void(0);">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input change_status" type="checkbox"
                                                        role="switch" data-field-name="status"
                                                        {{ $user->status ? 'checked' : null }}>
                                                </div>Կարգավիճակ
                                            </a>

                                                <a class="dropdown-item" href="{{route('users.show', $user->id)}}"><i
                                                    class="bx bx-edit-alt me-1"></i>Դիտել</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="demo-inline-spacing">
                {{ $data->links() }}
            </div>
        </div>
    </div>


@endsection

<x-modal-delete></x-modal-delete>
