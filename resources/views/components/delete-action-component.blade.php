<div>
    <form action="{{ $route }}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-outline-danger btn-sm rounded-pill deleteBtn">
            <i class="fas fa-trash"></i>
        </button>

    </form>
</div>



