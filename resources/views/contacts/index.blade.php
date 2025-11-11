@extends('layouts.main-app')
@section('title', 'Contact List')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :current-route="['name' => 'List', 'url' => null]" class="mb-5" />
    @include('alerts.alert')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('contacts.create') }}" class="btn btn-info" id="uploadBtn">
                File
            </a>
            <button class="btn btn-info eventBtn mr-5" id="eventBtn" style="display:none;margin-left: 1rem">
                Event
            </button>
        </div>
        <div class="input-group" style="max-width:255px;">
            <input type="text" class="form-control" placeholder="Name, Mobile, Email...">
            <button class="input-group-text">
                Search
            </button>
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModal" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lr" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="eventModal">Event</h5>

                    <!-- Close X button -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('send.invitation') }}" method="post">
                        <input type="hidden" name="ids[]" id="guest_ids">
                        @csrf
                        <div class="form-group col-lg-12">
                            <label for="event" class="font-weight-medium">{{ __('labels.event_name') }}</label>
                            <div class="row">
                                <div class="col-lg-3">
                                    <span style="margin-left: 1rem"><input class="form-check-input" type="checkbox"
                                            id="allEvent" name="event_ids[]" checked="checked" value="0"
                                            id="defaultCheck1">
                                        <label class="form-check-label mr-5" for="defaultCheck1">
                                            All
                                        </label></span>
                                </div>
                                @foreach ($data['events'] as $event)
                                    <div class="col-lg-3">
                                        <span class="col-lg-3">
                                            <input class="form-check-input selectEvent mr-5" type="checkbox"
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
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('buttons.invitation') }}
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                {{ __('buttons.cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
    <table class="table" id="productsTable" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th><input type="checkbox" name="allCb" class="allCb eventBtn" style="margin-left: -8.1px" id="allCb">
                    Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <div class="text-center">
            <span id="copyData" style="color: rgb(30, 9, 218)"></span>

        </div>
        <tbody>
            @if ($contacts->count() > 0)
                @foreach ($contacts as $index => $contact)
                    <tr class="viewData">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <input type="checkbox" class="allCb  singleCb" value="{{ $contact->id }}" name="id"
                                id="singleCb">
                            {{ Str::limit($contact->name ?? '', 7) }}
                            <i class="fas fa-copy copyName" style="cursor: pointer; margin-left: 8px; color: #503F71;"
                                title="Copy Name" data-name="{{ $contact->name }}"></i>

                        </td>
                        <td>
                            <a href="tel:{{ $contact->phone }}" style="text-decoration: none; color: inherit;">
                                {{ $contact->phone }}
                            </a>
                            <i class="fas fa-copy copyPhone" style="cursor: pointer; margin-left: 8px; color: #503F71;"
                                title="Copy Number" data-phone="{{ $contact->phone }}"></i>
                        </td>
                        <td>
                            <a href="mailto:{{ $contact->email }}" style="text-decoration: none; color: inherit;">
                                {{ Str::limit($contact->email ?? '', 7) }}
                            </a>
                            <i class="fas fa-copy sm copyEmail " style="cursor: pointer; margin-left: 8px; color: #503F71;"
                                title="Copy Email" data-email="{{ $contact->email }}"></i>
                        </td>

                        <td>
                            <div class="d-flex gap-2">
                                <x-edit-action-component :route="route('contacts.edit', $contact->id)" :objectData="$contact" :method="'GET'"
                                    :title="__('labels.contact_edit_title')" :modalSize="__('labels.contact_edit_modal_size')" />
                                <span class="mx-1"></span>
                                <x-delete-action-component :route="route('contacts.destroy', $contact->id)" />

                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center text-danger py-3">
                        <h2 style="color: rgb(226, 15, 15)">Data not available</h2>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-5">
        {{ $contacts->links() }}
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
