
<div>
    <form action="{{ $route }}" method="{{ $method }}">
        <input type="hidden" id="id" name="id" value="{{ $objectData->id }}">
        @csrf
       <button type="button" data-toggle="modal" data-id="{{ $objectData }}" data-url="{{ $route }}"
        data-title="Guest" data-target="#editModal-{{ $objectData->id }}"
        class="btn btn-outline-primary btn-sm rounded-pill editBtn" style="cursor:pointer" title={{ __('titles.edit') }}>
        <i class="mdi mdi-pencil "></i>
    </button>
    </form>
</div>
<x-edit-modal-component :objectData="$objectData" :route="$route" :title="$title" :modalSize="$modalSize" /> 

