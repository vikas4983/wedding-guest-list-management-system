<form action="{{ $route }}" method="POST">
    @csrf
    @method('PATCH')
    <label class=" switch switch-text switch-primary switch-pill form-control-label">
        <input type="checkbox" name="is_active" id="is_active" value="1" class="statusBtn switch-input form-check-input  "
            {{ old('is_active', $objectData ?? 0) == 1 ? 'checked' : '' }}>
        <span class="switch-label" data-on="On" data-off="Off"></span>
        <span class="switch-handle" style="color: black"></span>
    </label>
</form>
<style>
    .switch-input.statusBtn {
        position: absolute !important;
        width: 1px !important;
        height: 1px !important;
        padding: 0 !important;
        margin: 0 !important;
        border: 0 !important;
        opacity: 0 !important;
        appearance: none !important;
        -webkit-appearance: none !important;
        pointer-events: auto !important;
        z-index: 2;
    }

    .switch-label,
    .switch-handle {
        pointer-events: auto;
        cursor: pointer;
    }
</style>