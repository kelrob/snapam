<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/aos.js')}}"></script>
<script src="{{asset('assets/js/appear.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/isotope.js')}}"></script>
<script src="{{asset('assets/js/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{asset('assets/js/jquery.countTo.js')}}"></script>
<script src="{{asset('assets/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.event.move.js')}}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.paroller.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-sidebar-content.js') }}"></script>
<script src="{{ asset('assets/js/knob.js') }}"></script>
<script src="{{ asset('assets/js/map-script.js') }}"></script>
<script src="{{ asset('assets/js/owl.js') }}"></script>
<script src="{{ asset('assets/js/pagenav.js') }}"></script>
<script src="{{ asset('assets/js/scrollbar.js') }}"></script>
<script src="{{ asset('assets/js/swiper.min.js') }}"></script>
<script src="{{ asset('assets/js/tilt.jquery.js') }}"></script>
<script src="{{ asset('assets/js/TweenMax.min.js') }}"></script>
<script src="{{ asset('assets/js/validation.js') }}"></script>
<script src="{{ asset('assets/js/wow.js') }}"></script>

<script src="{{ asset('assets/js/jquery-1color-switcher.min.js') }}"></script>

<script>
    $('#captureModal').on('shown.bs.modal', function () {
        $('#captureModal').trigger('focus')
    })
</script>

<!-- thm custom script -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{asset('assets/js/capture.js')}}"></script>

<script>
    document.getElementById('proceedButton').addEventListener('click', function () {
        var form = document.getElementById('contactForm');
        var address = document.getElementById('formAddress').value.trim();
        var lga = document.getElementById('formLGA').value;
        var area = document.getElementById('formArea').value.trim();
        var wasteType = document.getElementById('formWasteType').value;
        var phoneNumber = document.getElementById('formPhoneNumber').value.trim();
        var message = document.getElementById('formMessage').value.trim();

        var valid = true;

        // Clear previous error messages
        document.getElementById('addressError').textContent = '';
        document.getElementById('lgaError').textContent = '';
        document.getElementById('areaError').textContent = '';
        document.getElementById('wasteTypeError').textContent = '';

        if (!address) {
            document.getElementById('addressError').textContent = 'Address is required.';
            valid = false;
        }
        if (!lga) {
            document.getElementById('lgaError').textContent = 'Local Government Area is required.';
            valid = false;
        }
        if (!area) {
            document.getElementById('areaError').textContent = 'Area is required.';
            valid = false;
        }
        if (!wasteType) {
            document.getElementById('wasteTypeError').textContent = 'Type of Waste is required.';
            valid = false;
        }

        if (valid) {
            // Prepare data for backend request
            var formData = {
                phone_number: phoneNumber,
                address: address,
                lga: lga,
                area: area,
                waste_type: wasteType,
                message: message
            };

            console.log('Form data ready to send:', formData);

            // Show the modal if validation is successful
            $('#captureModal').modal('show');

            // You can also send the formData to the backend using fetch or AJAX here
            // Example with fetch:
            // fetch('/your-backend-endpoint', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json'
            //     },
            //     body: JSON.stringify(formData)
            // }).then(response => response.json())
            //   .then(data => console.log('Success:', data))
            //   .catch(error => console.error('Error:', error));
        } else {
            // Report validation issues
            form.reportValidity();
        }
    });
</script>

