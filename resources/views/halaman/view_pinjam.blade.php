@extends('index')
@section('title', 'Peminjaman')

@section('isihalaman')
    <h3><center>Data Peminjaman Buku</center><h3>
    <h3><center>Langit Literasi</center></h3>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPinjamTambah"> 
    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg> Tambah Data Peminjaman 
    </button>

    <p>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <td align="center">No</td>
                <td align="center">ID Pinjam</td>
                <td align="center">Nama Petugas</td>
                <td align="center">Nama Anggota</td>
                <td align="center">Judul Buku</td>
                <td align="center">Aksi</td>
            </tr>
        </thead>

        <tbody>
            @foreach ($pinjam as $index=>$p)
                <tr>
                    <td align="center" scope="row">{{ $index + $pinjam->firstItem() }}</td>
                    <td align="center">{{$p->id_pinjam}}</td>
                    <td >{{$p->petugas->nama_petugas}}</td>
                    <td>{{$p->anggota->nama_anggota}}</td>
                    <td>{{$p->buku->judul}}</td>
                    <td align="center">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalPinjamEdit{{$p->id_pinjam}}"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>
                        </button>

                        <!-- Awal Modal EDIT data Peminjaman -->
                        <div class="modal fade" id="modalPinjamEdit{{$p->id_pinjam}}" tabindex="-1" role="dialog" aria-labelledby="modalPinjamEditLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPinjamEditLabel">Form Edit Data Peminjaman</h5>
                                    </div>
                                    <div class="modal-body">

                                        <form name="formpinjamedit" id="formpinjamedit" action="/pinjam/edit/{{ $p->id_pinjam}} " method="post" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="form-group row">
                                                <label for="id_pinjam" class="col-sm-4 col-form-label">ID Pinjam</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="id_pinjam" name="id_pinjam" value="{{ $p->id_pinjam}}" readonly>
                                                </div>
                                            </div>

                                            <p>
                                            <div class="form-group row">
                                                <label for="petugas" class="col-sm-4 col-form-label">Nama Petugas</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control" id="id_petugas" name="id_petugas">
                                                        @foreach ($petugas as $pt)
                                                            @if ($pt->id_petugas == $p->id_petugas)
                                                                <option value="{{ $pt->id_petugas }}" selected>{{ $pt->nama_petugas }}</option>
                                                            @else
                                                                <option value="{{ $pt->id_petugas }}">{{ $pt->nama_petugas }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <p>
                                            <div class="form-group row">
                                                <label for="anggota" class="col-sm-4 col-form-label">Nama Anggota</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control" id="id_anggota" name="id_anggota">
                                                        @foreach ($anggota as $a)
                                                            @if ($a->id_anggota == $p->id_anggota)
                                                                <option value="{{ $a->id_anggota }}" selected>{{ $a->nama_anggota }}</option>
                                                            @else
                                                                <option value="{{ $a->id_anggota }}">{{ $a->nama_anggota }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <p>
                                            <div class="form-group row">
                                                <label for="judul" class="col-sm-4 col-form-label">Judul Buku</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control" id="id_buku" name="id_buku">
                                                        @foreach ($buku as $bk)
                                                            @if ($bk->id_buku == $p->id_buku)
                                                                <option value="{{ $bk->id_buku }}" selected>{{ $bk->judul }}</option>
                                                            @else
                                                                <option value="{{ $bk->id_buku }}">{{ $bk->judul }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <p>
                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="pinjamtambah" class="btn btn-success">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data Peminjaman -->
                        |
                        <a href="pinjam/hapus/{{$p->id_pinjam}}" onclick="return confirm('Yakin mau dihapus?')">
                            <button class="btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!--awal pagination-->
    Halaman : {{ $pinjam->currentPage() }} <br />
    Jumlah Data : {{ $pinjam->total() }} <br />
    Data Per Halaman : {{ $pinjam->perPage() }} <br />

    {{ $pinjam->links() }}
    <!--akhir pagination-->

    <!-- Awal Modal tambah data Peminjaman -->
    <div class="modal fade" id="modalPinjamTambah" tabindex="-1" role="dialog" aria-labelledby="modalPinjamTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPinjamTambahLabel">Form Input Data Peminjaman</h5>
                </div>
                <div class="modal-body">

                    <form name="formpinjamtambah" id="formpinjamtambah" action="/pinjam/tambah " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="id_petugas" class="col-sm-4 col-form-label">Nama Petugas</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-control" id="id_petugas" name="id_petugas" placeholder="Pilih Nama Petugas">
                                    <option></option>
                                    @foreach($petugas as $pt)
                                        <option value="{{ $pt->id_petugas }}">{{ $pt->nama_petugas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <p>
                        <div class="form-group row">
                            <label for="id_anggota" class="col-sm-4 col-form-label">Nama Anggota</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-control" id="id_anggota" name="id_anggota" placeholder="Pilih Nama Anggota">
                                    <option></option>
                                    @foreach($anggota as $a)
                                        <option value="{{ $a->id_anggota }}">{{ $a->nama_anggota }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <p>
                        <div class="form-group row">
                            <label for="id_buku" class="col-sm-4 col-form-label">Judul Buku</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-control" id="id_buku" name="id_buku" placeholder="Pilih Judul Buku">
                                    <option></option>
                                    @foreach($buku as $bk)
                                        <option value="{{ $bk->id_buku }}">{{ $bk->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <p>
                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="pinjamtambah" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal tambah data Peminjaman -->
    
@endsection