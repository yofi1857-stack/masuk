        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <DIV class="row">
            <div class="col-lg">
              <?php if (validation_errors()): ?>
                <div class="alert alert-danger" role="alert">
                  <?= validation_errors();  ?></div>
              <?php endif; ?>
              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Submenu</a>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Menu</th>
                    <th scope="col">URL</th>
                    <th scope="col">ICON</th>
                    <th scope="col">Active</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($submenu as $sm): ?>
                    <tr>
                      <th scope="row"><?= $i ?></th>
                      <td><?= $sm['title'];  ?></td>
                      <td><?= $sm['menu'];  ?></td>
                      <td><?= $sm['url'];  ?></td>
                      <td><?= $sm['icon'];  ?></td>
                      <td><?= $sm['is_active'];  ?></td>
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
        <div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-3" id="newSubMenuModalLabel">Add New Sub Menu</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
              </div>
              <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                  <div class="mb-3">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title">
                  </div>
                  <div class="mb-3">
                    <select name="menu_id" id="menu_id" class="form-control">
                      <option value="">Select Menu</option>
                      <?php foreach ($menu as $m): ?>
                        <option value="<?= $m['ID']; ?>"><?= $m['menu']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <!-- <input type="text" id="menu" name="menu" placeholder="Menu Name"> -->
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu URL">
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu icon">
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                      <label class="form-check-label" for="is_active">
                        active?
                      </label>
                    </div>
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