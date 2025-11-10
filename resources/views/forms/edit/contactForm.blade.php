<form id="updatecontact" action="{{ route('contacts.update', $objectdata->id) }}" method="post">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="form-group col-lg-6">
            <label for="name" class="font-weight-medium">{{ __('labels.contact_name') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                placeholder="{{ __('labels.contact_name_placeholder') }}" value="{{ $objectdata->name }}"
                inputmode="\d{30}" maxlength="30" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-lg-6">
            <label for="email" class="font-weight-medium">{{ __('labels.contact_email') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" placeholder="{{ __('labels.contact_email_placeholder') }}" value="{{ $objectdata->email }}"
                inputmode="\d{50}" maxlength="50" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-lg-6">
            <label for="contact_phone" class="font-weight-medium">{{ __('labels.contact_phone') }}</label>
            <input type="number" maxlength="10"
                oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);"
                class="form-control @error('phone')
is-invalid
@enderror" id="phone" name="phone"
                placeholder="{{ __('labels.contact_phone_placeholder') }}" value="{{ $objectdata->phone }}" required>
            <div class="invalid-feedback"></div>
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

    </div>
    <div class="row mt-5">
        <div class="col text-center">
            <button type="submit" id="submitBtn" title="{{ __('titles.add_contact') }}"
                class="btn btn-primary">{{ __('buttons.create') }}</button>
        </div>
    </div>
</form>
