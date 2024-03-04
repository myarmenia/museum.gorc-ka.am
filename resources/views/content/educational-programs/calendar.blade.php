@extends('layouts/contentNavbarLayout')
@section('page-script')
    {{-- <script>
    let student_id = {{ $student->id }}
</script> --}}

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src="{{ asset('assets/js/admin/calendar.js') }}"></script>
    {{-- <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'> --}}
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.11/locales-all.global.min.js'></script>
    <link href="{{ asset('assets/css/admin/calendar.css') }}" rel='stylesheet' />
@endsection
@section('content')
    <h4 class="py-3 mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('educational_programs_list') }}">Կրթական ծրագրեր</a>
                </li>
                <li class="breadcrumb-item active">Ստեղծել նոր ծրագիր</li>

            </ol>
        </nav>
    </h4>


    <div class="row">
        <div class="col-8">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Basic Layout</h5> <small class="text-muted float-end">Default label</small>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>

                </div>
            </div>

        </div>
        <div class="col-4">

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Նոր ամրագրում</h5>
                </div>
                <div class="card-body">
                    <form id="reserve">
                        <div class="mb-3">
                            <label class="form-label" for="educational_program_id">Ծրագրի տեսակը</label>
                            <select id="educational_program_id" name="educational_program_id" class="form-select"
                                value="">
                                <option value="" disabled selected>Ծրագրի տեսակը</option>

                                @foreach (museumEducationalPrograms() as $item)
                                    <option value="{{ $item->id }}">{{ __('logs.store') }}</option>
                                @endforeach
                                <option value="0">Էքսկուրսիա</option>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="date">Այցելության օրը</label>
                            <input type="date" class="form-control" id="date" placeholder="Այցելության օրը"
                                name="date">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="time">Այցելության ժամը</label>
                            <input type="time" class="form-control" id="time" placeholder="Այցելության ժամը"
                                name="time">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="visitor_quantity">Այցելության քանակը</label>
                            <input type="text" class="form-control" id="visitor_quantity"
                                placeholder="Այցելության քանակը" name="visitor_quantity">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Մանրամասներ</label>
                            <textarea id="description" class="form-control" placeholder="Մանրամասներ" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Ամրագրել</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
