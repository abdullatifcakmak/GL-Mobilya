<?php 
$pageTitle = "Ödeme";
include "_header.php"; 

?>



		<!-- Start Hero Section -->
        <div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Ödeme İşlemleri</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<div class="untree_co-section">
		    <div class="container">
		      <div class="row mb-5">
		        <div class="col-md-12">
		          <div class="border p-4 rounded" role="alert">
		            Zaten üye misiniz ? <a href="index.php">Buraya tıklayarak</a> Giriş yapın
		          </div>
		        </div>
		      </div>
		      <div class="row">
		        <div class="col-md-6 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Ödeme Detayları</h2>
		          <div class="p-3 p-lg-5 border bg-white">
		            <div class="form-group">
		              <label for="c_country" class="text-black">Ülke <span class="text-danger">*</span></label>
		              <select id="c_country" class="form-control">
		                <option value="1">Ülke Seçiniz</option>    
		                <option value="2">Türkiye</option>    
		                <option value="3">Almanya</option>    
		                <option value="4">Fransa</option>    
		                <option value="5">Hollanda</option>    
		                <option value="6">İngiltere</option>    
		                <option value="7">Amerika</option>    
		              </select>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="c_fname" class="text-black">Ad <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_fname" name="c_fname">
		              </div>
		              <div class="col-md-6">
		                <label for="c_lname" class="text-black">Soyad <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_lname" name="c_lname">
		              </div>
		            </div>

		            <div class="form-group row">
		              <div class="col-md-12">
		                <label for="c_companyname" class="text-black">Ürün Adı </label>
		                <input type="text" class="form-control" id="c_companyname" name="c_companyname">
		              </div>
		            </div>

		            <div class="form-group row">
		              <div class="col-md-12">
		                <label for="c_address" class="text-black">Adres <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address">
		              </div>
		            </div>

		            <div class="form-group mt-3">
		              <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
		            </div>

		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="c_state_country" class="text-black">İl <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_state_country" name="c_state_country">
		              </div>
		              <div class="col-md-6">
		                <label for="c_postal_zip" class="text-black">Posta / Kod <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
		              </div>
		            </div>

		            <div class="form-group row mb-5">
		              <div class="col-md-6">
		                <label for="c_email_address" class="text-black">E-Posta Adresi <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_email_address" name="c_email_address">
		              </div>
		              <div class="col-md-6">
		                <label for="c_phone" class="text-black">Telefon no <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
		              </div>
		            </div>

		            


		           

		            <div class="form-group">
		              <label for="c_order_notes" class="text-black">Sipariş Notu</label>
		              <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Notunuzu buraya yazabilirsiniz..."></textarea>
		            </div>

		          </div>
		        </div>
		        <div class="col-md-6">

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Kupon Kodu</h2>
		              <div class="p-3 p-lg-5 border bg-white">

		                <label for="c_code" class="text-black mb-3">Eğer varsa kupon kodunuzu girin</label>
		                <div class="input-group w-75 couponcode-wrap">
		                  <input type="text" class="form-control me-2" id="c_code" placeholder="Kupon kodu" aria-label="Coupon Code" aria-describedby="button-addon2">
		                  <div class="input-group-append">
		                    <button class="btn btn-black btn-sm" type="button" id="button-addon2">Uygula</button>
		                  </div>
		                </div>

		              </div>
		            </div>
		          </div>

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Siparişiniz</h2>
		              <div class="p-3 p-lg-5 border bg-white">
		                <table class="table site-block-order-table mb-5">
		                  <thead>
		                    <th>Ürün</th>
		                    <th>Toplam</th>
		                  </thead>
		                  <tbody>
		                    <tr>
		                      <td>Nordic Sandalye <strong class="mx-2">x</strong> 1</td>
		                      <td>1000₺</td>
		                    </tr>
		                    <tr>
		                      <td>Ergonomik Sandalye <strong class="mx-2">x</strong>   1</td>
		                      <td>1500₺</td>
		                    </tr>
		                    <tr>
		                      <td class="text-black font-weight-bold"><strong>Sepet Toplamı</strong></td>
		                      <td class="text-black">2500₺</td>
		                    </tr>
		                    <tr>
		                      <td class="text-black font-weight-bold"><strong>Sipariş Toplamı</strong></td>
		                      <td class="text-black font-weight-bold"><strong>2500₺</strong></td>
		                    </tr>
		                  </tbody>
		                </table>

		                <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Doğrudan Banka Havalesi</a></h3>

		                  <div class="collapse" id="collapsebank">
		                    <div class="py-2">
		                      <p class="mb-0">Ödemenizi doğrudan banka hesabımıza yapın. Lütfen ödeme referansı olarak Sipariş Kimliğinizi kullanın. Siparişiniz, para hesabımıza geçene kadar gönderilmeyecektir..</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Çek Ödemesi</a></h3>

		                  <div class="collapse" id="collapsecheque">
		                    <div class="py-2">
		                      <p class="mb-0">Ödemenizi doğrudan banka hesabımıza yapın. Lütfen ödeme referansı olarak Sipariş Kimliğinizi kullanın. Siparişiniz, para hesabımıza geçene kadar gönderilmeyecektir.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="border p-3 mb-5">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

		                  <div class="collapse" id="collapsepaypal">
		                    <div class="py-2">
		                      <p class="mb-0">Ödemenizi doğrudan banka hesabımıza yapın. Lütfen ödeme referansı olarak Sipariş Kimliğinizi kullanın. Siparişiniz, para hesabımıza geçene kadar gönderilmeyecektir.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='thankyou.php'">Sipariş Ver</button>
		                </div>

		              </div>
		            </div>
		          </div>

		        </div>
		      </div>
		      <!-- </form> -->
		    </div>
		  </div>




<?php include "_footer.php"; ?>