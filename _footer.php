		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="images/sofa.png" alt="Image" class="img-fluid">
				</div>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Bültene Abone Ol</span></h3>

							<form action="#" class="row g-3">
								<div class="col-auto">
									<input type="text" class="form-control" placeholder="Adınızı girin">
								</div>
								<div class="col-auto">
									<input type="email" class="form-control" placeholder="E-postanızı girin">
								</div>
								<div class="col-auto">
									<button class="btn btn-primary">
										<span class="fa fa-paper-plane"></span>
									</button>
								</div>
							</form>

						</div>
					</div>
				</div>

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">GL<span>.</span></a></div>
						<p class="mb-4">"GL Mobilya, evinizin ve ofisinizin şıklığını ve konforunu artırmak için modern ve kaliteli mobilyalar sunar. Tasarım ve dayanıklılığı bir araya getiren ürünlerimizle yaşam alanlarınızı güzelleştirin."</p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="about.php">Hakkımızda</a></li>
									<li><a href="services.php">Servisler</a></li>
									<li><a href="blog.php">Blog</a></li>
									<li><a href="contact.php">İletişim</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Destek</a></li>
									<li><a href="#">Canlı Sohbet</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Takımımız</a></li>
									<li><a href="#">Liderlik</a></li>
									<li><a href="#">Gizlilik Politikası</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Nordic Sandalye</a></li>
									<li><a href="#">Kruzo Aero Sandalye</a></li>
									<li><a href="#">Ergonomik Sandalye</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Telif hakkı &copy;<script>document.write(new Date().getFullYear());</script>. Her hakkı saklıdır. GL Mobilya </a>
            </p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Şartlar &amp; Koşullar</a></li>
								<li><a href="#">Gizlilik Politikası</a></li>
							</ul>
						</div>

					</div>
				</div>

			</div>
		</footer>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
		<script>
		document.addEventListener("DOMContentLoaded", function () {
    	const alertBox = document.querySelector(".alert");
    	if (alertBox) {
        	setTimeout(() => {
            alertBox.style.display = "none";
        	}, 2500); // 2,5 saniye sonra kaybolur
    	}
});
</script>		

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>

	

      $(document).ready(function () {
        $("#kayitbuton").on("click", function () {
          let hasError = false;

          // Form alanlarını sıfırla
          $("#adError").text("");
          $("#soyadError").text("");
          $("#sifreError").text("");

          // Ad doğrulama
          const ad = $("#exampleInputAd").val().trim();
          if (!ad) {
            $("#adError").text("Lütfen Adınızı Giriniz.");
            hasError = true;
          }

		  // Soyad doğrulama
          const soyad = $("#exampleInputSoyad").val().trim();
          if (!soyad) {
            $("#soyadError").text("Lütfen Soyadınızı Giriniz.");
            hasError = true;
          }

		  // Eposta doğrulama
          const eposta = $("#exampleInputEmail2").val().trim();
          if (!eposta) {
            $("#epostaError").text("E-Posta zorunludur.");
            hasError = true;
          }

          // Şifre doğrulama
          const sifre = $("#inputPassword2").val().trim();
          if (!sifre) {
            $("#sifreError").text("Şifre zorunludur.");
            hasError = true;
          }


        });
      });
    </script>
	
	
	</body>

</html>
