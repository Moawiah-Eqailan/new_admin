<head>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>
<div class="d-flex mt-4" style="margin-left: 44px;">
    <a href="{{ url()->previous() }}" class="btn btn-primary me-2">Back</a>
</div>
<br><br>
<footer id="footer" class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; 2024 BAT MAN</p>
        <div class="d-flex justify-content-center">
            <a href="https://www.facebook.com" class="text-white mx-2">Facebook</a>
            <a href="https://www.x.com" class="text-white mx-2">𝕏</a>
            <a href="https://www.instagram.com" class="text-white mx-2">Instagram</a>

        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>


</body>

</html>