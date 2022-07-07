<div class="table-responsive">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Galeri</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">  
                <div class="text-center px-4 mb-3">
                    <form class="form-group" id="form_input">
                        <div class="form-group">
                            <form class="user" id="form_input">
                                <div class="form-group">
                                    <input id="id_user" type="hidden" class="form-control form-control-user " name="id_user" value="{{ Auth::user()->id }}" autocomplete="name">
                                </div>
                                <div class="form-group">
                                    <label for="foto" class="labeled-form">Foto</label>
                                    <input id="foto" type="file"  accept=".png,.jpg,.jpeg" class="form-control form-control-user" name="foto">
                                </div>
                                <div class="form-group">
                                    <label for="judul" class="labeled-form">Judul</label>
                                    <input name="judul" id="judul" class="form-control form-control-user" value="{{$galeri->judul}}">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_kegiatan" class="labeled-form">Tanggal Kegiatan</label>
                                    <input type="text" class="form-control form-control-user" readonly name="tanggal_kegiatan" id="tanggal_kegiatan" value="{{$galeri->tanggal_kegiatan}}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="load_list(1);">Batal</button>
                                    @if ($galeri->id)
                                        <button class="btn btn-primary" id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('office.galeri.update',$galeri->id)}}','PATCH')">Simpan Perubahan</button>
                                    @else
                                        <button class="btn btn-primary" id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('office.galeri.store')}}','POST')">Simpan</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    dates('tanggal_kegiatan');
</script>