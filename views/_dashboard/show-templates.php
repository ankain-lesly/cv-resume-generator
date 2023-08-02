<main>
  <!-- Page View Start -->
  <div class="dashboard">
    <div class="mini-head">
      <h3>Templates and Designs</h3>
    </div>
    <br>
    <div class="feeds-nav flex between" id="resumes">
      <h4>Most Recent</h4>
      <a class="bbtn secondary" href="/new/template">Add template <i class="pl-1 fas fa-plus"></i></a>
    </div>
    <div class="design-container">
      <!-- FEEDs -->
      <div class="main">
        <?php if ($templates) : foreach ($templates as $data) { ?>
        <div class="item">
          <img src="/resumes/thumbnails/<?= $data['thumbnail'] ?>" class="img-cover" alt="Design">
          <button class="btn"><i class="fas fa-plus"></i></button>
          <div class="options py-1 px-x">
            <a href="#" class="flex between between p-x option mb-1">
              .
              <i class="fas fa-times clr-warning"></i>
            </a>
            <a href="/new/template?reff=resume&edit=<?= $data['template_id'] ?>"
              class="flex between between p-x option mb-1">
              <span class="text font-bold">Edit</span>
              <i class="fas fa-arrow-right"></i>
            </a>
            <a href="" class="btn_preview flex between between p-x option mb-1">
              <span class="text font-bold">Preview</span>
              <i class="fas fa-image"></i>
            </a>
            <a href="<?= $user->isMaster() ? ($data['status'] == 0 ? "?reff=" . $data['status'] . "&use=" . $data['template_id'] : "?reff=" . $data['status'] . "&unuse=" . $data['template_id']) : "" ?>"
              class="flex between between p-x option mb-1 <?= $data['status'] == 1 ? 'active' : 'status' ?>">
              <span class="text font-bold"><?= $data['status'] == 1 ? 'Active' : 'Disabled' ?></span>
              <i class="fas fa-<?= $data['status'] == 1 ? 'check' : 'undo' ?>"></i>
            </a>
            <a href="#" class="flex between between p-x option mb-1">
              <span class="text font-bold">Delete </span>
              <i class="fas fa-trash"></i>
            </a>
            <a href="#" class="flex between between p-x option mb-1">
              <span class="text font-bold">Option 3</span>
              <i class="fas fa-dot-circle"></i>
            </a>
            <a href="#" class="flex between between p-x option mb-1">
              <span class="text font-bold">Option 4</span>
              <i class="fas fa-dot-circle"></i>
            </a>
          </div>
        </div>
        <?php }
        else : ?>
        <div class="item">
          <div class="default p-1 flex txt-center">
            <div class="group">
              <h2>Ooops</h2><br>
              <b>You have not created any templates yet!</b><br><br>
              <a href="/new/template" class="bbtn secondary small">Create now</a>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
    <p class="txt-center pt-4">Read more about how this works: <a href="/about#templates">Read more</a></p>
  </div>

</main>