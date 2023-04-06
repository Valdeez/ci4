<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
          <h2 class="mt-3">Daftar Komik</h2>
          <table class="table mt-2">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Cover</th>
                <th scope="col">Title</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($comics as $k) : ?>
                <tr>
                  <th scope="row"><?= $i++; ?></th>
                  <td><img src="/img/<?= $k['sampul']; ?>" alt="" class="sampul"></td>
                  <td><?= $k['judul']; ?></td>
                  <td>
                    <a href="/komik/<?= $k['slug']; ?>" class="btn btn-success">Detail</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
          <a href="/komik/create" class="btn btn-primary my-1">Tambah Komik</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>