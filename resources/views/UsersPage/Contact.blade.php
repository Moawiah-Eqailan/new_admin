@include('UsersPage.layouts.header')

<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: #f8f9fa;
        }

        
        .contact-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .contact-header h1 {
            color: #94CA21;
            font-size: 2.5rem;
            margin-bottom: 15px;
            animation: fadeInDown 1s;
        }

        .contact-header p {
            color: #666;
            font-size: 1.1rem;
            animation: fadeIn 1.5s;
        }

        .contact-info-boxes {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            animation: fadeInUp 1s;
        }

        .info-box:hover {
            transform: translateY(-10px);
        }

        .info-box i {
            color: #94CA21;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            animation: fadeInUp 1.5s;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #333;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #94CA21;
            outline: none;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .submit-btn {
            background: #94CA21;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }

        .submit-btn:hover {
            background: #7dab1c;
            transform: translateY(-2px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>

    <div class="contact-container">
        <div class="contact-header">
            <h1>Contact Us</h1>
            <p>We are here to help you find the right spare parts for your car.</p>
        </div>

        <div class="contact-info-boxes">
            <div class="info-box">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Our Location</h3>
                <p>Amman, Jordan</p>
            </div>
            <div class="info-box">
                <i class="fas fa-phone-alt"></i>
                <h3>Call Us</h3>
                <p>+962 7X XXX XXXX</p>
            </div>
            <div class="info-box">
                <i class="fas fa-envelope"></i>
                <h3>Email</h3>
                <p>info@autoparts.com</p>
            </div>
        </div>

        <div class="contact-form">
            <form>
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" name="name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> Phone Number</label>
                        <input type="tel" name="phone" placeholder="Enter your phone number">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-tag"></i> Subject</label>
                        <input type="text" name="subject" placeholder="Enter the subject" required>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-comment"></i> Your Message</label>
                    <textarea name="message" rows="5" placeholder="Write your message here" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-globe"></i> Country</label>
                        <input type="text" value="Jordan" readonly>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-city"></i> City</label>
                        <select name="city">
                            <option value="" disabled selected>Select your city</option>
                            <option value="Amman">Amman</option>
                            <option value="Zarqa">Zarqa</option>
                            <option value="Irbid">Irbid</option>
                            <option value="Aqaba">Aqaba</option>
                            <option value="Madaba">Madaba</option>
                            <option value="Jerash">Jerash</option>
                            <option value="Ajloun">Ajloun</option>
                            <option value="Karak">Karak</option>
                            <option value="Tafilah">Tafilah</option>
                            <option value="Maan">Maan</option>
                            <option value="Balqa">Balqa</option>
                            <option value="Mafraq">Mafraq</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
    </div>

    @include('UsersPage.layouts.footer')