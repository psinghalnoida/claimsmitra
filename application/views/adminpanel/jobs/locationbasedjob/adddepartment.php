<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<main class="main--container" style="min-height:100vh; padding-top:103px;">
    <div class="tab-content" style="padding:0px; margin-left:15px; margin-right:15px;">
        <div class="tab-pane fade show active" id="tab10">
            <div class="row gutter-20">
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading mt-3">
                            <h1 class="panel-title" style="margin: 0;">Users</h1>
                            <div class="dropdown show">
                                <select id="department-selection" class="form-control" style="flex: 1;">
                                    <?php if (!empty($departments)) : ?>
                                        <?php foreach ($departments as $department) : ?>
                                            <option value="<?= $department['id'] ?>"><?= $department['department'] ?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option disabled>No departments found.</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="panel-content">
                            <div class="row" id="user-cards-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $this->load->view('adminpanel/jobs/locationbasedjob/progressbar'); ?>
<?php $this->load->view('adminpanel/layout/footer'); ?>

<script>
    $(document).ready(function() {
        function fetchUsers(departmentId) {
            if (departmentId) {
                $.ajax({
                    url: "<?php echo base_url('userdepartment'); ?>",
                    type: 'POST',
                    data: {
                        departmentid: departmentId
                    },
                    dataType: 'json',
                    success: function(response) {
                        var container = $('#user-cards-container');
                        container.empty(); // Clear existing cards

                        if (response.status === 200 && response.data.length > 0) {
                            response.data.forEach(function(user) {
                                var userCard = `<div class="col-lg-3 col-md-6"> 
                                        <div class="pricing--item text-center mb-4"> 
                                            <div class="pricing--header text-uppercase"> 
                                            <img src="https://claimsmitra.com/assets/profile/user.png" style="max-width:33%;" alt="User Profile" class="rounded-circle profile-img mb-3">
                                                <h5 class="h5">${user.firstname} ${user.lastname}</h5> 
                                            </div>
                                            <div class="pricing--features"> 
                                                <ul class="list-unstyled"> 
                                                    <li>
                                                        <strong>Company Name</strong> ${user.companyName || 'INDIVIDUAL'}
                                                    </li>
                                                    <li>
                                                        <strong>Mobile</strong> ${user.mobile || 'N/A'}
                                                    </li>
                                                    <li>
                                                        <strong>Email</strong> ${user.email || 'N/A'}
                                                    </li>
                                                    <li>
                                                        <strong>Department</strong> ${user.department || 'N/A'}
                                                    </li>
                                                </ul> 
                                            </div>
                                            <div class="pricing--action"> 
                                                <a href="#" class="btn_danger btn-rounded btn-danger">Remove</a>
                                            </div>
                                        </div>
                                    </div>`;
                                container.append(userCard);
                            });
                        } else {
                            container.html('<p class="text-center">No users found for the selected department.</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching users:', error);
                        $('#user-cards-container').html('<p class="text-center text-danger">An error occurred while fetching users.</p>');
                    }
                });
            }
        }

        // Fetch users on page load
        var initialDepartmentId = $('#department-selection').val();
        fetchUsers(initialDepartmentId);

        // Fetch users on department selection change
        $('#department-selection').on('change', function() {
            var departmentId = $(this).val();
            fetchUsers(departmentId);
        });
    });
</script>