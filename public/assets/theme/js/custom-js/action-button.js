
function confirmDelete() {
    if (!window.confirm('Are you sure you want to delete?')) {
        return fasle;
    } else {
        return true;
    }
}

function sendAjax(button) {
    const row = button.closest('tr');
    const form = button.closest('form');
    button.disabled = true;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="mdi mdi-loading mdi-spin"></i>';
    const formData = new FormData(form);
    if (button.classList.contains('deleteBtn')) {
        formData;
    } else if (button.classList.contains('statusBtn')) {
        formData.set('is_active', button.checked ? '1' : '0');
    }
    const action = form.action;
    const method = form.getAttribute('method');
    console.log(formData, action, method);

    fetch(action, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },

        body: method === 'GET' ? null : formData


    })
        .then(response => {
            if (!response.ok) throw new Error('Something went wrong!');
            return response.json();
        })
        .then(data => {
            if (data.action === 'delete') {
                row.remove();
                toastr.error('Item deleted successfully!');
            }
            if (data.action === 'status') {
                toastr.success('Status updated successfully!');
            }
            if (data.action === 'edit') {
                const modalId = button.getAttribute('data-target');
                const modal = document.querySelector(modalId);
                if (modal) {
                    const modalBody = modal.querySelector('.modal-body');
                    if (modalBody) {
                        modalBody.innerHTML = data.editForm;
                        $(modal).modal('show'); // Bootstrap modal show
                    }
                }

                return;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Delete failed: ' + error.message);
        })
        .finally(() => {
            button.disabled = false;
            button.innerHTML = originalText;
        });
}
document.querySelectorAll('.deleteBtn, .statusBtn, .editBtn').forEach(button => {
    button.addEventListener('click', function () {

        if (this.classList.contains('deleteBtn')) {
            if (confirm('Are you sure you want to delete this item?')) {
                sendAjax(this);
            }
        }
        else if (this.classList.contains('statusBtn')) {
            sendAjax(this);
        }
        else if (this.classList.contains('editBtn')) {
            sendAjax(this);

        }
    });
});
