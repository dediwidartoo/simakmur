#############blade

  <!-- Modal edit-->
        <div id="modal-edit" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Data</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product.update') }}" method="post" class="form" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="id" id="id-product" value="">
                            <div class="form-group">
                                <label for="">Nama Produk <span class="label-required">*</span></label>
                                <input type="text" name="product" id="product" class="form-control input-sm" placeholder="Nama Produk..." required maxlength="60" value="{{ old('product') }}">
                            </div>

                            <div class="form-group">
                                <label for="">Harga <span class="label-required">*</span></label>
                                <input type="number" name="price" id="price" class="form-control input-sm" placeholder="Harga Produk..." required min="0" max="9999999999" value="{{ old('price') }}">
                            </div>

                            <div class="form-group">
                                <label for="">Stok <span class="label-required">*</span></label>
                                <input type="number" name="stock" id="stock" class="form-control input-sm" placeholder="Stok Produk..." required min="0" max="9999999999" value="{{ old('stock') }}">
                            </div>

                            <div class="form-group">
                                <label for="">Gambar</label>
                                <input type="file" name="images[]" id="images" class="form-control input-sm" multiple accept="images/*">
                            </div>

                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea id="summernote-edit" class="summernote" name="description" id="description">{{ old('description') }}</textarea>
                            </div>

                            <hr>
                            <input type="submit" value="Ubah" class="btn btn-primary btn-md ">
                        </form>
                    </div>
                </div>

            </div>
        </div>





###############js
 $('#table').on('click', '.edit', function() {

      const id = $(this).data('id');
      const product = $(this).data('product');
      const price = $(this).data('price');
      const stock = $(this).data('stock');
      const description = $(this).data('description');

      $('#modal-edit').find('#id-product').val(id);
      $('#modal-edit').find('#product').val(product);
      $('#modal-edit').find('#stock').val(stock);
      $('#modal-edit').find('#price').val(price);
      $('#modal-edit').find('#id').val(id);
      $('#summernote-edit').summernote('code', description);
  });