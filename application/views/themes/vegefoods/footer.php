<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
      
    </div>
  </section>
  <footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row">
            <div class="mouse">
                      <a href="#" class="mouse-icon">
                          <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                      </a>
                  </div>
        </div>
   
      <div class="row">
        <div class="col-md-12 text-center">

          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        2019 &copy; PT Majoo Teknologi Indonesia.
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      </p>
        </div>
      </div>
    </div>
  </footer>
  


<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<script src="<?php echo get_theme_uri('js/popper.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.easing.1.3.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.waypoints.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.stellar.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/owl.carousel.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.magnific-popup.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/aos.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.animateNumber.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/scrollax.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>

<script>
  toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

  $.ajax({
    method: 'GET',
    url: '<?php echo site_url('shop/cart_api?action=cart_info'); ?>',
    success: function (res) {
      var data = res.data;

      var total_item = data.total_item;
      $('.cart-item-total').text(total_item);
    }
  });

  $('.add-cart').click(function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var sku = $(this).data('sku');
    var qty = $(this).data('qty');
    qty = (qty > 0) ? qty : 1;
    var price = $(this).data('price');
    var name = $(this).data('name');

    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('shop/cart_api?action=add_item'); ?>',
      data: {
        id: id,
        sku: sku,
        qty: qty,
        price: price,
        name: name
      },
      success: function (res) {
        if (res.code == 200) {
          var totalItem = res.total_item;

          $('.cart-item-total').text(totalItem);
          toastr.info('Item ditambahkan dalam keranjang');
        }
        else {
          console.log('Terjadi kesalahan');
        }
      }
    });
  });
</script>
  
</body>
</html>