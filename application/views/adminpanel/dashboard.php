<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<style>
  .fc-event {
    font-size: 11px;
    padding: 2px 4px;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    
}
.fc-day-grid-event {
    max-height: 20px;
    overflow: hidden;
    border:2px solid black;
    text-align:center;
    margin:49px 0px 0px 32px;
}

</style>
<main class="main--container" style="margin-top:15px;">
<section class="content">
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-3 mb-3">
        <div class="card p-4 h-100">
          <div class="row align-items-center">
            <!-- <div class="col-3">
              <div class="icon-circle"><i class="fas fa-users"></i></div>
            </div> -->
            <div class="col-9">
              <h4 class="mb-0">10000</h4>
              <p class="text-muted">AID</p>
            </div>
          </div>
          <hr class="my-4">
          <div class="row align-items-center">
            <!-- <div class="col-3">
              <div class="icon-circle"><i class="fas fa-sync-alt"></i></div>
            </div> -->
            <div class="col-9">
              <h4 class="mb-0">Rajendra Singh</h4>
              <p class="text-muted">Contact Person Name</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-3">
        <div class="card p-4 h-100">
          <div class="row align-items-center">
            <!-- <div class="col-3">
              <div class="icon-circle"><i class="fas fa-globe"></i></div>
            </div> -->
            <div class="col-9">
              <h4 class="mb-0">1252</h4>
              <p class="text-muted">Name of Beneficiary</p>
            </div>
          </div>
          <hr class="my-4">
          <div class="row align-items-center">
            <!-- <div class="col-3">
              <div class="icon-circle"><i class="fas fa-download"></i></div>
            </div> -->
            <div class="col-9">
              <h4 class="mb-0">3550</h4>
              <p class="text-muted">Policy Number</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-3">
        <div class="card p-4 h-100">
          <div class="row align-items-center">
            <!-- <div class="col-3">
              <div class="icon-circle"><i class="fas fa-arrow-up"></i></div>
            </div> -->
            <div class="col-9">
              <h4 class="mb-0">600</h4>
              <p class="text-muted">Vehicle Number</p>
            </div>
          </div>
          <hr class="my-4">
          <div class="row align-items-center">
            <!-- <div class="col-3">
              <div class="icon-circle"><i class="fas fa-shopping-cart"></i></div>
            </div> -->
            <div class="col-9">
              <h4 class="mb-0">100%</h4>
              <p class="text-muted">Contact Person Mobile</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-3">
        <div class="card p-4 h-100">
          <div class="row align-items-center">
            <!-- <div class="col-3">
              <div class="icon-circle"><i class="fas fa-arrow-up"></i></div>
            </div> -->
            <div class="col-9">
              <h2 class="mb-0">600</h2>
              <p class="text-muted">GROWTH</p>
            </div>
          </div>
          <hr class="my-4">
          <div class="row align-items-center">
            <!-- <div class="col-3">
              <div class="icon-circle"><i class="fas fa-shopping-cart"></i></div>
            </div> -->
            <div class="col-9">
              <h4 class="mb-0">100%</h4>
              <p class="text-muted">Status</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>





  <div class="row" style="margin-left: 15px; margin-right:15px">
    <div class="col-md-3" style="background-color:white; padding-right:0px;">
      <!-- <a href="javascript:void(0);" onclick="redirectToController('createnewcase', <?php echo $defaultcompany; ?>, <?php echo $defaultdepartment; ?>, <?php echo $usertype; ?>)"> -->
        <div class="panel" style="border-radius: 0px; margin-bottom:15px; margin-top:15px; background-color:#2bb3c0;">
            <div class="miniStats--panel" >
              <div class="row"> 
                <div class="col-md-3 totalcases" style="padding-top:20px;padding-bottom:20px;padding-left:30px;height:100px;">
                  <span style="background-color:#2bb3c0;font-size:50px;margin-top:5px">
                  <i class="fas fa-plus"></i>
                  </span>  
                </div>
                <div class="col-md-9" style="padding-top:15px;">
                <span class="text" style="color:white;">
                  <h3 class="miniStats--title h4 text-white" style="margin-left:5px;">New Assignment</h3>
                  <p class="miniStats--num text-white" style="margin-top:0px;">13,450</p>
                </span> 
                </div>
              </div>
            </div>
        </div>
      </a>
    </div>
    <div class="col-md-3" style="background-color:white; padding-right:0px;">
      <!-- <a href="javascript:void(0);" onclick="redirectToController('createnewcase', <?php echo $defaultcompany; ?>, <?php echo $defaultdepartment; ?>, <?php echo $usertype; ?>)"> -->
        <div class="panel" style="border-radius: 0px; margin-bottom:15px; margin-top:15px; background-color:#252525;height:100px;">
          <div class="miniStats--panel">
              <div class="row"> 
                <div class="col-md-3 totalcases" style="padding-top:20px;padding-bottom:20px;padding-left:30px;height:100px;">
                  <span style="font-size:50px;margin-top:5px">
                  <i class="fas fa-angle-double-right"></i>
                  </span>  
                </div>
                <div class="col-md-9" style="padding-top:15px;">
                <span class="text" style="color:white;">
                  <h3 class="miniStats--title h4 text-white" style="margin-left:5px;">Running Cases</h3>
                  <p class="miniStats--num text-white" style="margin-top:0px;">13,450</p>
                </span> 
                </div>
              </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-3" style="background-color:white; padding-right:0px;">
      <!-- <a href="javascript:void(0);" onclick="redirectToController('createnewcase', <?php echo $defaultcompany; ?>, <?php echo $defaultdepartment; ?>, <?php echo $usertype; ?>)"> -->
        <div class="panel" style="border-radius: 0px; margin-bottom:15px; margin-top:15px; background-color:#e16123;height:100px;">
            <div class="miniStats--panel">
              <div class="row"> 
                <div class="col-md-3 totalcases" style="padding-top:20px;padding-bottom:20px;padding-left:30px;height:100px;">
                  <span style="font-size:50px;margin-top:5px">
                  <i class="fas fa-check-circle"></i>
                  </span>  
                </div>
                <div class="col-md-9" style="padding-top:15px;">
                  <span class="text" style="color:white;">
                    <h3 class="miniStats--title h4 text-white" style="margin-left:5px;">Completed Cases</h3>
                    <p class="miniStats--num text-white" style="margin-top:0px;">13,450</p>
                  </span> 
                </div>
              </div>
            </div>
        </div>
      </a>
    </div>
    <div class="col-md-3 payment_card" style="background-color:white">
      <!-- <a href="javascript:void(0);" onclick="redirectToController('createnewcase', <?php echo $defaultcompany; ?>, <?php echo $defaultdepartment; ?>, <?php echo $usertype; ?>)"> -->
        <div class="panel" style="border-radius: 0px; margin-bottom:15px; margin-top:15px; background-color:#009378">
            <div class="miniStats--panel">
              <div class="row"> 
                <div class="col-md-3 totalcases" style="padding-top:20px;padding-bottom:20px;padding-left:30px;height:100px;">
                  <span style="font-size:50px;margin-top:5px">
                  <i class="fas fa-rupee-sign"></i>
                  </span>  
                </div>
                <div class="col-md-9" style="padding-top:15px;">
                  <span class="text" style="color:white;">
                    <h3 class="miniStats--title h4 text-white" style="margin-left:5px;">Payments</h3>
                    <p class="miniStats--num text-white" style="margin-top:0px;">13,450</p>
                  </span> 
                </div>
              </div>
            </div>
        </div>
      </a>
    </div>
   <!--  <div class="col-xl-9 col-md-6">
      <div class="panel" style="border-radius: 0px; margin-bottom:15px">
        <div class="panel-heading">
          <h3 class="panel-title">
            Cases
          </h3>
        </div>
        <div class="panel-body" style="height:28rem">
          <div class="table-responsive">
            <table class="table style--2">
              <thead>
                <tr>
                  <th>AID / Case Reference</th>
                  <th>Nature of Job</th>
                  <th>TAT</th>
                  <th>Handler</th>
                  <th>Inspector</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                 
                  <tr>
                    <td>21012505443974 / VP/M/25/01/001</td>
                    <td><a href="#" class="btn-link">Marine Final Survey</a></td>
                    <td>5 Days</td>
                    <td>Deepak Pal</td>
                    <td><span class="text-muted">Harvinder Singh</span></td>
                    <td><span class="label label-info">Photo Attached</span></td>
                  </tr>
                
                  <tr>
                    <td>21012505443974 / VP/M/25/01/001</td>
                    <td><a href="#" class="btn-link">Marine Final Survey</a></td>
                    <td>5 Days</td>
                    <td>Deepak Pal</td>
                    <td><span class="text-muted">Harvinder Singh</span></td>
                    <td><span class="label label-info">Photo Attached</span></td>
                  </tr>
                 
                  <tr>
                    <td>21012505443974 / VP/M/25/01/001</td>
                    <td><a href="#" class="btn-link">Marine Final Survey</a></td>
                    <td>5 Days</td>
                    <td>Deepak Pal</td>
                    <td><span class="text-muted">Harvinder Singh</span></td>
                    <td><span class="label label-info">Photo Attached</span></td>
                  </tr>
                  
                  <tr>
                    <td>21012505443974 / VP/M/25/01/001</td>
                    <td><a href="#" class="btn-link">Marine Final Survey</a></td>
                    <td>5 Days</td>
                    <td>Deepak Pal</td>
                    <td><span class="text-muted">Harvinder Singh</span></td>
                    <td><span class="label label-info">Photo Attached</span></td>
                  </tr>
                  
                  <tr>
                    <td>21012505443974 / VP/M/25/01/001</td>
                    <td><a href="#" class="btn-link">Marine Final Survey</a></td>
                    <td>5 Days</td>
                    <td>Deepak Pal</td>
                    <td><span class="text-muted">Harvinder Singh</span></td>
                    <td><span class="label label-info">Photo Attached</span></td>
                  </tr>
                 
                  <tr>
                    <td>21012505443974 / VP/M/25/01/001</td>
                    <td><a href="#" class="btn-link">Marine Final Survey</a></td>
                    <td>5 Days</td>
                    <td>Deepak Pal</td>
                    <td><span class="text-muted">Harvinder Singh</span></td>
                    <td><span class="label label-info">Photo Attached</span></td>
                  </tr>
                  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> -->
  <!--   <div class="col-xl-3 col-md-6">
      <div class="panel" style="border-radius: 0px; margin-bottom:15px">
        <div class="panel-heading">
            <h3 class="panel-title">Chat</h3>
            <div class="dropdown">
                <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                    <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                </ul>
            </div>
        </div>
        <div class="comments-panel"> 
          <div id="chatting"> 
              <div id="contactslist">
                  <div id="contacts">
                      <?php foreach ($favcontact as $contact): ?>
                      <div class="contact" data-receiver-id="<?php echo $contact['id'] ?>">
                      <?php if(!empty($contact['profilephoto'])){?>
                        <img src="<?php echo base_url(); ?>assets/profile/<?php echo $contact['profilephoto'] ?>" />
                      <?php }else{ ?>
                        <img src="<?php echo base_url('assets/profile/user.png'); ?>" />
                      <?php }?>
                      <p>
                        <strong><?php echo $contact['firstname'] ?>  <?php echo $contact['lastname'] ?></strong>
                        <span><?php echo $contact['email'] ?></span>
                      </p>
                      <div class="status <?php echo $contact['is_active'] ?>"></div>
                    </div>
                  <?php endforeach; ?>
                  </div>  
                </div>  
                <div id="chatview" class="p1">      
                  <div id="chatprofile">
                      <div id="close">
                          <div class="cy"></div>
                          <div class="cx"></div>
                      </div>
                      <p>Miro Badev</p>
                  </div>
                  <ul class="chatbox">
                    <li class="chats incoming">
                      <p>Hi 👋</p>
                    </li>
                  </ul>
                  <div class="chat-input">
                    <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
                    <span id="send-btn" >send</span>
                  </div>
                </div>        
            </div>  
          </div>
      </div>
    </div> -->

    <!-- <?php if($usertype != "1"){ ?>  -->
      <div class="col-xl-6" style="padding-left:0px;">
        <div class="panel" style="margin-top:15px;border-radius:0px; height:520px; overflow:auto;">
          <div class="panel-heading">
              <h3 class="panel-title">Assignment Status</h3>
          </div>
          <div class="panel-content">
            <div class="row d-flex justify-content-between gap-3">
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="weather--panel text-white bg-blue" style="border-radius:0px;">
                    <div class="weather--title">
                      <h5>Under Survey</h5>
                      <h5><?php echo $total_under_survey_cases; ?></h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="weather--panel text-white bg-yellow" style="border-radius:0px;">
                  <div class="weather--title">
                    <h5>Photo, ILA & LOR</h5>
                    <h5>8907</h5>
                  </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="weather--panel text-white bg-darker" style="border-radius:0px;">
                  <div class="weather--title">
                    <h5>Documents</h5>
                    <h5>8907</h5>
                  </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="weather--panel text-white bg-pink" style="border-radius:0px;">
                  <div class="weather--title">
                    <h5>FSR</h5>
                    <h5>8907</h5>
                  </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="weather--panel text-white bg-orange" style="border-radius:0px;">
                  <div class="weather--title">
                    <h5>Billing</h5>
                    <h5><?php echo $total_billing_done; ?></h5>
                  </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="weather--panel text-white bg-green" style="border-radius:0px;">
                  <div class="weather--title">
                    <h5>Dispatch</h5>
                    <h5><?php echo $total_dispatch_cases; ?></h5>
                  </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="weather--panel text-white bg-dark" style="border-radius:0px;">
                  <div class="weather--title">
                    <h5>Fees Pending</h5>
                    <h5>8907</h5>
                  </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="weather--panel text-white bg-secondary" style="border-radius:0px;">
                  <div class="weather--title">
                    <h5>Completed</h5>
                    <h5>8907</h5>
                  </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="weather--panel text-white bg-red" style="border-radius:0px;">
                  <div class="weather--title">
                    <h5>Cancelled</h5>
                    <h5>8907</h5>
                  </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    <!-- <?php } else{ ?> -->
      <div class="col-xl-6" style="padding-left:0px;">
        <div class="panel" style="margin-top:15px;border-radius:0px; height:520px; overflow:auto;">
          <div class="panel-heading">
            <h3 class="panel-title">Case Status</h3>
          </div>
      <!-- dataTable on the dashboard into assignment status by anish mukh-->
          <div class="panel-content" style="padding: 10px;">
            <div id="modal-table-container" class="table-responsive" style="max-height: 400px; overflow-y:auto;">
            <table id="mis_table" class="table table-bordered table-hover" style="width:100%; table-layout: fixed;">
              <thead>
                <tr>
                  <th>References</th>
                  <th>Assignment</th>
                  <th>Inspector / Location</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody style="text-align: center;">
              </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    <!-- <?php } ?> -->
      <div class="col-xl-6" style="padding-left:0px; padding-right:0px;">
        <div class="panel" style="margin-top:15px;border-radius:0px; min-height:519px;">
            <div class="panel-heading">
                <h3 class="panel-title">Task Management</h3>
            </div>

            <div class="panel-content">
                <div class="row">
                    <div class="col-lg-3 d-none d-lg-block">
                        <!-- Calendar Events Start -->
                        <div class="calendar--events">
                            <!-- <h5 class="h5">Draggable Events</h5> -->

                            <form action="#" class="mt-4 pt-1">
                                <!-- <input type="text" class="form-control" placeholder="Event Title..." required> -->

                                <button type="submit" class="btn btn-danger btn-rounded mt-3">Add Event</button>
                            </form>
                            <hr>
                            <div class="fc-events">
                                <div class="fc-event label-green">Party</div>
                                <div class="fc-event label-orange">Lunch</div>
                                <div class="fc-event label-blue">Meeting</div>
                                <div class="fc-event label-red">Event</div>
                            </div>

                            <!-- <label class="form-check">
                                <input type="checkbox" name="is_removeable" value="1" class="form-check-input">
                                <span class="form-check-label">Remove After Drop</span>
                            </label> -->

                          

                            <!-- <h4 class="h4">Create Event</h4>

                            <ul class="calendar--event__colors">
                                <li class="label-green active"></li>
                                <li class="label-orange"></li>
                                <li class="label-blue"></li>
                                <li class="label-red"></li>
                                <li class="label-black"></li>
                                <li class="label-gray"></li>
                            </ul> -->

                            
                        </div>
                        <!-- Calendar Events End -->
                    </div>

                    <div class="col-lg-9">
                        <!-- Calendar Start -->
                        <div id="calendarApp" class="calendar--app"></div>
                        <!-- Calendar End -->
                    </div>
                </div>
            </div>
        </div>
      </div>
    
  </div>
