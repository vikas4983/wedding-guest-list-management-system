@extends('layouts.main-app')
@section('title', 'Cards List')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :current-route="['name' => 'List', 'url' => null]" class="mb-5" />
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('cards.create') }}" class="btn btn-info" id="addGuestBtn">Add Card</a>
        </div>
        <div class="input-group" style="width: 300px;">
            <input type="text" class="form-control" placeholder="Enter name, mobile, email...">
            <button class="input-group-text">
                <i class="mdi mdi-account-search-outline"></i>
            </button>
        </div>
    </div>
    @include('alerts.alert')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Validation Error!</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        @if ($cards->count() > 0)
            @foreach ($cards as $card)
                <div class="col-lg-6 col-xl-3 mt-5">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden hover-scale bg-white card-item">
                        <img class="card-img-top"
                            src="{{ $card->image ? asset('storage/' . $card->image) : asset('assets/theme/images/elements/cc1.jpg') }}"
                            alt="{{ $card->title }}" style="height: 250px; object-fit: cover;">

                        <div class="card-body text-center">
                            <h4 class="fw-bold text-danger mb-2" style="font-family: 'Great Vibes', cursive;">
                                {{ $card->title ?? 'Ashish Weds Priya' }}
                            </h4>

                            <h5 class="text-success fw-semibold mb-2">{{ ucfirst($card->event->name) }}</h5>

                            <p class="text-muted small mb-1">
                                <i class="bi bi-calendar-event text-primary"></i>
                                {{ \Carbon\Carbon::parse($card->date)->format('d M, Y') }}
                            </p>

                            <p class="text-muted small mb-1">
                                <i class="bi bi-clock text-success"></i>
                                {{ \Carbon\Carbon::parse($card->time)->format('h:i A') }}
                            </p>

                            @if ($card->location)
                                <p class="text-muted small mb-1">
                                    <i class="bi bi-geo-alt text-danger"></i> {{ $card->location }}
                                </p>
                            @endif

                            @if ($card->address)
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-house-door text-warning"></i> {{ $card->address }}
                                </p>
                            @endif

                            <p class="card-text text-secondary small">
                                {{ Str::limit($card->description, 80) }}
                            </p>

                            <div class="text-center mt-3">
                                <div class="d-flex justify-content-center align-items-center ">

                                    <x-switch-button-component :route="route('cards.update', $card->id)" :method="'PATCH'" :objectData="$card->is_active" />
                                    <span class="mx-1"></span>
                                    <x-edit-action-component :route="route('cards.edit', $card->id)" :objectData="$card" :method="'GET'"
                                        :title="__('labels.card_title')" :modalSize="__('labels.guest_edit_modal_size')" />
                                    <span class="mx-1"></span>
                                    <x-delete-action-component :route="route('cards.destroy', $card->id)" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h1 class="text-danger text-center">No data found</h1>

        @endif
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $cards->links() }}
    </div>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}", "Success");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}", "Error");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}", "Warning");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}", "Info");
        @endif
    </script>
@endsection
