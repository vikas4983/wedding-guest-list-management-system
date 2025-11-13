@extends('layouts.main-app')
@section('title', 'Invited List')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :current-route="['name' => 'List', 'url' => null]" class="mb-5" />
    @include('alerts.alert')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="{{ route('export.guests') }}" class="btn btn-info" id="uploadBtn">
                Download
            </a>
            <button class="btn btn-info eventBtn mr-5" id="eventBtn" style="display:none;margin-left: 1rem">
                Event
            </button>

        </div>

        {{-- <div class="input-group" style="max-width:255px;">
            <form action="{{route('filer.keyword')}}" method="get" class="d-flex w-100">
                <input type="hidden" name="url" value="{{ $url ?? '' }}">
                <input type="text" class="form-control" name="keyword" placeholder="Name, Mobile, Email..."
                    autocomplete="off">
                <button class="input-group-text">
                    Search
                </button>
            </form>
        </div> --}}

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
                                    {{ __('buttons.reminder_invitation') }}
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
    </div>

    <table class="table" id="productsTable" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th><input type="checkbox" name="allCb" class="allCb eventBtn" id="allCb"> Name</th>
                <th>Phone</th>
                <th>Email</th>
                {{-- <th>Event</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <div class="text-center">
            <span id="copyData" style="color: rgb(30, 9, 218)"></span>

        </div>
        <tbody>
            @if ($dataList->count() > 0)
                @foreach ($dataList as $index => $guest)
                    <tr class="viewData">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <span> <input type="checkbox" class="allCb  singleCb" value="{{ $guest->id }}"
                                    name="id" id="singleCb">
                                {{ Str::limit($guest->name ?? '', 7) }}
                                <i class="fas fa-copy copyName" style="cursor: pointer; margin-left: 8px; color: #503F71;"
                                    title="Copy Name" data-name="{{ $guest->name }}"></i>
                            </span>
                        </td>
                        <td>
                            <a href="tel:{{ $guest->phone }}" style="text-decoration: none; color: inherit;">
                                {{ $guest->phone }}
                            </a>
                            <i class="fas fa-copy copyPhone" style="cursor: pointer; margin-left: 8px; color: #503F71;"
                                title="Copy Number" data-phone="{{ $guest->phone }}"></i>
                        </td>
                        <td>
                            <a href="mailto:{{ $guest->email }}" style="text-decoration: none; color: inherit;">
                                {{ Str::limit($guest->email ?? '', 7) }}
                            </a>
                            <i class="fas fa-copy sm copyEmail " style="cursor: pointer; margin-left: 8px; color: #503F71;"
                                title="Copy Email" data-email="{{ $guest->email }}"></i>
                        </td>

                        <td>
                            {{-- <div class="d-flex gap-2">
                                <x-edit-action-component :route="route('guest.edit', $guest->id)" :objectData="$guest" :method="'GET'"
                                    :title="__('labels.guest_title')" :modalSize="__('labels.guest_edit_modal_size')" />
                                <span class="mx-1"></span>
                                <x-delete-action-component :route="route('guest.destroy', $guest->id)" />

                            </div> --}}
                            Invited
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
        {{ $dataList->links() }}
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