</section>
  <!-- wrapper section end -->
<?php $this->load->view('adminpanel/layout/footer'); ?>
<script>
  // var selectedDate = null;
  //   $(document).ready(function () {
  //     var caseEvents = ;
  //     var $calendarApp = $('#calendarApp');

  //     if ($calendarApp.length) {
  //         if ($calendarApp.data('fullCalendar')) {
  //             $calendarApp.fullCalendar('destroy');
  //         }

  //         $calendarApp.fullCalendar({
  //             header: {
  //                 left: '',
  //                 center: 'prev next title',
  //                 right: 'today basicDay basicWeek month'
  //             },
  //             editable: true,
  //             droppable: true,
  //             timeFormat: 'h(:mm)a',
  //             eventLimit: true,
  //             events: caseEvents,
  //             eventRender: function (event, element) {
  //                 element.attr('title', event.title);
  //             },
  //             dayClick: function (date, jsEvent, view) {
  //                 selectedDate = moment(date).format("YYYY-MM-DD");
  //                 $('#mis_table').DataTable().ajax.reload();
  //             }
  //         });
  //     }

  //     // 🔁 Initialize DataTable
  //     $('#mis_table').DataTable({
  //         processing: true,
  //         serverSide: true,
  //         ajax: {
  //             url: "<?= base_url('dashboard/fetch_cases_by_date_server') ?>",
  //             type: "POST",
  //             dataType: "json",
  //             data: function (d) {
  //                 d.company = companyid;
  //                 d.department = departmentid;
  //                 d.user_role = user_role;
  //                 d.date = selectedDate; // 👈 Send selected date
  //             },
  //             error: function (xhr, error, thrown) {
  //                 console.log(xhr.responseText);
  //             }
  //         },
  //         columns: [
  //             { data: 'aid' },
  //             { data: 'createdAt' },
  //             { data: 'info' },
  //             { data: 'status' }
  //         ]
  //     });
  // });
</script>