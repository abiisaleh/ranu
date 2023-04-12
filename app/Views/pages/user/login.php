<?= $this->extend('template/auth') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
  <div class="col-md-4">
    <h2 class="text-center">Login</h2>
    <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?= form_open('/login') ?>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= set_value('email') ?>">
      <?php if (isset($validation) && $validation->hasError('email')): ?>
      <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
      <?php endif; ?>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>" id="password" name="password">
      <?php if (isset($validation) && $validation->hasError('password')): ?>
      <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
      <?php endif; ?>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block">Login</button>
    </div>
    <?= form_close() ?>
  </div>
</div>
<?= $this->endSection() ?>