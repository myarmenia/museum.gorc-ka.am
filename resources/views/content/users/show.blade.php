@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('content')


<h4 class="py-3 mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('users.index')}}">Օգտագործողներ</a>
            </li>
            <li class="breadcrumb-item active">Դիտել օգտատիրոջը</li>
        </ol>
    </nav>
</h4>

<div class="card">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="card-header">Դիտել օգտատիրոջը</h4>
        </div>

    </div>
    <div class="card-body">

        {{-- <form action="{{route('users.update', $user->id)}}" method="post"> --}}

            <div class="mb-3 row">
                <label for="name" class="col-md-2 col-form-label">Անուն  </label>
                <div class="col-md-10">{{$user->name ?? ''}}
                </div>
            </div>


            <div class="mb-3 row">
                <label for="surname" class="col-md-2 col-form-label">Ազգանուն</label>
                <div class="col-md-10">
                    {{$user->surname ?? ''}}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-md-2 col-form-label">Էլ․ հասցե</label>
                <div class="col-md-10">
                    {{$user->email ?? ''}}

                </div>
            </div>


            <div class="mb-3 row">
                <label for="phone" class="col-md-2 col-form-label">Քաղաքացիություն</label>
                <div class="col-md-10">
                   {{$user->phone ?? ''}}

                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-md-2 col-form-label">Սեռ</label>
                <div class="col-md-10">
                      {{$user->gender ?? ''}}

                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-md-2 col-form-label">Ծննդյան ամսաթիվ</label>
                <div class="col-md-10">
                   {{$user->birth_date ?? ''}}

                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-md-2 col-form-label">Հեռախոս</label>
                <div class="col-md-10">
                   {{$user->phone ?? ''}}

                </div>
            </div>





            <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label"></label>
                <div class="d-flex col-md-10">
                    <div class="col-md-2 form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="status" {{$user->status ? 'checked' : ''}} name="status" disabled>
                        <label class="form-check-label" for="status">Կարգավիճակ</label>
                    </div>

                </div>
            </div>

        {{-- </form> --}}
    </div>


</div>


@endsection
