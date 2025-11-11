@extends('layouts.main-app')
@section('title', 'Invited List')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :current-route="['name' => 'List', 'url' => null]" class="mb-5" />
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="{{ route('export.guests') }}" class="btn btn-info" id="uploadBtn">
                Download
            </a>

            <form id="sendReminder" style="margin-left: 10px; display:none" action="{{ route('send.invitation') }}"
                method="post">
                @csrf
                <button type="button" id="reminderBtn" disabled class="btn btn-info">
                    Reminder
                </button>
            </form>
        </div>

        <div class="input-group" style="max-width:255px;">
            <input type="text" class="form-control" placeholder="Name, Mobile, Email...">
            <button class="input-group-text">
                Search
            </button>
        </div>
    </div>

    <table class="table" id="productsTable" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th><input type="checkbox" name="allCb" class="allCb" id="allCb"> Name</th>
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
            @if ($data->count() > 0)
                @foreach ($data as $index => $guest)
                    <tr class="viewData">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <span> <input type="checkbox" class="allCb  singleCb" value="{{ $guest->id }}" name="id"
                                    id="singleCb">
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
        {{ $data->links() }}
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
