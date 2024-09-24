<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content here -->
</head>
<body>
    <main id="main" class="main">
        <div class="container">
            <form action="<?= base_url('home/aksi_t_Bimbingan1')?>" method="post">
                <div class="pagetitle">
                    <h1>Bimbingan</h1>
                     <div class="row">
                  
                </div><!-- End Page Title -->

                <section class="section">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Bimbingan</h5>

                                    <!-- General Form Elements -->

                                    
                                    <div class="mb-3 mt-3">
    <label for="jenis1" class="form-label">Pembimbing</label>
    <select name="jenis1[]" class="form-control">
        <option value="">Pilih</option>
        <?php foreach($s2 as $key): ?>
            <?php if ($key->jurusanG === "RPL"): ?> <!-- Only show if Jurusan is "RPL" -->
                <option value="<?=$key->id_guru?>"><?=$key->namaG?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
</div>
                                    <div class="mb-3 mt-3">
                                    <label for="Deskripsi" class="form-label">Topik</label>
                                    <input class="form-control" id="Deskripsi" name="topic"></input>
                                </div>
                                   
                                    <div class="row mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </main>
</body>
</html>
