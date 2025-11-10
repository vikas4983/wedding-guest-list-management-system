function copy(data) {
    navigator.clipboard
        .writeText(data)
        .then(() => {
            const result = document.querySelector("#copyData");
            result.innerHTML = data;
            setTimeout(() => {
                result.innerHTML = "";
            }, 3000);
        })
        .catch((err) => console.error("Failed to copy: ", err));
}
document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (e) {
        const target = e.target;
        if (target.classList.contains("copyName")) {
            copy(target.dataset.name);
        } else if (target.classList.contains("copyPhone")) {
            copy(target.dataset.phone);
        } else if (target.classList.contains("copyEmail")) {
            copy(target.dataset.email);
        } else if (target.classList.contains("copyEvent")) {
            copy(target.dataset.event);
        }
    });
});
