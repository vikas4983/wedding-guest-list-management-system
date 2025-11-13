function confirmDelete() {
    if (!window.confirm("Are you sure you want to delete?")) {
        return false;
    } else {
        return true;
    }
}

function sendAjax(button) {
    const form = button.closest("form");
    const row = button.closest("tr") || button.closest(".card-item");
    button.disabled = true;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="mdi mdi-loading mdi-spin"></i>';
    const formData = new FormData(form);
    if (button.classList.contains("deleteBtn")) {
        formData;
    } else if (button.classList.contains("statusBtn")) {
        formData.set("is_active", button.checked ? "1" : "0");
    } else if (button.classList.contains("invitationBtn")) {
        formData;
    }
    const action = form.action;
    const method = form.getAttribute("method");
    fetch(action, {
        method: method,
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
            Accept: "application/json",
        },
        body: method === "GET" ? null : formData,
    })
        .then((response) => {
            if (!response.ok) throw new Error("Something went wrong!");
            return response.json();
        })
        .then((data) => {
            if (data.action === "delete") {
                if (row) {
                    row.remove();
                    toastr.error(data.message);
                }
            }
            if (data.action === "status") {
                toastr.success(data.message);
            }
            if (data.action === "edit") {
                const modalId = button.getAttribute("data-target");
                const modal = document.querySelector(modalId);
                if (modal) {
                    const modalBody = modal.querySelector(".modal-body");
                    if (modalBody) {
                        modalBody.innerHTML = data.editForm;
                        $(modal).modal("show");
                    }
                }

                return;
            }
        })
        .catch((error) => {
            alert("Delete failed: " + error.message);
        })
        .finally(() => {
            button.disabled = false;
            button.innerHTML = originalText;
        });
}
document.querySelectorAll(".deleteBtn,  .editBtn").forEach((button) => {
    button.addEventListener("click", function (e) {
        e.preventDefault();
        if (this.classList.contains("deleteBtn")) {
            if (confirm("Are you sure you want to delete this item?")) {
                sendAjax(this);
            }
        } else if (this.classList.contains("editBtn")) {
            sendAjax(this);
        } else if (this.classList.contains("sendInvitation")) {
            sendAjax(this);
        }
    });
});
document.querySelectorAll(".statusBtn").forEach((button) => {
    button.addEventListener("change", function (e) {
        e.preventDefault();
        if (this.classList.contains("statusBtn")) {
            sendAjax(this);
        }
    });
});

// Checkbox
document.addEventListener("DOMContentLoaded", function () {
    const allCb = document.querySelector(".allCb");
    const eventBtn = document.querySelector(".eventBtn");
    const singleCb = document.querySelectorAll(".singleCb");
    const invitationBtn = document.querySelector("#invitationBtn");
    const sendInvitation = document.querySelector("#sendInvitation");

    let selectedValue = [];

    allCb.addEventListener("change", function () {
        if (eventBtn) {
            eventBtn.style.display = "block";
        }

        if (invitationBtn) {
            invitationBtn.style.display = "block";
        }

        selectedValue = [];
        singleCb.forEach((el) => {
            el.checked = allCb.checked;
            if (allCb.checked) {
                if (sendInvitation) {
                    sendInvitation.style.display = "block";
                }
                if (invitationBtn) {
                    invitationBtn.disabled = false;
                }

                selectedValue.push(el.value);
            } else {
                if (eventBtn) {
                    eventBtn.style.display = "none";
                }
                if (sendInvitation) {
                    sendInvitation.style.display = "none";
                }

                if (invitationBtn) {
                    invitationBtn.disabled = true;
                }
            }
            //  console.log(selectedValue);
        });
    });
    singleCb.forEach((el) => {
        el.addEventListener("change", function () {
            const value = this.value;
            if (this.checked) {
                console.log(selectedValue);
                if (eventBtn) {
                    eventBtn.style.display = "block";
                }
                if (invitationBtn) {
                    invitationBtn.style.display = "block";
                }

                if (!selectedValue.includes(value)) {
                    if (sendInvitation) {
                        sendInvitation.style.display = "block";
                    }

                    if (invitationBtn) {
                        invitationBtn.disabled = false;
                    }

                    selectedValue.push(value);
                }
            } else {
                const index = selectedValue.indexOf(value);
                if (index > -1) {
                    if (eventBtn) {
                        eventBtn.style.display = "block";
                    }
                    if (sendInvitation) {
                        sendInvitation.style.display = "block";
                    }
                    if (invitationBtn) {
                        invitationBtn.disabled = false;
                    }
                    selectedValue.splice(index, 1);
                    if (eventBtn) {
                        eventBtn.style.display = "block";
                    }
                    if (sendInvitation) {
                        sendInvitation.style.display = "block";
                    }
                    if (invitationBtn) {
                        invitationBtn.disabled = false;
                    }
                }
            }
            //  console.log(selectedValue);
            const checkedCount =
                document.querySelectorAll(".singleCb:checked").length;
            if (checkedCount !== singleCb.length) {
                allCb.checked = false;
            }
            if (selectedValue.length < 1) {
                if (eventBtn) {
                    eventBtn.style.display = "none";
                }
                if (sendInvitation) {
                    sendInvitation.style.display = "none";
                }
                if (invitationBtn) {
                    invitationBtn.disabled = false;
                }
            }
        });
    });

    if (eventBtn) {
        eventBtn.addEventListener("click", function (e) {
            e.preventDefault();
            let eventModal = new bootstrap.Modal(
                document.getElementById("eventModal"),
                {
                    backdrop: "static",
                    keyboard: false,
                }
            );
            eventModal.show();

            document.querySelector("#guest_ids").value = selectedValue;
        });
    }

    function submitForm(formData, ids) {
        invitationBtn.disabled = true;
        const action = formData.getAttribute("action");
        const method = formData.getAttribute("method");

        // console.log(action, method, ids);
        fetch(action, {
            method: method,
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                Accept: "application/json",
            },
            body: JSON.stringify({ ids: ids }),
        })
            .then((response) => {
                if (!response.ok) throw new Error("Something went wrong!");
                return response.json();
            })
            .then((data) => {
                if (invitationBtn) {
                    invitationBtn.disabled = false;
                    invitationBtn.style.display = "none";
                }

                if (data.action === "sentMail") {
                    toastr.success(data.message);
                }
            })
            .catch((error) => {
                alert("Something went wrong: " + error.message);
                if (sendInvitation) {
                    sendInvitation.style.display = "block";
                }
                if (invitationBtn) {
                    invitationBtn.disabled = false;
                }
            })
            .finally(() => {
                if (sendInvitation) {
                    sendInvitation.style.display = "block";
                }
                if (invitationBtn) {
                    invitationBtn.disabled = false;
                }
            });
    }

    if (sendInvitation) {
        sendInvitation.addEventListener("click", function (e) {
            e.preventDefault();
            singleCb.forEach((el) => {
                el.checked = false;
            });
            if (!selectedValue.length > 0) {
                alert("Select atleat one checkbox");
            }
            submitForm(this, selectedValue);
            selectedValue = [];
        });
    }
});
