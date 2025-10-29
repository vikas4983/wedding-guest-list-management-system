<form id="updateGuest" action="{{ route('guests.update', $objectdata->id) }}" method="post">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="form-group col-lg-6">
            <label for="name" class="font-weight-medium">{{ __('labels.guest_name') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                placeholder="{{ __('labels.guest_name_placeholder') }}" value="{{ $objectdata->name }}"
                inputmode="\d{30}" maxlength="30" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-lg-6">
            <label for="email" class="font-weight-medium">{{ __('labels.guest_email') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" placeholder="{{ __('labels.guest_email_placeholder') }}" value="{{ $objectdata->email }}"
                inputmode="\d{50}" maxlength="50" required>
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
                placeholder="{{ __('labels.guest_phone_placeholder') }}" value="{{ $objectdata->phone }}" required>
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
                {{-- <div class="col-lg-3">
                    <span style="margin-left: 1.5rem;"><input class="form-check-input" type="checkbox" id="allEvent"
                            name="event[]" value="0" id="defaultCheck1">
                        <label class="form-check-label mr-5" for="defaultCheck1">
                            All
                        </label></span>
                </div> --}}
                @php
                    $selectedIds = $objectdata->events->pluck('id')->toArray();
                @endphp
                @foreach ($data['events'] as $event)
                    <div class="col-lg-3">
                        <span style="margin-left: 1.5rem;">
                            <input class="form-check-input selectEvent" type="checkbox" name="event_ids[]"
                                value="{{ $event->id }}" @checked(in_array($event->id, $selectedIds))>
                            <label class="form-check-label" for="event_{{ $event->id }}">
                                {{ ucfirst($event->name) }}
                            </label>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col text-center">
            <button type="submit" id="submitBtn" title="{{ __('titles.add_guest') }}"
                class="btn btn-primary">{{ __('buttons.create') }}</button>
        </div>
    </div>
</form>
