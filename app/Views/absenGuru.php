<main id="main" class="main">
  <div class="container">
    <div class="pagetitle">
      <h1>Absensi</h1>
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
                  <tr>
                    <th style="text-align: center; vertical-align: middle;" scope="col">No</th>
                    <th style="text-align: center; vertical-align: middle;" scope="col">Tangal</th>
                    <th style="text-align: center; vertical-align: middle;" scope="col">Pembimbing</th>
                    <th style="text-align: center; vertical-align: middle;" scope="col">Kehadiran</th>
                    <th style="text-align: center; vertical-align: middle;" scope="col">Jurusan</th>
                  </tr>
                </thead>
                <tbody>
                <?php
$no = 1;
$currentJurusan = session()->get('Jurusan'); // Get the Jurusan from the session
$currentNama = session()->get('NamaA');   // Get the username from the session

foreach ($axo as $key) {
    // Only display rows where both nama and Jurusan match the user's session values
    if ($key->nama === $currentNama && $key->Jurusan === $currentJurusan) {
        ?>
        <tr>
            <td align="center" scope="col"><?= $no++ ?></td>
            <td align="center" scope="col"><?= $key->tanggal ?></td> <!-- Date -->
            <td align="center" scope="col"><?= $key->nama ?></td>    <!-- Name -->
            <td align="center" scope="col"><?= $key->Kehadiran ?></td> <!-- Attendance -->
            <td align="center" scope="col"><?= $key->Jurusan ?></td>   <!-- Jurusan -->
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
