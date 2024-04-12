import './bootstrap';

function getLocationAndSend() {
    if ("geolocation" in navigator) {
        // Geolocation is supported
        navigator.geolocation.getCurrentPosition(function(position) {
            // Successfully retrieved the position
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            console.log("Latitude: " + lat);
            console.log("Longitude: " + lng);

            // Send data to server
            fetch('/api/get-location-address', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({lat, lng})
            })
            .then(response => response.json())
            .then(data => console.log("Server Response:", data))
            .catch(error => console.error('Error in sending location:', error));
        
        }, function(error) {
            // Handle errors
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    console.error("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    console.error("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    console.error("The request to get user location timed out.");
                    break;
                default:
                    console.error("An unknown error occurred.");
                    break;
            }
        }, {
            enableHighAccuracy: true, // Request a more precise location
            timeout: 10000,           // Maximum time before the error callback is invoked, in milliseconds
            maximumAge: 60000         // Maximum age in milliseconds of a possible cached position that is acceptable to return
        });
    } else {
        // Geolocation is not supported
        console.log("Geolocation is not supported by this browser.");
    }
}

// Call the function to get the location and send it to the server
getLocationAndSend();

