<form id="createEvent" action="{{ route('events.update', $objectData->id) }}" method="post">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="form-group col-lg-12 mt-5">
            <label for="name" class="font-weight-medium">{{ __('labels.event_name') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror col-lg-12" id="name"
                name="name" placeholder="{{ __('labels.event_name_placeholder') }}" value="{{ $objectData->name }}"
                inputmode="\d{30}" maxlength="30" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="row mt-5">
        <div class="col text-center">
            <button type="submit" id="submitBtn" title="{{ __('titles.add_event') }}"
                class="btn btn-primary">{{ __('buttons.create') }}</button>
        </div>
    </div>
</form>

