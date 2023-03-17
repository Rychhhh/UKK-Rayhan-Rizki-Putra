@php
    use Carbon\Carbon;
@endphp

<table border="1" cellspacing="1" cellpadding="5" style="width: 100%;">
    <thead>
        <th>No</th>
        <th>Nisn</th>
        <th>Nama Menu</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Nama Pegawai</th>
        <th>Created At</th>
    </thead>

    <tbody>
        @foreach ($pembayaran as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nisn }}</td>
            <td>{{ $item->tgl_bayar }}</td>
            <td>{{ $item->bulan_dibayar }}</td>
            <td>{{ $item->tahun_dibayar }}</td>
            <td>{{ $item->jumlah_bayar }}</td>
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
            <td>{{ $item->created_at->diffInMinutes(Carbon::now());            }}</td>

        </tr>
        @endforeach
    </tbody>

</table>