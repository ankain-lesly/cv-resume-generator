<?php 
  include_once '../connect/Controllers/YearController.php';

  use App\Config\CustomLibrary;
  use App\Controllers\YearController;

  $yearObj = new YearController();
  $years = $yearObj->index();

  if(isset($_GET['delete'])) {
    $key = $_GET['delete'];

    $status = $yearObj->delete($key);

    if($status)
      CustomLibrary::setToast('Year Deleted.. ✔', '/dashboard/view-product.php?view=years');
  }
?>

<div>
  <div class='header flex between mb-2'>
    <h2>My Cars</h2>
    <a href="./create-product.php?form=car-year" class='btn btn-p'>
      + New
    </a>
  </div>

  <div class='header flex between gap-2 mb-2'>
    <small>Table Options <div class="fas fa-angle-double-right"></div></small>
    <!-- <input type='text' placeholder='Search table' />
    <input type='text' placeholder='Table options' /> -->
  </div>

  <div class='container'>
    <div class='table-container custom-table-responsive'>
      <table class='table custom-table'>
        <thead>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Title</th>
            <th scope='col'>Date</th>
            <th scope='col'>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($years) {
            foreach ($years as $data) { ?>
          <tr class='spacer'>
            <td colSpan='100'></td>
          </tr>
          <tr class=''>
            <td><span class="fas fa-caret-right"></span></td>
            <td><?= $data['title'] ?></td>
            <td><?= $data['addedOn'] ?></td>
            <td>
              <div class="actions flex gap-1 start">
                <!-- <a href="/dashboard/create-product.php?form=car-year&edit=<?= $data['id']?>" class="btn padd" title="Click to Edit">
                      <i class="fas fa-edit"></i>
                    </a> -->
                <a href="/dashboard/view-product.php?view=years&delete=<?= $data['id']?>" class="btn padd"
                  title="Click to Delete" onclick="return confirm('Do you want to DELETE this item!!!')">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>

          <?php
            }
          }else {

            echo "<tr class='spacer'>
                  <td colSpan='100'>
                    <p class='error clr-danger txt-center pt-2 pb-2'>No Data Found</p>
                  </td>
                </tr>";
          }

        
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>