(function () {
    function request(method) {
        return async function (url, data = null) {
            const token = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            const options = {
                method,
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                    Accept: "application/json",
                },
            };

            if (data && method !== "GET") {
                options.body = JSON.stringify(data);
            }

            try {
                const response = await fetch(url, options);

                if (!response.ok) {
                    const error = await response.text();
                    throw new Error(error || "Network response was not ok");
                }

                const contentType = response.headers.get("Content-Type");
                if (contentType && contentType.includes("application/json")) {
                    return await response.json();
                } else {
                    return await response.text();
                }
            } catch (error) {
                console.error("Fetch error:", error);
                throw error;
            }
        };
    }

    // Expose globally
    window.fetchWrapper = {
        get: request("GET"),
        post: request("POST"),
        put: request("PUT"),
        delete: request("DELETE"),
    };
})();
