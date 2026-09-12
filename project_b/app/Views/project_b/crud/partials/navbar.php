<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="https://twitter.com/01k_shashank">INNsight</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo base_url()?>dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url()?>sign_up">Add User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url()?>seeder">Seeder</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#confirmLogoutModal">Logout</a>
        </li>

        <div class="modal fade" id="confirmLogoutModal" tabindex="-1" role="dialog" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmLogoutModalLabel">Confirm Logout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to logout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="<?php echo base_url()?>logout">Yes</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- <li class="nav-item">
          <a onclick="return confirm('Are you sure to logout?')" class="nav-link" href="<?php echo base_url()?>logout">Logout</a>
        </li> -->
      </ul>


      <!-- <span class="navbar-text">
        Navbar text with an inline element
      </span> -->
    </div>
  </div>
</nav>