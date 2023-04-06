<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Detail Komik</h2>
            <div class="card mb-3 mt-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="/img/<?= $comics['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><b><?= $comics['judul']; ?></b></h5>
                        <p class="card-text"><b>Penulis: </b><?= $comics['penulis']; ?><br>
                        <b>Penerbit: </b><?= $comics['penerbit']; ?></p>
                        <p class="card-text">Komik <?= $comics['judul']; ?> Volume Terbaru</p>

                        <a href="/komik/edit/<?= $comics['slug']; ?>" class="btn btn-warning">Edit</a>

                        <form action="/komik/<?= $comics['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>    
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Hapus</button>
                        </form>

                        <br><br>
                        <a href="/komik">Kembali ke Daftar Komik</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>