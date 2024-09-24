<main id="main" class="main">
  <div class="container">
    <div class="pagetitle">
      <h1></h1>
      <nav>
         <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                 
<li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/User')?>"
                        ><i class="bx bx-user"></i>Pembimbing1</a
                      >
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('home/User1')?>"
                        ><i class="bx bx-user"></i>Pembimbing2</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"
                        ><i class="bx bx-user"></i>Siswa</a
                      >
</li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/t_user')?>"
                        ><i class="bx bx"></i> +Tambah</a
                      >
                    </li>
                   
                      
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

              <div class="d-flex justify-content-between align-items-center mb-3">

                <!-- Add a search input on the right side -->
                <div class="search-container">
                  <label for="search">Search:</label>
                  <input type="text" id="search" placeholder="Enter keywords...">
                </div>
              </div>
             
              <!-- Table with stripped rows -->
              <table class="table datatable" id="mitraTable">
                <thead>
                <tr style="font-weight: bold; color: black; font-size: larger;">
    <td align="center" scope="col">No</td>
    <td align="center" scope="col">Nama Guru</td>
    <td align="center" scope="col">username</td>
    <td align="center" scope="col">Jurusan</td>
    <td align="center" scope="col">Tindakan</td>
    </tr> 
                </thead>
                <tbody>
                <?php
$no = 1;
foreach ($s as $key) {
    if ($key->Level === "Siswa") { // Add this condition
?>
    <tr>
          <td align="center" scope="col"><?= $no++ ?></td>
        <td align="center" scope="col"><?= $key->NamaA?></td>
        <td align="center" scope="col"><?= $key->Username?></td>
        <td align="center" scope="col"><?= $key->Jurusan?></td>
        <td align="center">
             
                            <a href="<?= base_url('home/Pdelete/'.$key->id_user)?>">
                                <i class="btn btn-danger">delete</i>
                            </a>
                          
            </td>
      </tr>
<?php
    }
}
?>
                </tbody>
              </table>
               </div>
          </div>

        </div>
      </div>
    </section>

  </div>
</main><!-- End #main -->

<script>
  // Add JavaScript for search functionality
  document.getElementById('search').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#mitraTable tbody tr');

    rows.forEach(row => {
      const rowData = row.textContent.toLowerCase();
      row.style.display = rowData.includes(searchValue) ? '' : 'none';
    });
  });
</script>