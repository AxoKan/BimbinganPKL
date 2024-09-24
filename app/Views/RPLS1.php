<main id="main" class="main">
  <div class="container">
    <div class="pagetitle">
      <h1>Bimbingan 1 RPL</h1>
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
                  <a href="<?= base_url("home/tambah1")?>">
		<button class="btn btn-success">+ Tambah</button>
  </a>
                </div>
              </div>

              <!-- Table with stripped rows -->
              <table class="table datatable" id="mitraTable">
                <thead>
                  <tr>
                    <th style="text-align: center; vertical-align: middle;" scope="col">No</th>
                    <th style="text-align: center; vertical-align: middle;" scope="col">Siswa</th>
                    <th style="text-align: center; vertical-align: middle;" scope="col">Pembimbing 1</th>
                    <th style="text-align: center; vertical-align: middle;" scope="col">Tgl. bimbingan</th>
                    <th style="text-align: center; vertical-align: middle;" scope="col">Topik</th>
                    <th style="text-align: center; vertical-align: middle;" scope="col">Penerimaan</th>

                  </tr>
                </thead>
                <tbody>
                <?php
$no = 1;
foreach ($sa as $key) {
    // Only display rows where Jurusan is "RPL"
    if ($key->Jurusan === session()->get('Jurusan')) {
        ?>
        <tr>
            <td align="center" scope="col"><?= $no++ ?></td>
            <td align="center" scope="col"><?= $key->NamaS ?></td> <!-- Siswa name -->
            <td align="center" scope="col"><?= $key->namaG ?></td>  <!-- Pembimbing 1 name -->
            <td align="center" scope="col"><?= $key->tanggal ?></td> <!-- Tanggal -->
            <td align="center" scope="col"><?= $key->topik ?></td>   <!-- Topik -->
            <td align="center" scope="col"><?= $key->siap_bimbing1 ?></td> <!-- Penerimaan -->
        </tr>
        <?php
    }
}
?>



                </tbody>
              </table>

              <!-- Add a hidden session input for 'nama' -->
              <input type="hidden" id="nama" name="nama" value="<?= session()->get('NamaA') ?>">


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

  // Access the hidden session input value in JavaScript (if needed)
  const sessionNama = document.getElementById('session-nama').value;
  console.log('Session Nama:', sessionNama); // For debugging
</script>
