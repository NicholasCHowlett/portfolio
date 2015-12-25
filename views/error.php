        <!-- error messages -->
        <section class="error" id="<?= $id; ?>">
          <?php foreach ($errors as $error): ?>
          <div class="alert alert-warning">
            <p><?= $error; ?></p>
          </div>
          <?php endforeach; ?>
        </section>
