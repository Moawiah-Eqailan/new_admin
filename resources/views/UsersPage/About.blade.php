@include('UsersPage.layouts.header')

<div class="about-us-container">
    <br>
    <h1 class="fw-bold mb-4 text-center about-us-title">About <span class="text-primary">Us</span></h1>
    <hr class="my-4">


    <div class="about-us-description mb-5" style="font-size: 0.95rem; margin: 16px auto; padding: 20px; background-color: #ffffff; border-radius: 8px;        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 800px;">
        <p class="hero-paragraph" style="line-height: 1.6; margin-bottom: 1.5rem;">
            Welcome to <strong class="text-primary">BATPARTS</strong>, your online store specializing in car spare parts!
        </p>

        <p class="hero-paragraph" style="line-height: 1.6; margin-bottom: 1.5rem;">
            We are an online store committed to providing the best shopping experience for our customers across the Hashemite Kingdom of Jordan by offering a wide range of high-quality car parts known for their efficiency and reliability. We strive to meet the needs of every customer, whether you own a personal vehicle or manage a maintenance workshop. We offer all the essential spare parts and accessories that meet the highest standards of quality and safety.
        </p>

        <p class="hero-paragraph" style="line-height: 1.6; margin-bottom: 1.5rem;">
            At our store, we don’t just sell spare parts; we provide comprehensive car maintenance solutions. We collaborate with the best local and international suppliers to ensure the availability of high-quality products that meet global industry standards. Our store offers spare parts for a wide variety of car brands and models, helping you find the perfect match for your vehicle.
        </p>

        <p class="hero-paragraph" style="line-height: 1.6; margin-bottom: 1.5rem;">
            We also provide fast and secure delivery services to all regions of Jordan, ensuring your orders reach you conveniently and effortlessly. Additionally, we offer flexible and secure payment options, including cash on delivery, to make the purchasing process simpler and safer.
        </p>

        <p class="hero-paragraph" style="line-height: 1.6; margin-bottom: 1.5rem;">
            Our goal is to be the first choice for all car owners in Jordan looking for high-quality spare parts, excellent service, and competitive prices. We are constantly working to expand our services and provide the best solutions to ensure our customers’ comfort and complete satisfaction.
        </p>

        <p class="hero-paragraph" style="line-height: 1.6; margin-bottom: 1.5rem;">
            We believe every car deserves the best care, and we are here to ensure you get the parts and services you need to maintain your vehicle’s performance. Thank you for trusting us, and we are committed to delivering the best shopping experience and after-sales service.
        </p>
        <div class="d-flex mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-primary me-2">Back</a>
        </div>
    </div>

</div>
@include('UsersPage.layouts.footer')