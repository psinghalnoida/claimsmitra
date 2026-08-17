<style>
  /* Modal Content */
  .media-modal-content {
    display: flex;
    flex-direction: column;
    height: 100%;
    background-color: transparent;
  }


  .modal-body {
    flex: 1;
    overflow-y: auto;
    /* Allows scrolling if content overflows */
  }

  /* Right Sidebar Modal Styles */
  #rightDrawerModal {
    position: fixed;
    right: 0;
    top: 0;
    height: 100%;
    margin: 0;
    width: 40%;
    transition: transform 0.3s ease-in-out;
  }

  .modal.right.show #modal-dialog {
    transform: translateX(0) translateY(0%);
  }

  .btnclass {
    background: #e16123;
  }

  .btnclass:hover {
    background: #e16123;
    color: white;
    border: none;
  }

  .vertical-button {
    position: fixed;
    top: 40%;
    right: 0;
    margin-right: -46px;
    transform: translateY(-50%) rotate(-90deg);
    z-index: 1050;
    white-space: nowrap;
    padding: 0.5rem 1rem;
  }

  .rightnav ul li ul li a:hover {
    background: #dfb5b0;
  }

  .modal_header_custom {
    max-width: 100%;
    width: auto;
  }

  .modal.right #modal-dialog {
    position: fixed;
    right: 0;
    top: 0;
    left: 40%;
    height: 100%;
    margin: 0;
    transform: translateX(100%);
    transition: transform 0.3s;
  }

  .right-side {
    width: 100%;
  }

  /* FOR DESKTOP */

  @media (min-width: 1200px) {
    #rightDrawerModal {
      width: 40%;
      left: 87%;
    }

    .vertical-button {
      right: 0;
      transform: translateY(-50%) rotate(-90deg);
    }

    .modal.right #modal-dialog {
      left: 82%;
    }

    /* .rightsidebar {
        left: 40%;
    } */
  }

  /* FOR LAPTOP MEDIA */
  @media (max-width: 1199px) {
    #rightDrawerModal {
      width: 60%;
    }

    .vertical-button {
      top: 20%;
    }

    .modal.right #modal-dialog {
      left: 80%;
    }
  }

  /* FOR LAPTOP MEDIA */
  @media (max-width: 991px) {
    #rightDrawerModal {
      width: 80%;
    }

    .vertical-button {
      top: 10%;
    }
  }

  /* FOR MOBILE MEDIA */
  @media (max-width: 575px) {
    #rightDrawerModal {
      width: 100%;
    }

    .vertical-button {
      top: 5%;
    }
  }
</style>

<a class="btn btnclass vertical-button" id="openDrawerButton" style="color:white;">
  Action Perform
</a>

<div class="modal right fade" id="rightDrawerModal" tabindex="-1" role="dialog" aria-labelledby="rightDrawerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" id="modal-dialog">
    <div class="modal-content media-modal-content">
      <div class="modal-header modal_header_custom" style="background-color:#0c0b0b;">
        <h5 class="modal-title" id="rightDrawerModalLabel" style="color: white;">Actions</h5>
        <i class="fa fa-times close-icon" id="customCloseIcon" title="Close" style="font-size: 25px; color: white; cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
      </div>
      <div class="modal-body">
        <aside class="sidebar rightsidebar right-side" style="top:50px; background-color:#ffe4e1;" data-trigger="scrollbar">
          <div class="sidebar--nav rightnav">
            <ul>
              <li>
                <ul>
                  <li><a style="color:black" href="<?php echo base_url('viewcasedetail?q=' . base64_encode($this->encryption->encrypt($aid)) . ''); ?>">View Case</a></li>
                  <li><a style="color:black" href="" data-toggle="modal" data-target="#share_case">Share Case</a></li>
                  <li><a style="color:black" href="<?php echo base_url('casepreparelor?q=' . base64_encode($this->encryption->encrypt($aid)) . ''); ?>">Prepare LOR</a></li>
                  <li><a style="color:black" href="<?php echo base_url('casesurveyfee?q=' . base64_encode($this->encryption->encrypt($aid)) . ''); ?>">Survey Fee</a></li>
                  <li><a style="color:black" href="<?php echo base_url('casedispatch?q=' . base64_encode($this->encryption->encrypt($aid)) . ''); ?>">Dispatch</a></li>
                  <li><a style="color:black" href="<?php echo base_url('casebilling?q=' . base64_encode($this->encryption->encrypt($aid)) . ''); ?>">Billing</a></li>
                  <li><a style="color:black" href="<?php echo base_url('caseila?q=' . base64_encode($this->encryption->encrypt($aid)) . ''); ?>">ILA</a></li>                 
                </ul>
              </li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </div>
</div>

<div id="share_case" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Share Case <span style="color:green"><?php echo $aid; ?></span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" id="sharecase">
                    <div class="form-group">
                        <label>
                            <span class="label-text">Mobile Number</span>
                            <input type="text" id="mobile_no" name="mobile_no" placeholder="Enter Mobile Number..." class="form-control">
                        </label>
                    </div>
                    <div style="text-align: right;">
                        <button type="submit" class="btn btn-success">Share</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function() {
    $('#openDrawerButton').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#rightDrawerModal').modal('show');
        $(this).hide();
    });

    $('#rightDrawerModal').on('hidden.bs.modal', function() {
        $('#openDrawerButton').show();
    });

    // Close the modal when clicking on the custom close icon
    $('#customCloseIcon').click(function() {
        $('#rightDrawerModal').modal('hide');
    });

    // Close the modal when clicking outside the sidebar
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.modal-content').length && !$(event.target).is('#rightDrawerModal')) {
            $('#rightDrawerModal').modal('hide');
        }
    });

    // Prevent modal from closing when clicking inside the sidebar
    $('.sidebar').on('click', function(event) {
        event.stopPropagation();
    });
  });

</script>