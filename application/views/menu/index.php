        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <?= form_error('menu ', '<div class="alert alert-danger" role="alert">', '</div>)'); ?>
          <?= $this->session->flashdata('message');  ?>
          <DIV class="row">
            <div class="col-lg-6">
              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($menu as $m): ?>
                    <tr>
                      <th scope="row"><?= $i ?></th>
                      <td><?= $m['menu'];  ?></td>
                      <td>
                        <a href="" class="badge badge-success">edit</a>
                        <a href="" class="badge badge-danger" onclick="return confirm('Are you sure?');">delete</a>
                        <!-- <?= base_url('menu/edit/') . $m['id']; ?>  -->
                      </td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </DIV>

        </div>
        <!-- End of Main Content -->
        </div>
        <!-- Modal -->
        <div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-3" id="newMenuModalLabel">Add New Menu</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
              </div>
              <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                  <div class="mb-3">
                    <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </form>
            </div>
          </div>
        </div>