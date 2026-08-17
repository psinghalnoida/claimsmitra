<style>
    .case-list {
        width: 100%;
        overflow-x: hidden;
        box-sizing: border-box;
        padding-left: 15px;
        padding-right: 15px;
    }
</style>


<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Tab Content Start -->
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab11">
            <section class="main--content" style="padding-top: 0px; min-height: 100vh;">
                <div class="container-fluid">
                    <div class="row gutter-20">
                        <div class="col-md-12">
                            <div class="panel" style="margin-top:15px;">

                                <div class="panel">
                                    <!-- App Start -->
                                    <?php
                                    // Filter only those templates with non-empty template_name
                                    $validTemplates = array_filter($templatedata ?? [], function ($template) {
                                        return !empty($template['template_name']);
                                    });
                                    ?>

                                    <div class="app_wrapper row">

                                        <?php if (!empty($validTemplates)) : ?>
                                            <!-- Template Sidebar -->
                                            <div class="app_sidebar col-lg-4 col-md-6">
                                                <!-- Toolbar Start -->
                                                <div class="toolbar">
                                                    <a class="btn btn-block btn-rounded btn-danger fw--600" style="color:white;">TEMPLATES</a>
                                                </div>
                                                <!-- Toolbar End -->

                                                <!-- Mailbox Navigation Start -->
                                                <ul class="navigation navigation-highlighted">
                                                    <li class="title">Templates</li>

                                                    <?php foreach ($validTemplates as $template) : ?>
                                                        <?php
                                                        $templateId = $template['id'] ?? 0;
                                                        $templateName = htmlspecialchars($template['template_name']);
                                                        ?>
                                                        <li class="my-2" style="background-color: #f6f1f1;">
                                                            <a href="javascript:void(0);" onclick="loadTemplateDetails(<?= $templateId ?>)">
                                                                <i class="far fa-file-alt"></i>
                                                                <span><?= $templateName ?></span>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <!-- Mailbox Navigation End -->
                                            </div>

                                            <!-- Department Content Area -->
                                            <div class="app_sidebar col-lg-8 col-md-6" id="departmentsContainer">
                                                <!-- Dynamic department blocks will be added here -->
                                            </div>

                                        <?php else : ?>
                                            <!-- Full Width if No Templates -->
                                            <div class="app_sidebar col-lg-12 col-md-6" id="departmentsContainer">
                                                <!-- Dynamic department blocks will be added here -->
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php $this->load->view('adminpanel/layout/footer'); ?>

    <script>
        function redirectToControllerWithId(pageurl, id, company, department, usertype) {
            $.ajax({
                url: '<?= base_url("encryptdataid") ?>',
                type: 'POST',
                data: {
                    id: id,
                    defaultcompany: company,
                    defaultdepartment: department,
                    usertype: usertype
                },
                dataType: 'json',
                success: function(response) {
                    if (response.data) {
                        let url = `${pageurl}?data=${encodeURIComponent(response.data)}`;
                        window.location.href = url;
                    } else {
                        console.error("Error: No encrypted data received.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }


        function getTypeofCase(departmentId, container) {
            const imageURL = "<?php echo base_url('assets/template (1).png'); ?>";
            const baseUrl = "<?php echo base_url(); ?>";
            const companyid = "<?php echo $defaultcompany; ?>";
            const departmentid = "<?php echo $defaultdepartment; ?>";
            const user_role = "<?php echo $usertype; ?>";

            console.log(companyid, departmentid, user_role);

            $.ajax({
                url: baseUrl + "getassignment",
                type: "POST",
                data: {
                    departmentid: departmentId
                },
                dataType: "json",
                success: function(response) {
                    let html = '';

                    if (response.data.length > 0) {
                        response.data.forEach((c, index) => {
                            // Open a new row every 4 cards
                            if (index % 4 === 0) {
                                html += '<div class="row" style="margin-bottom: 15px;">';
                            }

                            html += `
                        <div class="col-md-3 col-sm-6" style="padding: 5px;">
                            <a href="javascript:void(0);"
                                onclick="redirectToControllerWithId('${baseUrl}createtemplatedetail', '${c.id}', '${companyid}', '${departmentid}', '${user_role}')"
                                style="
                                    display: block;
                                    font-size: 13px;
                                    color: black;
                                    background: #fbf4ee;
                                    height: 6.6em;
                                    text-align: center;
                                    padding-top: 9px;
                                    padding-bottom: 5px;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                <img src="${imageURL}" alt="icon"
                                    style="width: 16px; height: 16px; vertical-align: middle; margin-bottom: 6px;" /><br>
                                ${c.investigator_type}
                            </a>
                        </div>`;

                            // Close the row after every 4 cards
                            if ((index + 1) % 4 === 0 || index === response.data.length - 1) {
                                html += '</div>';
                            }
                        });
                    } else {
                        html += '<p style="color: #666; margin: 10px 0;">No cases found for this department.</p>';
                    }

                    container.find('.case-list').html(html);
                },

                error: function() {
                    container.find('.case-list').html('<p style="color: red; margin: 10px 0;">Error loading cases</p>');
                }
            });
        }

        function fetchDepartments() {
            var selectedCompany = "<?php echo $defaultcompany; ?>";

            $.ajax({
                url: '<?php echo base_url('departmentnames'); ?>',
                type: 'POST',
                data: {
                    corporateId: selectedCompany
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === 200) {
                        const departments = response.data;
                        const container = $('#departmentsContainer');
                        container.empty();

                        departments.forEach(dept => {
                            const departmentBlock = $(`
                            <div style="  border-radius: 8px;">
                                <h5 style="
                                    background-color: #acdee2;
                                    color: black;
                                    padding: 8px 12px;
                                    margin-bottom: 15px;
                                    font-size: 16px;
                                    
                                ">${dept.department}</h5>
                                <div class="case-list">Loading...</div>
                            </div>
                        `);


                            container.append(departmentBlock);
                            getTypeofCase(dept.id, departmentBlock);
                        });
                    }
                }
            });
        }

        $(document).ready(function() {

            fetchDepartments();
        });
    </script>