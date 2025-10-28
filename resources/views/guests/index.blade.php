@extends('layouts.main-app')
@section('title', 'Guests List')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :current-route="['name' => 'List', 'url' => null]" class="mb-5" />

    <div class="d-flex justify-content-between align-items-center">
        <!-- Left: Add Guest button -->
        <div>
            <button class="btn btn-info" id="addGuestBtn">Add Guest</button>
        </div>

        <!-- Right: Search box -->
        <div class="input-group" style="width: 300px;">
            <input type="text" class="form-control" placeholder="Enter name, mobile, email...">
            <button class="input-group-text">
                <i class="mdi mdi-account-search-outline"></i>
            </button>
        </div>
    </div>
    <table class="table  table-product" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($guests->count() > 0)
                <div class="row ">
                    <div class="col text-center mb-5" style="color: rgb(10, 207, 233)">
                        <span id="copyData"></span>
                    </div>
                </div>
                @foreach ($guests as $index => $guest)
                    <tr class="viewData">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ Str::limit($guest->name ?? '', 25) }}
                            <i class="fas fa-copy copyName" style="cursor: pointer; margin-left: 8px; color: #503F71;"
                                title="Copy Name" data-name="{{ $guest->name }}"></i>
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
                                {{ Str::limit($guest->email ?? '', 25) }}
                            </a>
                            <i class="fas fa-copy copyEmail" style="cursor: pointer; margin-left: 8px; color: #503F71;"
                                title="Copy Email" data-email="{{ $guest->email }}"></i>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <x-delete-action-component :route="route('guests.destroy', $guest->id)" />
                                <x-edit-action-component :route="route('guests.edit', $guest->id)" :objectData="$guest" :method="'GET'"
                                    :title="__('labels.guest_title')" :modalSize="__('labels.guest_edit_modal_size')" />

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
        {{ $guests->links() }}
    </div>


    
@endsection
