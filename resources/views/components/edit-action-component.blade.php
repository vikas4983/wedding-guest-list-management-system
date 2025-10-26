{{-- <span class="editBtn">
    <i class="fas fa-edit icon" style="color:#503F71; cursor:pointer"></i>
</span> --}}
<div>
    <form action="{{ $route }}" method="{{ $method }}">
        <input type="hidden" id="id" name="id" value="{{ $objectData->id }}">
        @csrf
        {{-- <i class="fas fa-edit icon editBtn" style="color:#503F71; cursor:pointer"></i> --}}
        <button type="button" data-toggle="modal" data-id="{{ $objectData }}" data-url="{{ $route }}"
        data-title="Guest" data-target="#editModal-{{ $objectData->id }}"
        class="editBtn" style="color:#503F71; cursor:pointer" title={{ __('titles.edit') }}>
        <i class="mdi mdi-pencil "></i>
    </button>
    </form>
</div>
<x-edit-modal-component :objectData="$objectData" :route="$route" :title="$title" :modalSize="$modalSize" /> 
{{-- <form action="{{ $url }}" method="{{ $method }}">
    <input type="hidden" id="id" name="id" value="{{ $objectData->id }}">
    @csrf
    <button type="button" data-toggle="modal" data-id="{{ $objectData }}" data-url="{{ $url }}"
        data-title="{{ $title }}" data-target="#editModal-{{ $objectData->id }}"
        class="editBtn  btn btn-outline-info btn-pill" title={{ __('titles.edit') }}>
        <i class="mdi mdi-pencil"></i>
    </button>
</form>
<x-modals.edit-modal :objectData="$objectData" :url="$url" :title="$title" :modalSize="$modalSize" /> --}}
