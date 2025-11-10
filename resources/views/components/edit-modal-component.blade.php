<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal-{{ $objectData->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel-{{ $objectData->id }}" aria-hidden="true">
    <div class="modal-dialog modal-{{$modalSize}}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="editModalLabel-{{ $objectData->id }}">
                    Edit {{$title}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-primary" title="{{ __('titles.update') }}"
                    data-dismiss="modal">{{ __('buttons.update') }}</button>
                <button type="button" class="btn btn-danger" title="{{ __('titles.cancel') }}"
                    data-dismiss="modal">{{ __('buttons.cancel') }}</button>
            </div> --}}
        </div>
    </div>
</div>
