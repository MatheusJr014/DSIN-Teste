<template lang="">
<!-- Footer -->
<footer class="bg-dark text-white py-4">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-4">
            <div class="d-flex align-items-center mb-3">
              <scissors-icon class="me-2" size="24" />
              <span class="fw-bold fs-4">BeautyTime</span>
            </div>
            <p>Your destination for beauty and relaxation.</p>
            <div class="d-flex gap-3">
              <a href="#" class="text-white">
                <facebook-icon />
              </a>
              <a href="#" class="text-white">
                <instagram-icon />
              </a>
              <a href="#" class="text-white">
                <twitter-icon />
              </a>
            </div>
          </div>
          <div class="col-lg-2 col-md-4">
            <h5 class="fw-bold mb-3">Quick Links</h5>
            <ul class="list-unstyled">
              <li class="mb-2"><a href="#" class="text-decoration-none text-white-50">Home</a></li>
              <li class="mb-2"><a href="#services" class="text-decoration-none text-white-50">Services</a></li>
              <li class="mb-2"><a href="#about" class="text-decoration-none text-white-50">About</a></li>
              <li><a href="#contact" class="text-decoration-none text-white-50">Contact</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-4">
            <h5 class="fw-bold mb-3">Services</h5>
            <ul class="list-unstyled">
              <li class="mb-2"><a href="#" class="text-decoration-none text-white-50">Hair Styling</a></li>
              <li class="mb-2"><a href="#" class="text-decoration-none text-white-50">Makeup</a></li>
              <li class="mb-2"><a href="#" class="text-decoration-none text-white-50">Manicure</a></li>
              <li><a href="#" class="text-decoration-none text-white-50">Facial</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-4">
            <h5 class="fw-bold mb-3">Newsletter</h5>
            <p>Subscribe to get updates on our latest offers and services.</p>
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Your email">
              <button class="btn btn-primary" type="button">Subscribe</button>
            </div>
          </div>
        </div>
        <hr class="my-4">
        <div class="text-center text-white-50">
          <p class="mb-0">&copy; {{ new Date().getFullYear() }} BeautyTime. All rights reserved.</p>
        </div>
      </div>
    </footer>
</template>
<script>
export default {

}
</script>
<style lang="">

</style>