<div>
    <form action="{{ $route }}" method="post">
        @csrf
        @method('delete')
        <button>
            <i class="fas fa-trash deleteBtn mr-3 " style="color:#503F71"></i>
        </button>

    </form>
</div>


