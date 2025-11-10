@extends('layouts.main-app')
@section('title', 'Add Card')
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
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :parent-route="['name' => 'Cards', 'url' => route('cards.index')]" :current-route="['name' => 'Create', 'url' => null]" />
    <span></span>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    @include('alerts.alert')
                    <div class="text-center mb-5">
                        <h3>{{ __('labels.card_title') }}</h3>
                    </div>
                    <form id="createGuest" action="{{ route('cards.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-3 mt-5">
                                <label for="event_id" class="font-weight-medium">{{ __('labels.card_name') }}</label>
                                <select class="form-control @error('event_id') is-invalid @enderror" name="event_id"
                                    id="event_id">
                                    @foreach ($data['events'] as $event)
                                        <option value="{{ $event->id }}"
                                            {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                            {{ ucfirst($event->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('event_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 mt-5">
                                <label for="image" class="font-weight-medium">{{ __('labels.card_image') }}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" id="image" value="{{ old('image') }}">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-3 mt-5">
                                <label for="date" class="font-weight-medium">{{ __('labels.card_date') }}</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    name="date" id="date" value="{{ old('date') }}" required>
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-3 mt-5">
                                <label for="time" class="font-weight-medium">{{ __('labels.card_time') }}</label>
                                <input type="time" class="form-control  @error('time') is-invalid @enderror"
                                    name="time" id="time" step="60" value="{{ old('time') }}" required>
                                @error('time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-3 mt-5">
                                <label for="title" class="font-weight-medium">{{ __('labels.card_title_name') }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title"
                                    placeholder="{{ __('labels.card_title_name_placeholder') }}"
                                    value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-3 mt-5">
                                <label for="location" class="font-weight-medium">{{ __('labels.card_location') }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="location" id="location"
                                    placeholder="{{ __('labels.card_location_placeholder') }}"
                                    value="{{ old('location') }}">
                                @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-3 mt-5">
                                <label for="address" class="font-weight-medium">{{ __('labels.card_address') }}</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" id="address" placeholder="{{ __('labels.card_address_placeholder') }}"
                                    value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-3 mt-5">
                                <label for="description"
                                    class="font-weight-medium">{{ __('labels.card_description') }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="description" id="description"
                                    placeholder="{{ __('labels.card_description_placeholder') }}"
                                    value="{{ old('description') }}">
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-3 mt-5">
                                <label for="theme_color"
                                    class="font-weight-medium">{{ __('labels.card_theme_color') }}</label>
                                <input type="text" class="form-control @error('theme_color') is-invalid @enderror"
                                    name="theme_color" id="theme_color"
                                    placeholder="{{ __('labels.card_theme_color_placeholder') }}"
                                    value="{{ old('theme_color') }}">
                                @error('theme_color')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-3 mt-5">
                                <label for="rsvp_link" class="font-weight-medium">{{ __('labels.card_rsvp_link') }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="rsvp_link" id="rsvp_link"
                                    placeholder="{{ __('labels.card_rsvp_link_placeholder') }}"
                                    value="{{ old('rsvp_link') }}">
                                @error('rsvp_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6  mt-5">
                                <div class="form-group  d-flex justify-content-between align-items-right">
                                    <label for="is_active"
                                        class="font-weight-medium mb-5">{{ __('labels.status') }}</label>
                                    <div class="switch-container">
                                        <div class="row mt-5 " style="width:300px">
                                            <label
                                                class="switch switch-text switch-primary switch-pill form-control-label">
                                                <input type="checkbox" name="is_active" id="is_active"
                                                    class="switch-input form-check-input" value="1" required>
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
                        <div class="row">
                            <div class="form-group col-lg-12 mt-5">
                                <label for="html" class="font-weight-medium">{{ __('labels.card_html') }}</label>

                                <textarea name="html" class="form-control" id="html" cols="5" rows="5"
                                    value="{{ old('html') }}" required>{{ __('labels.card_html_placeholder') }}</textarea>
                                @error('html')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col text-center">
                                <button type="submit" id="submitBtn" title="{{ __('titles.add_card') }}"
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
