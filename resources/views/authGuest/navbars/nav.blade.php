<!-- Navbar -->
<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 my-3 {{ (Request::is('static-sign-up') ? 'w-100 shadow-none  navbar-transparent mt-4' : 'blur blur-rounded shadow py-2 start-0 end-0 mx4') }}">
  <div class="container-fluid {{ (Request::is('static-sign-up') ? 'container' : 'container-fluid') }}">
    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 {{ (Request::is('static-sign-up') ? 'text-white' : '') }}" href="{{ url('dashboard') }}">
      Pembayaran Listrik Pascabayar
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav d-flex justify-content-end w-100">
        <li class="nav-item">
          <a class="nav-link me-2" href="{{ url('register') }}">
            <i class="fas fa-user-circle opacity-6 me-1 text-dark"></i>
            Daftar
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="{{ url('login') }}">
            <i class="fas fa-key opacity-6 me-1 text-dark"></i>
            Masuk
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->