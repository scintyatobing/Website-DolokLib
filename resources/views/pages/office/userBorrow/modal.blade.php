<div class="modal-header">
    <h5 class="modal-title" id="userBorrowModal">Masukan Kondisi Buku</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<div class="modal-body">
  <form class="user" id="form_input">
      <div class="form-group br10">
        <select name="keadaan" id="keadaan" class="form-control br10">
            <option value="">Pilih Keadaan</option>
            
            <option value="baik">Baik</option>
            <option value="rusak">Rusak</option>
        </select>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" id="tombol_simpan" onclick="save_form_modal('#tombol_simpan','#form_input','{{route('office.user-borrow.update',$borrow->id)}}','#userBorrowModal','PATCH')">Simpan Perubahan</button>
      </div>
    </form>
</div>