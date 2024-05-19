const latitude = 12.34;
const longitude = 56.78;
const radius = 12;

fetch(
    `http://localhost:8000/api/projects/check-proximity?latitude=${latitude}&longitude=${longitude}&radius=${radius}`,
    {
        method: "GET",
        credentials: "include", // Include cookies in the request
    },
)
    .then((response) => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.json();
    })
    .then((data) => {
        // Handle the API response data
        console.log(data);
    })
    .catch((error) => {
        // Handle any errors
        console.error("There was a problem with the fetch operation:", error);
    });
