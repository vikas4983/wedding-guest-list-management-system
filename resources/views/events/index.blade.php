@extends('layouts.main-app')
@section('title', 'Events List')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :current-route="['name' => 'List', 'url' => null]" class="mb-5" />
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('events.create') }}" class="btn btn-info" id="addGuestBtn">Add Event</a>
        </div>
        <div class="input-group" style="max-width:255px;">
            <form action="{{ route('search.keyword') }}" method="get" class="d-flex w-100">
                <input type="text" class="form-control" name="keyword" placeholder="Name, Mobile, Email..."
                    autocomplete="off">
                <button class="input-group-text">
                    Search
                </button>
            </form>
        </div>
    </div>
    <table class="table" id="productsTable" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Event</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <div class="text-center">
            <span id="copyData" style="color: rgb(30, 9, 218)"></span>

        </div>
        <tbody>
            @if ($events->count() > 0)
                <div class="row ">
                    <div class="col text-center mb-5" style="color: rgb(10, 207, 233)">
                        <span id="copyData"></span>
                    </div>
                </div>
                @foreach ($events as $index => $event)
                    <tr class="viewData">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ Str::limit($event->name ?? '', 25) }}
                            <i class="fas fa-copy copyEvent" style="cursor: pointer; margin-left: 8px; color: #503F71;"
                                title="Copy Event" data-event="{{ $event->name }}"></i>
                        </td>
                        <td>
                            <x-switch-button-component :route="route('events.update', $event->id)" :method="'PATCH'" :objectData="$event->is_active" />
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <x-edit-action-component :route="route('events.edit', $event->id)" :objectData="$event" :method="'GET'"
                                    :title="__('labels.event_title')" :modalSize="__('labels.event_edit_modal_size')" />
                                <span class="mx-1"></span>
                                <x-delete-action-component :route="route('events.destroy', $event->id)" />

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
        {{ $events->links() }}
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
