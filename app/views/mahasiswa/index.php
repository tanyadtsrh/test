<!-- Button trigger modal -->
<div class="flashContainer">
  <?php if (isset($_SESSION['flash'])) {
    Flasher::flash();
    unset($_SESSION['flash']);
  } ?> 
  <!-- kalo SESSION Flash ada maka munculkan flash nya dan merefresh SESSION-->
</div>

<button type="button" class="btn btn-primary mt-2 tambahButton" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tambah Mahasiswa
</button>

<table class="table table-dark table-striped mt-4 table-hover">
  <thead>
    <td>Nama</td>
    <td>Detail</td>
    <td>Edit</td>
    <td>Hapus</td>
  </thead>
  <?php foreach($data['mahasiswa'] as $mahasiswa) : ?>
    <tr>
        <td><?= $mahasiswa['nama'];?></td>
        <td>
          <a style="text-decoration : none" 
          href="<?= BASEURL;?>mahasiswa/detail/<?= $mahasiswa['id']; ?>" 
          class="badge bg-primary">Detail</a>
        </td>
        <td>
          <a style="text-decoration : none" 
          href="<?= BASEURL;?>mahasiswa/edit/<?= $mahasiswa['id']; ?>" 
          class="badge bg-warning editButton" data-id=<?= $mahasiswa['id']; ?> 
          data-bs-toggle="modal" data-bs-target="#exampleModal"
          >Edit</a>
        </td>
        <td>
          <a style="text-decoration : none" 
          href="<?= BASEURL;?>mahasiswa/hapus/<?= $mahasiswa['id']; ?>" 
          class="badge bg-danger" onclick="return confirm('Yakin mau menghapus?');" >Hapus</a>
        </td>
    </tr>
  <?php endforeach; ?>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form action="<?= BASEURL;?>mahasiswa/tambah" id="modalForm" method="post">

        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama">
        </div>

        <div class="mb-3" id="containerId">
          <label for="id" class="form-label">ID</label>
          <input type="number" class="form-control" id="id" name="id">
        </div>

        <div class="mb-3">
          <label for="jurusan" class="form-label">Jurusan</label>
          <select class="form-select" id="jurusan" name="jurusan" >
            <option value="Computer Science" selected>Computer Science</option>
            <option value="Data Science">Data Science</option>
            <option value="Machine Learning">Machine Learning</option>
            <option value="UI/UX Design">UI/UX Design</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>