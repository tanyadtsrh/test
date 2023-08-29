$(function () {
  const modalLabel = $("#exampleModalLabel");
  const input_nama = $("#nama");
  const input_jurusan = $("#jurusan");
  const input_id = $("#id");
  const container_input_id = $("#containerId");
  const submitButton = $(".modal-footer button[type='submit']");
  const modalForm = $("#modalForm");

  $(".tambahButton").on("click", function () {
    modalLabel.text("Tambah Mahasiswa");
    container_input_id.attr("style", ""); //balikin ke default bootstrap
    submitButton.text("Add");
  });

  $(".editButton").on("click", function () {
    const idMahasiswa = $(this).data("id"); // ini buat ngambil data-id mirip kayak dataset.id kalo di JS biasa

    modalLabel.text("Edit Data Mahasiswa");
    container_input_id.attr("style", "display: none;");
    submitButton.text("Edit");

    $.ajax({
      url: `http://localhost/phpmvc/public/mahasiswa/getedit`,
      data: { id: idMahasiswa },
      dataType: "json",
      method: "post",
      success: function (data) {
        // console.log(data);
        input_nama.val(data.nama);
        input_jurusan.val(data.jurusan);
        input_id.val(data.id);
      },
    }); //mengirim respon POST tanpa harus pindah link https dengan mengarahkan ke halaman http url

    modalForm.attr("action", `http://localhost/phpmvc/public/mahasiswa/edit/`);
  });
});
