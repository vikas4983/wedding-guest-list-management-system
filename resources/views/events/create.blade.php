@extends('layouts.main-app')
@section('title', 'Add Event')
@section('content')
    <style>
        #guestsTable.table-hover tbody tr:hover {
            background-color: #F2F2F2 !important;
        }

        #guestsTable.table-hover tbody tr:hover td {
            color: #000000 !important;
            font-weight: 600 !important;
            text-decoration: none !important;
        }
    </style>
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :parent-route="['name' => 'Events', 'url' => route('events.index')]" :current-route="['name' => 'Create', 'url' => null]" />

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    @include('alerts.alert')
                    <div class="text-center mb-5">
                        <h3>{{ __('labels.event_title') }}</h3>
                    </div>
                    <form id="createGuest" action="{{ route('events.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6  mt-5">
                                <label for="name" class="font-weight-medium">{{ __('labels.event_name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror col-lg-6"
                                    id="name" name="name" placeholder="{{ __('labels.event_name_placeholder') }}"
                                    value="{{ old('name') }}" inputmode="\d{30}" maxlength="30" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6  mt-5">
                                <div class="form-group  d-flex justify-content-between align-items-right">
                                    <label for="is_active" class="font-weight-medium mb-5">{{ __('labels.status') }}</label>
                                    <div class="switch-container">
                                        <div class="row mt-5 " style="width:300px">
                                            <label class="switch switch-text switch-primary switch-pill form-control-label">
                                                <input type="checkbox" name="is_active" id="is_active"
                                                    class="switch-input form-check-input" value="1">
                                                <span class="switch-label" data-on="ON" data-off="OFF"></span>
                                                <span class="switch-handle"></span>
                                            </label>
                                        </div>
                                    </div>
                                    @error('is_active')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col text-center">
                                <button type="submit" id="submitBtn" title="{{ __('titles.add_event') }}"
                                    class="btn btn-primary">{{ __('buttons.create') }}</button>
                            </div>
                        </div>
                    </form>
                    <div id="success_message" style="color:green;margin-top:10px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection



{{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('#createGuest');

                function showError(input, message) {
                    if (!input) return;
                    input.classList.add('is-invalid');
                    const fb = input.closest('.form-group')?.querySelector('.invalid-feedback');
                    if (fb) fb.textContent = message;
                }

                function clearErrors() {
                    form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));
                    form.querySelectorAll('.invalid-feedback').forEach(fb => fb.textContent = '');
                }

                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    clearErrors();

                    const formData = new FormData(form);

                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                       
                        if (response.status === 422) {
                            const payload = await response.json(); 
                            const errors = payload.errors || {};
                            for (const key in errors) {
                                const input = form.querySelector(`[name="${key}"]`);
                                if (input) showError(input, errors[key][0]);
                            }
                            // optional: focus first invalid field
                            const firstInvalid = form.querySelector('.is-invalid');
                            if (firstInvalid) firstInvalid.focus();
                            return; 
                        }

                        if (!response.ok) {
                            // other http errors
                            const txt = await response.text();
                            throw new Error(txt || 'Network response was not ok');
                        }

                        // success
                        const data = await response.json();
                        toastr.success(data.message || 'Success', 'Success');
                        form.reset();

                    } catch (err) {
                        // network/unexpected errors
                        if (err instanceof Error) {
                            toastr.error(err.message || 'Something went wrong', 'Failed');
                        } else {
                            // unlikely here, but keep fallback
                            toastr.error('Unexpected error', 'Failed');
                        }
                    }
                });
            });
        </script> --}}
