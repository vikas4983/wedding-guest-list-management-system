@php
    $alerts = [
        'success' => 'success',
        'error' => 'danger',
        'warning' => 'warning',
        'info' => 'info',
    ];
@endphp

@foreach ($alerts as $sessionKey => $alertClass)
    @if (session()->has($sessionKey))
        <div class="alert alert-{{ $alertClass }} alert-dismissible fade show auto-hide-alert " style="margin-top:1rem;"
            role="alert">
            {{ session($sessionKey) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.auto-hide-alert');
        if (alerts.length > 0) {
            setTimeout(() => {
                alerts.forEach(alert => {
                    alert.remove();
                });
            }, 2000);
        }
    });
</script>
