




<section class="validOTPForm">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="text-center">
                            Account verification
                        </h4>
                    </div>


                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="phone_no">Phone Number</label>

                                <input type="text" class="form-control" name="phone_no" id="number" placeholder="(Code) *******">
                            </div>
                            <div id="recaptcha-container"></div>
                                <a href="#" id="getcode" class="btn btn-dark btn-sm">Get Code</a>

                                <div class="form-group mt-4">
                                    <input type="text" name="" id="codeToVerify" name="getcode" class="form-control" placeholder="Enter Code">
                                </div>

                                <a href="#" class="btn btn-dark btn-sm btn-block" id="verifPhNum">Verify Phone No</a>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {

const firebaseConfig = {
    apiKey: "AIzaSyB4jtkYgM8bqllAlTJqpwURkyAgT8ddYGc",
  authDomain: "chat-app-4ca73.firebaseapp.com",
  databaseURL: "https://chat-app-4ca73-default-rtdb.firebaseio.com",
  projectId: "chat-app-4ca73",
  storageBucket: "chat-app-4ca73.appspot.com",
  messagingSenderId: "1007604660125",
  appId: "1:1007604660125:web:3f1301fffa4c8cc4dee174",
  measurementId: "G-NBKLX3YWWP"
  };

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
    'size': 'invisible',
    'callback': function (response) {
        // reCAPTCHA solved, allow signInWithPhoneNumber.
        console.log('recaptcha resolved');
    }
});
onSignInSubmit();
});



function onSignInSubmit() {
$('#verifPhNum').on('click', function() {
    let phoneNo = '';
    var code = $('#codeToVerify').val();
    console.log(code);
    $(this).attr('disabled', 'disabled');
    $(this).text('Processing..');
    confirmationResult.confirm(code).then(function (result) {
                alert('Succecss');
        var user = result.user;
        console.log(user);


        // ...
    }.bind($(this))).catch(function (error) {
    
        // User couldn't sign in (bad verification code?)
        // ...
        $(this).removeAttr('disabled');
        $(this).text('Invalid Code');
        setTimeout(() => {
            $(this).text('Verify Phone No');
        }, 2000);
    }.bind($(this)));

});


$('#getcode').on('click', function () {
    alert('hjdhjhdj');
    var phoneNo = $('#number').val();
    console.log(phoneNo);
    // getCode(phoneNo);
    var appVerifier = window.recaptchaVerifier;
    firebase.auth().signInWithPhoneNumber(phoneNo, appVerifier)
    .then(function (confirmationResult) {

        window.confirmationResult=confirmationResult;
        coderesult=confirmationResult;
        console.log(coderesult);
    }).catch(function (error) {
        console.log(error.message);

    });
});
}



// function getCode(phoneNumber) {
//     var appVerifier = window.recaptchaVerifier;
//     firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
//         .then(function (confirmationResult) {
//             console.log(confirmationResult);
//             // SMS sent. Prompt user to type the code from the message, then sign the
//             // user in with confirmationResult.confirm(code).
//             window.confirmationResult = confirmationResult;
//             $('#getcode').removeAttr('disabled');
//             $('#getcode').text('RESEND');
//         }).catch(function (error) {
        
//             console.log(error);
//             console.log(error.code);
//             // Error; SMS not sent
//             // ...
//         });
//   }  
    </script>




