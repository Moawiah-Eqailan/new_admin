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
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
        }

        .about-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .hero-section {
            background: linear-gradient(rgba(148, 202, 33, 0.1), rgba(148, 202, 33, 0.05));
            padding: 60px 20px;
            text-align: center;
            border-radius: 20px;
            margin-bottom: 50px;
            animation: fadeIn 1s;
        }

        .hero-section h1 {
            color: #333;
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero-section h1 span {
            color: #94CA21;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin: 50px 0;
        }

        .feature-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s;
        }

        .feature-box:hover {
            transform: translateY(-10px);
        }

        .feature-box i {
            color: #94CA21;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .feature-box h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .content-section {
            background: white;
            padding: 40px;
            border-radius: 20px;
            margin: 40px 0;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1.5s;
        }

        .content-section p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin: 40px 0;
        }

        .stat-box {
            text-align: center;
            padding: 20px;
            background: #94CA21;
            color: white;
            border-radius: 10px;
            animation: fadeInUp 2s;
        }

        .stat-box h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
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

<div class="about-container">
    <div class="hero-section">
        <h1>About <span>BATPARTS</span></h1>
        <p>Your Trusted Partner in Auto Parts Excellence</p>
    </div>

    <div class="feature-grid">
        <div class="feature-box">
            <i class="fas fa-check-circle"></i>
            <h3>Quality Assured</h3>
            <p>We partner with leading manufacturers to ensure top-quality auto parts.</p>
        </div>
        <div class="feature-box">
            <i class="fas fa-truck"></i>
            <h3>Fast Delivery</h3>
            <p>Nationwide delivery across Jordan with efficient shipping services.</p>
        </div>
        <div class="feature-box">
            <i class="fas fa-headset"></i>
            <h3>Expert Support</h3>
            <p>Professional customer service team ready to assist you.</p>
        </div>
    </div>

    <div class="content-section">
        <p>
            Welcome to <strong>BATPARTS</strong>, your premier destination for high-quality auto spare parts in Jordan. We've established ourselves as a leading online marketplace specializing in automotive components, serving both individual car owners and professional workshops across the Hashemite Kingdom.
        </p>
        <p>
            Our commitment to excellence drives us to source only the finest parts from trusted manufacturers worldwide. We understand that your vehicle deserves nothing but the best, which is why we maintain strict quality control standards for all our products.
        </p>
        <p>
            At BATPARTS, we offer comprehensive automotive solutions, including:
        </p>
        <ul style="margin-left: 20px; margin-bottom: 20px; color: #666;">
            <li>Genuine OEM parts for all major vehicle brands</li>
            <li>High-quality aftermarket alternatives</li>
            <li>Performance and upgrade components</li>
            <li>Maintenance and service parts</li>
        </ul>
        <p>
            Our innovative online platform makes finding the right parts simple and efficient. With detailed product information, compatibility checks, and expert guidance, we ensure you get exactly what your vehicle needs.
        </p>
        <p>
            We pride ourselves on providing secure and flexible payment options, including cash on delivery, making your shopping experience both convenient and safe. Our dedicated customer service team is always ready to assist you with any queries or concerns.
        </p>
    </div>

    <div class="stats-section">
        <div class="stat-box">
            <h2>10K+</h2>
            <p>Products</p>
        </div>
        <div class="stat-box">
            <h2>5K+</h2>
            <p>Customers</p>
        </div>
        <div class="stat-box">
            <h2>100+</h2>
            <p>Brands</p>
        </div>
        <div class="stat-box">
            <h2>24/7</h2>
            <p>Support</p>
        </div>
    </div>
</div>

@include('UsersPage.layouts.footer')