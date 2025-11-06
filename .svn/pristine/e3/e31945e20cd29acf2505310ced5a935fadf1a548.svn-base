document.addEventListener("click", function (e) {
    if (e.target.closest(".openMarkAsResolvedModalBtn")) {
        const button = e.target.closest(".openMarkAsResolvedModalBtn");
        const queryId = button.getAttribute("data-id");
        Swal.fire({
            title: "<small>Mark Query as Resolved</small>",
            html: `
                <div style="display: flex; flex-direction: column; gap: 12px; text-align: left;">
                    <textarea id="remark" class="swal2-textarea" placeholder="Enter your remark here..." rows="3" style="resize: vertical;"></textarea>
                </div>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Submit",
            preConfirm: () => {
                const remark = Swal.getPopup()
                    .querySelector("#remark")
                    .value.trim();

                if (!remark) {
                    Swal.showValidationMessage("Please enter a remark");
                }
                if (remark.length > 100) {
                    Swal.showValidationMessage(
                        "Remark cannot exceed 100 characters"
                    );
                    return false;
                }
                return { remark };
            },
        }).then((result) => {
            if (result.isConfirmed) {
                const websiteMeta = document.querySelector(
                    'meta[name="website-url"]'
                );
                const websiteUrl = websiteMeta?.getAttribute("content");
                const finalUrl = websiteUrl
                    ? `${websiteUrl}/query-management/mark-as-resolved`
                    : null;
                const { remark } = result.value;
                let form = document.createElement("form");
                form.method = "POST";
                form.action = finalUrl;
                let csrfToken = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");

                let csrfInput = document.createElement("input");
                csrfInput.type = "hidden";
                csrfInput.name = "_token";
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);
                let remarkInput = document.createElement("input");
                remarkInput.type = "hidden";
                remarkInput.name = "remark";
                remarkInput.value = remark;
                form.appendChild(remarkInput);
                let queryIdInput = document.createElement("input");
                queryIdInput.type = "hidden";
                queryIdInput.name = "query_id";
                queryIdInput.value = queryId;
                form.appendChild(queryIdInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
});

document.addEventListener("click", function (e) {
    if (e.target.closest(".queryResolved")) {
        const btn = e.target.closest(".queryResolved");
        const remark =
            btn.getAttribute("data-remark") || "No remark available.";

        Swal.fire({
            icon: "info",
            title: "<small>Query Already Resolved</small>",
            html: `<div>${remark}</div>`,
            confirmButtonText: "Close",
        });
    }
});
