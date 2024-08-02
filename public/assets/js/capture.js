document.addEventListener('DOMContentLoaded', () => {
    const camera = document.getElementById('camera');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('captureButton');
    const retakeButton = document.getElementById('retakeButton');
    const saveButton = document.getElementById('saveButton');
    const capturedImageContainer = document.getElementById('capturedImageContainer');
    const capturedImage = document.getElementById('capturedImage');
    const modalBody = document.querySelector('#captureModal .modal-body');
    let stream;
    let imageCaptured = false;
    let latitude = null;
    let longitude = null;

    // Function to start the camera
    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({video: {facingMode: "environment"}});
            camera.srcObject = stream;
        } catch (err) {
            console.error('Error accessing camera:', err);
        }
    }

    // Function to capture image
    function captureImage() {
        if (stream) {
            try {
                const context = canvas.getContext('2d');
                canvas.width = camera.videoWidth;
                canvas.height = camera.videoHeight;

                context.drawImage(camera, 0, 0, canvas.width, canvas.height);
                const imageData = canvas.toDataURL('image/png');

                if (capturedImageContainer) {
                    capturedImageContainer.style.backgroundImage = `url(${imageData})`;
                    capturedImageContainer.style.backgroundSize = 'cover';
                    capturedImageContainer.style.backgroundRepeat = 'no-repeat';
                    capturedImageContainer.style.backgroundPosition = 'center';
                    capturedImageContainer.style.display = 'block';
                    capturedImageContainer.style.width = '250px';
                    capturedImageContainer.style.height = '350px';
                    capturedImageContainer.style.margin = 'auto'; // Center the container

                } else {
                    console.error('capturedImageContainer element not found');
                }

                camera.style.display = 'none';
                captureButton.style.display = 'none';
                retakeButton.style.display = 'inline';
                saveButton.disabled = false;
                saveButton.textContent = 'Submit'; // Reset button text
                imageCaptured = true;
                capturedImage.src = imageData;

                // Get location data
                getLocation();

            } catch (error) {
                console.error('Error capturing image:', error);
            }
        } else {
            console.error('No stream available');
        }
    }

    // Function to reset to video frame
    function resetCapture() {
        capturedImageContainer.style.backgroundImage = 'none';
        capturedImageContainer.style.width = '';
        capturedImageContainer.style.height = '';
        capturedImageContainer.style.display = 'none';
        camera.style.display = 'block';
        captureButton.style.display = 'inline';
        retakeButton.style.display = 'none';
        saveButton.disabled = true;
        saveButton.textContent = 'Save'; // Reset button text
        imageCaptured = false;

        // Restart the camera
        startCamera();

        // Get new location data
        getLocation();
    }

    // Function to get the user's location
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                latitude = position.coords.latitude;
                longitude = position.coords.longitude;
            }, error => {
                console.error('Error getting location:', error);
            });
        } else {
            console.error('Geolocation is not supported by this browser.');
        }
    }

    // Function to stop the camera stream
    function stopCamera() {
        if (stream) {
            let tracks = stream.getTracks();
            tracks.forEach(track => track.stop());
        }
    }

    // Function to reload the page
    function reloadPage() {
        location.reload();
    }

    // Event listeners
    captureButton.addEventListener('click', captureImage);
    retakeButton.addEventListener('click', resetCapture);

    $('#captureModal').on('show.bs.modal', () => {
        startCamera(); // Start the camera when the modal is shown
    });

    $('#captureModal').on('hide.bs.modal', () => {
        stopCamera(); // Stop the camera
        reloadPage(); // Reload the page to reset the modal
    });

    saveButton.addEventListener('click', () => {
        if (imageCaptured) {
            // Disable the button and show loader
            saveButton.disabled = true;
            saveButton.textContent = 'Please wait...';

            const form = document.getElementById('contactForm');
            const address = document.getElementById('formAddress').value.trim();
            const lga = document.getElementById('formLGA').value;
            const area = document.getElementById('formArea').value.trim();
            const wasteType = document.getElementById('formWasteType').value;
            const phoneNumber = document.getElementById('formPhoneNumber').value.trim();
            const message = document.getElementById('formMessage').value.trim();

            // Prepare data for backend request
            const formData = new FormData();
            formData.append('phone_number', phoneNumber);
            formData.append('address', address);
            formData.append('lga', lga);
            formData.append('area', area);
            formData.append('waste_type', wasteType);
            formData.append('message', message);
            formData.append('captured_image', capturedImage.src);
            formData.append('latitude', latitude); // Use latitude
            formData.append('longitude', longitude); // Use longitude

            // Send formData to the backend using fetch
            fetch('/report', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => response.json())
                .then(data => {
                    // Replace modal body with success message
                    modalBody.innerHTML = '<div class="alert alert-success" role="alert">Submission successful!</div>';
                    saveButton.textContent = 'Close'; // Change button text
                    saveButton.style.display = 'none';
                    saveButton.disabled = false; // Re-enable button

                    // Optionally add a listener to close the modal when the button is clicked
                    saveButton.addEventListener('click', () => {
                        $('#captureModal').modal('hide');
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Re-enable the button and reset text on error
                    saveButton.disabled = false;
                    saveButton.textContent = 'Save';
                });
        } else {
            alert('Please capture an image before saving.');
        }
    });
});
