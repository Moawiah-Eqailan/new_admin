@include('UsersPage.layouts.header')

<head>
    <!-- Sweet Alert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700|Nova+Mono&display=swap');
        @import url('https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700&display=swap');

        .modal-wrapper {
            display: flex;
            flex-flow: column wrap;
            justify-content: center;
            align-items: center;
            width: 80vw;
            background-color: #edeef2;
            border-radius: 20px;
            box-shadow: 0 0 10px -5px #2d2d2d;
            padding: 1rem;
            box-sizing: border-box;
        }

        .card-image {
            font-family: 'Nova Mono', monospace;
            position: relative;
            width: 100%;
            max-width: 300px;
            min-height: 160px;
            max-height: 190px;
            margin-bottom: 1rem;
            z-index: 0;
        }

        .card-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            max-width: 300px;
            box-shadow: 0px 10px 10px -10px black;
        }

        .card-logo {
            position: absolute;
            right: 0.5rem;
            display: flex;
            width: 50px;
            height: 30px;
        }

        .card-front .card-logo {
            top: 0.5rem;
        }

        .card-rear .card-logo {
            bottom: 1rem;
        }

        .logo-circle {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .logo-circle.left {
            background-color: #eb001b;
        }

        .logo-circle.right {
            background-color: #f79e1b;
            opacity: 0.8;
            margin-left: -10px;
        }

        .card-front,
        .card-rear {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            color: #edeef2;
            font-size: 14px;
            letter-spacing: 1px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-flow: column wrap;
            backface-visibility: hidden;
            transition: transform .5s linear 0s;
        }

        .card-front .card-number {
            z-index: 2;
        }

        .card-front .card-info {
            display: flex;
            flex-flow: column wrap;
            font-size: 12px;
        }

        .card-front .card-info.left {
            text-align: left;
            position: absolute;
            left: 0.75rem;
            bottom: 0.75rem;
        }

        .card-front .card-info.right {
            text-align: right;
            position: absolute;
            right: 0.75rem;
            bottom: 0.75rem;
        }

        .card-front .card-holder-title,
        .card-front .valid-thru-title {
            font-size: 10px;
            margin-bottom: 5px;
        }

        .card-rear .black-bar {
            position: absolute;
            left: 0px;
            top: 10%;
            width: 100%;
            height: 30px;
            background-color: black;
        }

        .card-rear .card-info {
            width: 100%;
            display: flex;
            justify-content: flex-start;
            padding-left: 5%;
            z-index: 2;
        }

        .card-rear .card-info .white-bar {
            width: 50%;
            height: 30px;
            background-color: #757575;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='5' height='5' viewBox='0 0 20 20'%3E%3Cg %3E%3Cpolygon fill='%23ffffff' points='20 10 10 0 0 0 20 20'/%3E%3Cpolygon fill='%23ffffff' points='0 10 0 20 10 20'/%3E%3C/g%3E%3C/svg%3E");
        }

        .card-rear .card-info .security-code {
            background: white;
            color: #2d2d2d;
            border-radius: 5px;
            padding: 5px 10px;
            margin: 0 10px;
        }

        .card-front {
            transform: perspective(600px) rotateY(0deg);
        }

        .card-rear {
            transform: perspective(600px) rotateY(180deg);
        }

        .active-border {
            display: none;
            position: fixed;
            border: 1px solid #f79e1b;
            border-radius: 5px;
            padding: 3px;
            transition: left ease-in-out 0.5s, top ease-in-out 0.5s,
                width ease-in-out 0.5s, height ease-in-out 0.5s;
        }

        .card-form {
            font-family: 'IBM Plex Sans', sans-serif;
            height: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form {
            text-align: center;
        }

        .form-input {
            position: relative;
            margin: 10px auto 5px auto;
        }

        .form-input input {
            outline: none;
            background: transparent;
            border: none;
            border-radius: 0;
            padding: 10px 5px 10px 40px;
            border-bottom: 2px solid #757575;
            transition: all linear 0.2s;
        }

        .form-input input:focus {
            box-shadow: inset 0 0 50px 50px #e1e3ea;
            border: 0;
            border-bottom: 2px solid black;
            border-radius: 10px 10px 0 0;
        }

        .form-input i {
            color: #2d2d2d;
            position: absolute;
            top: 10px;
            left: 15px;
            font-size: 12px;
        }

        .btn i {
            position: relative;
            top: 0;
            left: 0;
            color: white;
            font-size: 14px;
        }

        @media screen and (min-width: 500px) {
            .modal-wrapper {
                width: 70vw;
            }
        }

        @media screen and (min-width: 768px) {
            .modal-wrapper {
                width: 80vw;
                flex-flow: row nowrap;
                justify-content: space-evenly;
            }
        }

        @media screen and (min-width: 900px) {
            .modal-wrapper {
                width: 70vw;
            }
        }

        @media screen and (min-width: 1200px) {
            .modal-wrapper {
                width: 50vw;
            }
        }
    </style>
</head>

<br><br><br>

<div class="modal-wrapper">
    <div class="card-image">
        <div class="card-front">
            <img class="card-background" src="https://raw.githubusercontent.com/MoosaSaadat/card-checkout/master/card.png" alt="Credit Card">
            <div class="card-logo">
                <div class="logo-circle left"></div>
                <div class="logo-circle right"></div>
            </div>
            <span class="card-number">XXXX XXXX XXXX XXXX</span>
            <div class="card-info left">
                <span class="card-holder-title">CARDHOLDER NAME</span>
                <span class="card-holder-name">NAME SURNAME</span>
            </div>
            <div class="card-info right">
                <span class="valid-thru-title">VALID THRU</span>
                <span class="valid-thru-date">MM/YY</span>
            </div>
        </div>
        <div class="card-rear">
            <img class="card-background" src="https://raw.githubusercontent.com/MoosaSaadat/card-checkout/master/card.png" alt="Credit Card">
            <div class="card-logo">
                <div class="logo-circle left"></div>
                <div class="logo-circle right"></div>
            </div>
            <div class="black-bar"></div>
            <div class="card-info">
                <span class="white-bar"></span>
                <span class="security-code">123</span>
            </div>
        </div>
        <span class="active-border"></span>
    </div>
    <div class="card-form">
        <div class="form-wrapper">
            <form action="#" id="creditCardForm">
                <div class="form-input">
                    <i class="far fa-credit-card"></i>
                    <input type="text" name="card-number" id="#number" placeholder="Card Number" onfocus="flipCard(event);" onblur="deactivateBorder(event)" onkeyup="traceNumberInput(event)" value="">
                </div>
                <div class="form-input">
                    <i class="fas fa-user"></i>
                    <input type="text" name="card-holder-name" id="#name" placeholder="Card Holder Name" onfocus="flipCard(event);" onblur="deactivateBorder(event)" onkeyup="traceNameInput(event)" value="">
                </div>
                <div class="form-input">
                    <i class="fas fa-calendar-day"></i>
                    <input type="text" name="valid-thru-date" id="#expiry" placeholder="Expiry Date" onfocus="flipCard(event);" onblur="deactivateBorder(event)" onkeyup="traceDateInput(event)" value="">
                </div>
                <div class="form-input">
                    <i class="fas fa-lock"></i>
                    <input type="number" name="security-code" id="#code" placeholder="Security Code" onfocus="flipCard(event);" onblur="deactivateBorder(event)" onkeyup="traceCodeInput(event)" value="">
                </div>
                <div class="form-input btn">
                    <button type="submit" class="btn btn-primary me-2"> <i class="fas fa-check"></i> Done</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var isFront = true;
    var cardContainer = document.querySelector(".card-image");
    var creditCard = document.querySelector(".card-background");
    var cardFront = document.querySelector(".card-front");
    var cardRear = document.querySelector(".card-rear");
    var cardLogo = document.querySelector(".card-logo");

    // Form submission handling
    document.getElementById('creditCardForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Get all form inputs
        const cardNumber = document.querySelector('[name="card-number"]').value;
        const cardHolder = document.querySelector('[name="card-holder-name"]').value;
        const expiryDate = document.querySelector('[name="valid-thru-date"]').value;
        const securityCode = document.querySelector('[name="security-code"]').value;

        // Basic validation
        if (cardNumber.length === 19 && // Card number with spaces
            cardHolder.trim() !== '' &&
            expiryDate.length === 5 &&
            securityCode.length === 3) {

            // Create and show the sweet alert
            Swal.fire({
                title: 'شكراً لشرائك من متجرنا',
                text: 'طلبك قيد المعالجة',
                icon: 'success',
                confirmButtonText: 'حسناً'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to home page
                    window.location.href = '/';
                }
            });
        } else {
            // Show error if form is incomplete
            Swal.fire({
                title: 'خطأ',
                text: 'الرجاء إدخال جميع البيانات بشكل صحيح',
                icon: 'error',
                confirmButtonText: 'حسناً'
            });
        }
    });
    12

    function flipCard(e) {
        if ((isFront && e.target.name == "security-code") || (!isFront && e.target.name != "security-code")) {
            setTimeout(() => {
                activateBorder(e);
            }, 500);
            if (isFront) {
                cardFront.style.transform = "perspective( 600px ) rotateY( -180deg )";
                cardRear.style.transform = "perspective( 600px ) rotateY( 0deg )";
            } else {
                cardFront.style.transform = "perspective( 600px ) rotateY( 0deg )";
                cardRear.style.transform = "perspective( 600px ) rotateY( 180deg )";
            }
            isFront = !isFront;
        } else activateBorder(e);
    }

    function activateBorder(e) {
        let borderBox = document.querySelector(".active-border");
        let focusedInput = document.querySelector(`.${e.target.name}`);
        let newRect = focusedInput.getBoundingClientRect();
        let removePadding = 4;

        borderBox.style.display = "inline-block";
        borderBox.style.opacity = "1";
        borderBox.style.height = newRect.height + "px";
        borderBox.style.width = newRect.width + "px";
        borderBox.style.top = (newRect.top - removePadding) + "px";
        borderBox.style.left = (newRect.left - removePadding) + "px";
    }

    function deactivateBorder(e) {
        let borderBox = document.querySelector(".active-border");
        borderBox.style.opacity = "0";
    }

    function traceNumberInput(e) {
        let focusedInput = document.querySelector(`.${e.target.name}`);
        let newString = "";
        let spaceCounter = [4, 9, 14];
        let initString = "XXXX XXXX XXXX XXXX";

        e.target.value = e.target.value.replace(/\D/g, '');

        if (e.target.value.length >= 1 && e.target.value.length <= 19) {
            if (spaceCounter.some((val) => e.target.value.length == val)) {
                e.target.value += " ";
            }

            let userInput = e.target.value;
            for (let i = 0; i < 19; i++) {
                if (i < userInput.length) {
                    newString += userInput[i];
                } else {
                    newString += initString[i];
                }
            }
            focusedInput.innerHTML = newString;
        } else {
            e.target.value = e.target.value.substr(0, 19);
        }
    }


    function traceNameInput(e) {
        e.target.value = e.target.value.replace(/[^A-Za-z]/g, '');

        if (e.target.value.length > 70) {
            e.target.value = e.target.value.substring(0, 70);
        }

        let focusedInput = document.querySelector(`.${e.target.name}`);
        if (e.target.value == "") focusedInput.innerHTML = "NAME SURNAME";
        else focusedInput.innerHTML = e.target.value.toUpperCase();
    }


    function traceDateInput(e) {
        let focusedInput = document.querySelector(`.${e.target.name}`);
        let newString = "";
        let initString = "MM/YY";

        if (e.target.value.length == 2) e.target.value = e.target.value + "/";

        if (e.target.value.length < 6) {
            if (e.target.value.length === 1 && e.target.value > 1) {
                e.target.value = "0" + e.target.value;
            }

            if (e.target.value.length === 3) {
                const month = parseInt(e.target.value.substring(0, 2), 10);
                const year = parseInt(e.target.value.substring(3), 10);

                if (month > 12) {
                    e.target.value = e.target.value.substring(0, 2);
                }
                if (year < 25 || year > 30) {
                    e.target.value = e.target.value.substring(0, 2);
                }
            }

            for (let i = 0; i < 5; i++) {
                if (i < e.target.value.length) {
                    newString += e.target.value[i];
                } else {
                    newString += initString[i];
                }
            }

            focusedInput.innerHTML = newString;
        } else {
            e.target.value = e.target.value.substr(0, 5);
        }
    }


    function traceCodeInput(e) {
        let focusedInput = document.querySelector(`.${e.target.name}`);
        if (e.target.value.length <= 3) {
            if (e.target.value == "") focusedInput.innerHTML = "123";
            else focusedInput.innerHTML = e.target.value;
        } else {
            e.target.value = e.target.value.substr(0, 3);
        }
    }
    // window.addEventListener("load", getImageSize);
    // window.addEventListener("resize", getImageSize);
    function getImageSize() {
        var img = document.querySelector('.card-background');
        cardContainer.style.height = img.clientHeight + "px";
        cardContainer.style.width = img.clientWidth + "px";
    }
</script>
@include('UsersPage.layouts.footer')