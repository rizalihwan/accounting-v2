<table>
    <tr>
        <th>Status Akun</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>
            @if ($kontak->aktif === 1)
                <span class="badge badge-success">
                    AKTIF
                </span>
            @else
                <span class="badge badge-danger">
                    TIDAK AKTIF
                </span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Nama</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->nama }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->email }}</td>
    </tr>
    <tr>
        <th>Telepon</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->telepon }}</td>
    </tr>
    <tr>
        <th>Tipe</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>
            {{ $kontak->pelanggan ? 'Pelanggan' . ($kontak->pemasok == true || $kontak->karyawan == true ? ', ' : '') : '' }}
            {{ $kontak->pemasok ? 'Pemasok' . ($kontak->pelanggan == true || $kontak->karyawan == true ? ', ' : '') : '' }}
            {{ $kontak->karyawan ? 'Karyawan' . ($kontak->pelanggan == true || $kontak->pemasok == true ? ', ' : '') : '' }}
        </td>
    </tr>
    <tr>
        <th>Alamat</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->alamat }}</td>
    </tr>
    <tr>
        <th>Kota</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->kota }}</td>
    </tr>
    <tr>
        <th>Kode Pos</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->kode_pos }}</td>
    </tr>
    <tr>
        <th>Kode Kontak</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->kode_kontak }}</td>
    </tr>
    <tr>
        <th>Mata Uang</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->mata_uang }}</td>
    </tr>
    <tr>
        <th>NIK</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->nik }}</td>
    </tr>
    <tr>
        <th>Kontak Person</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->kontak_person }}</td>
    </tr>
    <tr>
        <th>Website</th>
        <th>:</th>
        <td></td>
        <td></td>
        <td>{{ $kontak->website }}</td>
    </tr>
</table>
