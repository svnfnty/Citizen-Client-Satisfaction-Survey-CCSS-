<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Citizen/Client Satisfaction Survey</title>
    <link rel="icon" href="images/merchant-nbi.png" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* CSS for logo and office name */
        .header {
            text-align: center;
            margin-bottom:0px;
        }
        .logo {
            width: 100px; /* Adjust as needed */
            height: auto;
        }
        .office-name {
            font-size: 14px; /* Adjust as needed */
            font-weight: bold;
            margin-top: 0px;
        }
    </style>
</head>
<body>

<form class="survey-form" id="surveyForm" method="post" onsubmit="return validateForm()">
    <div class="header">
        <img src="images/merchant-nbi.png" alt="NBI Logo" class="logo">
        <div class="office-name">NATIONAL BUREAU OF INVESTIGATION <br> GINGOOG CITY SATELLITE OFFICE</div>
    </div>
    <h1><i class="far fa-list-alt"></i>CITIZEN/CLIENT SATISFACTION SURVEY (CCSS)</h1>

    <div class="steps">
        <div class="step current"></div>
        <div class="step"></div>
        <div class="step"></div>
    </div>

    <div class="step-content current" data-step="1">
        <div class="fields">
            <label for="date">Date</label>
            <div class="field">
                <i class="fas fa-calendar"></i>
                <input id="date" type="date" name="date" placeholder="" required>
            </div>
    
            <label for="name">Name (optional)</label>
            <div class="field">
                <i class="fas fa-user"></i>
                <input id="name" type="text" name="name" placeholder="Your Name">
            </div>
    
            <label for="contact">Contact Number</label>
            <div class="field">
                <i class="fas fa-phone"></i>
                <input id="contact" type="tel" name="contact" placeholder="Your Contact Number" pattern="\d{11}" title="Please enter exactly 11 digits" maxlength="11" required>
                
            </div>
            <div id="contactError" style="color: red; display: none;">Please enter exactly 11 digits</div>
            </br>
            <label for="email">Your Email</label>
            <div class="field">
                <i class="fas fa-envelope"></i>
                <input id="email" type="email" name="email" placeholder="Your Email" required>  
            </div>
            <div id="emailError" style="color: red; display: none;">Please enter a valid email address</div>
        <script>
            const contactInput = document.getElementById('contact');
            const emailInput = document.getElementById('email');
            const contactError = document.getElementById('contactError');
            const emailError = document.getElementById('emailError');

            function validateContact() {
                if (!/^\d{11}$/.test(contactInput.value)) {
                    contactInput.style.borderColor = 'red';
                    contactError.style.display = 'block';
                } else {
                    contactInput.style.borderColor = ''; // Reset border color
                    contactError.style.display = 'none';
                }
            }

            function validateEmail() {
                if (!/\S+@\S+\.\S+/.test(emailInput.value)) {
                    emailInput.style.borderColor = 'red';
                    emailError.style.display = 'block';
                } else {
                    emailInput.style.borderColor = ''; // Reset border color
                    emailError.style.display = 'none';
                }
            }

            contactInput.addEventListener('input', validateContact);
            emailInput.addEventListener('input', validateEmail);
        </script>

        </div>
        <div class="buttons">
            <a href="#" class="btn" id="nexBtn" data-set-step="2">Next</a>
        </div>
    </div>

    <div class="step-content" data-step="2">
        <div class="fields">
            <p style="color: black;">INSTRUCTION: Please rate us by putting a clicking mark on appropriate level of satisfaction.</p>

            
            <p>Overall, how satisfied or dissatisfied are you with our service?</p>
            <div class="rating">
                <input type="radio" name="rating" id="radio1" value="Poor">
                <label for="radio1"><span style="font-size: 35px;">😢</span></label>
                <input type="radio" name="rating" id="radio2" value="Dissatisfied">
                <label for="radio2"><span style="font-size: 35px;">😞</span></label>
                <input type="radio" name="rating" id="radio3" value="Satisfied">
                <label for="radio3"><span style="font-size: 35px;">😊</span></label>
                <input type="radio" name="rating" id="radio4" value="Very Satisfied">
                <label for="radio4"><span style="font-size: 35px;">😄</span></label>
                <input type="radio" name="rating" id="radio5" value="Excellent">
                <label for="radio5"><span style="font-size: 35px;">😍</span></label>
            </div>

            <div class="rating-footer">
                <span>Poor</span>
                <span>Dissatisfied</span>
                <span>Satisfied</span>
                <span>Very Satisfied</span>
                <span>Excellent</span>
            </div>
            <label for="comments">Do you have any comments, questions and concerns to improve our services?</label>
            <div class="field">
                <textarea id="comments" name="comments" placeholder="Enter your comments ..." required></textarea>
            </div>      
                              
        </div>
        <div class="buttons">
            <a href="#" class="btn alt" data-set-step="1">Prev</a>
            <button type="submit" class="btn">Submit</button>
        </div>
    </div>

    <div class="step-content" data-step="3">
        <div class="result">Thanks for your feedback!</div>
    </div>
</form>
<script>
    // Define the variable isSubmitting
    var isSubmitting = false;

    // Function to set the active step
    const setStep = step => {
        document.querySelectorAll(".step-content").forEach(element => element.style.display = "none");
        document.querySelector("[data-step='" + step + "']").style.display = "block";
        document.querySelectorAll(".steps .step").forEach((element, index) => {
            index < step - 1 ? element.classList.add("complete") : element.classList.remove("complete");
            index === step - 1 ? element.classList.add("current") : element.classList.remove("current");
        });
    };

    $(document).ready(function() {
        // Function to handle form submission via AJAX
        $('#surveyForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            if (!validateForm()) {
                return; // If validation fails, do not proceed with submission
            }

            // Check if the form is already being submitted
            if (isSubmitting) {
                return; // If yes, return to avoid multiple submissions
            }

            // Set submitting flag to true
            isSubmitting = true;

            var formData = $(this).serialize();

            // Perform AJAX request
            $.ajax({
                type: 'POST',
                url: 'config/config.php', // Replace with the appropriate URL
                data: formData,
                success: function(response) {
                    // Show the response in the result div and proceed to step 3
                    $('.result').html(response); // Show response in the result div
                    setStep(3); // Show step 3
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                },
                complete: function() {
                    // Set submitting flag back to false after AJAX request is complete
                    isSubmitting = false;
                }
            });
        });

        // Function to handle changing steps
        $('.btn[data-set-step]').click(function() {
            var step = $(this).data('set-step');
            setStep(step);
        });
    });

    // Function to validate the form before submission
    function validateForm() {
        var radios = document.getElementsByName("rating");
        var formValid = false;

        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                formValid = true;
                break;
            }
        }

        if (!formValid) {
            alert("Please select a rating.");
            return false; // Stop form submission
        }
        return true; // Allow form submission
    }

    // Get the current date and set it in the date input field
    const today = new Date();
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1;
    if (mm < 10) {
        mm = '0' + mm;
    }
    let dd = today.getDate();
    if (dd < 10) {
        dd = '0' + dd;
    }
    document.getElementById('date').value = `${yyyy}-${mm}-${dd}`;
</script>


</body>
</html>
