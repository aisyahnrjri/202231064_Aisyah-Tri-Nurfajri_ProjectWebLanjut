<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

  <!-- Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('/assets/css/soft-ui-dashboard.css')}}" rel="stylesheet" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css?v=1.0.3')}}" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>

<body onload="window.print()">
  <div>
    <div class="row">
      <div class="col-12">
        <h5 class="mb-0 px-4 py-4 text-center text-uppercase">Struk Bukti Pembayaran Listrik</h5>
        <div class="row px-4">
          <div class="col-6">
            <p class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nama </p>
          </div>
          <div class="col-6">
            <p class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">: {{ $pembayaran->pelanggan->nama_pelanggan }}</p>
          </div>
          <div class="col-6">
            <p class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">Nomor KWH</p>
          </div>
          <div class="col-6">
            <p class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">: {{ $pembayaran->pelanggan->nomor_kwh }}</p>
          </div>
          <div class="col-6">
            <p class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">Alamat</p>
          </div>
          <div class="col-6">
            <p class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">: {{ $pembayaran->pelanggan->alamat }}</p>
          </div>
          <div class="col-6">
            <p class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">Tanggal Pembayaran</p>
          </div>
          <div class="col-6">
            <p class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">: {{ $pembayaran->tanggal_pembayaran }}</p>
          </div>
        </div>
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <td class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 text-center">Bulan</td>
                <td class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 text-center">Tahun</td>
                <td class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 text-center">Daya</td>
                <td class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 text-center">Tarif</td>
                <td class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 text-center">Biaya Admin</td>
                <td class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 text-center">Total Bayar</td>
                <td class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 text-center">Status</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">
                  <p class="text-xs font-weight-bold mb-0">{{ $pembayaran->tagihan->bulan }}</p>
                </td>
                <td class="text-center">
                  <p class="text-xs font-weight-bold mb-0">{{ $pembayaran->tagihan->tahun }}</p>
                </td>
                <td class="text-center">
                  <p class="text-xs font-weight-bold mb-0">{{ $pembayaran->pelanggan->tarif->daya }}</p>
                </td>
                <td class="text-center">
                  <p class="text-xs font-weight-bold mb-0">Rp {{ number_format($pembayaran->pelanggan->tarif->tarifperkwh * $pembayaran->tagihan->jumlah_meter, 0, ',', '.') }}</p>
                </td>
                <td class="text-center">
                  <p class="text-xs font-weight-bold mb-0">Rp {{ number_format(2000, 0, ',', '.') }}</p>
                </td>
                <td class="text-center">
                  <p class="text-xs font-weight-bold mb-0">Rp {{ number_format($total_bayar, 0, ',', '.') }}</p>
                </td>
                <td class="text-center">
                  <p class="text-xs font-weight-bold mb-0">Lunas</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row p-4">
          <div class="col-12">
            <div class="text-end text-uppercase text-dark text-xs font-weight-bolder opacity-7">
              Dicetak oleh
            </div>
            <div class="text-end text-uppercase text-dark text-xs font-weight-bolder opacity-7 pb-5">
            {{ $pembayaran->users->nama_admin }}
            </div>
            <div class="text-end text-uppercase text-dark text-xs font-weight-bolder opacity-7">
            {{ now()->setTimezone('Asia/Jakarta')->format('d F Y H:i:s') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<!-- Core -->
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Theme JS -->
<script src="/assets/js/soft-ui-dashboard.min.js"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>