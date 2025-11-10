@extends('layouts.main-app')
@section('title', 'Invitation')
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
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :parent-route="['name' => 'Guests', 'url' => route('guests.index')]" :current-route="['name' => 'Create', 'url' => null]" />
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    @include('alerts.alert')
                    <div class="text-center mb-5">
                        <h3>{{ __('labels.guest_title') }}</h3>
                    </div>
                    <form id="createGuest" action="{{ route('guests.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="name" class="font-weight-medium">{{ __('labels.guest_name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="{{ __('labels.guest_name_placeholder') }}"
                                    value="{{ old('name') }}" inputmode="\d{30}" maxlength="30" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="email" class="font-weight-medium">{{ __('labels.guest_email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="{{ __('labels.guest_email_placeholder') }}"
                                    value="{{ old('email') }}" inputmode="\d{50}" maxlength="50" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="guest_phone" class="font-weight-medium">{{ __('labels.guest_phone') }}</label>
                                <input type="number" maxlength="10"
                                    oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);"
                                    class="form-control @error('phone')
is-invalid
@enderror" id="phone" name="phone"
                                    placeholder="{{ __('labels.guest_phone_placeholder') }}" value="{{ old('phone') }}"
                                    required>
                                <div class="invalid-feedback"></div>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="event" class="font-weight-medium">{{ __('labels.event_name') }}</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <span style="margin-left: 1.5rem;"><input class="form-check-input" type="checkbox"
                                                id="allEvent" name="event_ids[]" checked="checked" value="0"
                                                id="defaultCheck1">
                                            <label class="form-check-label mr-5" for="defaultCheck1">
                                                All
                                            </label></span>
                                    </div>
                                    @foreach ($data['events'] as $event)
                                        <div class="col-lg-3">
                                            <span style="margin-left: 1.5rem;">
                                                <input class="form-check-input selectEvent" type="checkbox"
                                                    name="event_ids[]" value="{{ $event->id }}"
                                                    id="event_{{ $event->id }}">
                                                <label class="form-check-label" for="event_{{ $event->id }}">
                                                    {{ ucfirst($event->name) }}
                                                </label>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const allEvent = document.querySelector('#allEvent');
                                    const selectedEvent = document.querySelectorAll('.selectEvent');
                                    const selectedcb = allEvent.checked ? [allEvent.value] : [''];
                                    allEvent.addEventListener('change', function() {
                                        selectedEvent.forEach(cb => cb.checked = false);
                                    });
                                    selectedEvent.forEach(cb => {
                                        cb.addEventListener('change', function() {
                                            allEvent.checked = false;
                                        });
                                    });
                                });
                            </script>

                        </div>
                        <div class="row mt-5">
                            <div class="col text-center">
                                <button type="submit" id="submitBtn" title="{{ __('titles.add_guest') }}"
                                    class="btn btn-primary">{{ __('buttons.create') }}</button>
                            </div>
                        </div>
                    </form>
                    <div id="success_message" style="color:green;margin-top:10px;"></div>
                </div>
            </div>
        </div>


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



    </div>
@endsection
