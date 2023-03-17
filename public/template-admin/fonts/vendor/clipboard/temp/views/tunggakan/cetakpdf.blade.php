@php
    use Carbon\Carbon;
@endphp
<div>
    {{ Carbon::now()->format('Y-m-d'); }}
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" width="50" height="50">
<span style="font-weight: bold;">SPP YUK</span>
<img class="me-5"  style="margin-left: 200px;"  src="https://www.shutterstock.com/image-vector/spp-letter-original-monogram-logo-260nw-1772852024.jpg" alt="" width="150">
<div class="d-flex flex-row mb-3 ">
    <div>Nisn
     <span style="margin-left: 110px;">: {{ $tunggakan->id_siswa}}</span>
    </div>
    <div>
        Bulan
        <span style="margin-left: 102px;">: {{ $tunggakan->bulan}}</span>
    </div>
    <div>
        Total Tunggakan
        <span style="margin-left: 30px;">: {{ $tunggakan->total_tunggakan}}</span>
    </div>
    <div>
        Sisa Bulan
        <span style="margin-left: 71px;">: {{ $tunggakan->sisa_bulan}} Bulan</span>
    </div>
    <div>
        Deskripsi
        <span style="margin-left: 79px;">: {{ $tunggakan->deskripsi}}</span>
    </div>
</div>
<b>HARAP DIBAYAR DENGAN SEGERA DAN SIMPAN STRUK INI.</b>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>