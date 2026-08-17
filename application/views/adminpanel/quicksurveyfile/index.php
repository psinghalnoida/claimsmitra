<?php $this->load->view('adminpanel/layout/sidebar');?>
<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 15px;
    }

    #card-view-container .card {
        margin-bottom: 15px;
    }
</style>
<main class="main--container">
    <div class="tab-content" style="padding:0px;">
        <div class="tab-pane fade show active" id="tab10">
            <section class="main--content">
                <div class="container-fluid">   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-content panel-activity">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row" id="card-view-container" style="display: none;"></div>
                                            <table id="quicksurvey" class="table table-bordered table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Company name</th>
                                                        <th>Name of Beneficiary</th>
                                                        <th>Item Number</th>
                                                        <th>Media files</th>
                                                        <th>AID</th>  
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('adminpanel/layout/footer');?>    

<script type="text/javascript">

    window.onload = function() {
    var isMobile = /Mobi|Android/i.test(navigator.userAgent);
    var button = document.querySelector('.create-case-btn');
    
    if (isMobile) {
        button.style.display = 'inline-block';
    } else {
        button.style.display = 'none';
    }
};


    $(document).on('click', '.movemediafiles', function () {
        const aid = $(this).closest('.input-group').find('.aidnumber').val();
        const itemnumber = $(this).closest('.input-group').find('.itemnumber').val();
        const directoryname = $(this).closest('.input-group').find('.directoryname').val();

          console.log('AID:', aid);
             console.log('Item Number:', itemnumber);
             console.log('Directory Name:', directoryname);
         
        if (aid.trim() === '') {
            alert('Please enter a valid AID!');
            return;
        }

        $.ajax({
            url: "<?php echo base_url('movemediafiles'); ?>",
            type: 'POST',
            data: { aid, itemnumber, directoryname },
            success: function (response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message);
                    location.reload(); // Reload page to reflect changes
                } else {
                    alert(res.message);
                }
            },
            error: function () {
                alert('An error occurred while moving files.');
            }
        });
    });

/* ------------------------------------------------------------------------- *
* GET QUICK SURVEY CASE LIST
* ------------------------------------------------------------------------- */
// var $ourgointcases = $('#quicksurvey');

// if ($ourgointcases.length) {
//     $ourgointcases.DataTable({
//         "serverSide": true,
//         "paging": true,
//         "fixedHeader": true,
//         "lengthChange": true,
//         "searching": true,
//         "responsive": true,
//         "scrollX": true,
//         "ordering": true,
//         "info": true,
//         "autoWidth": true,
//         "language": {
//             searchPlaceholder: "Search Quick Survey",
//             "lengthMenu": "View _MENU_ records"
//         },
//         "order": [],
//         // Load data from an Ajax source
//         "ajax": {
//             url: "<?php echo base_url('quicksurveylist'); ?>",
//             type: "POST",
//             dataType: "json",
//             error: function(xhr, error, code) {
//                 console.log("DataTables Error:", error);
//             }
//         }
//     });
// }


    var $ourgointcases = $('#quicksurvey');
var $cardContainer = $('#card-view-container');

if ($ourgointcases.length) {
    var dataTable = $ourgointcases.DataTable({
        "serverSide": true,
        "paging": true,
        "fixedHeader": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "language": {
            searchPlaceholder: "Search Quick Survey",
            "lengthMenu": "View _MENU_ records"
        },
        "order": [],
        "ajax": {
            url: "<?php echo base_url('quicksurveylist'); ?>",
            type: "POST",
            dataType: "json",
            error: function(xhr, error, code) {
                console.log("DataTables Error:", error);
            }
        },
        "rowCallback": function(row, data) {
            // Generate a card for each row on mobile view
            var card = `
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Company Name: ${data[0]}</h5>
                            <p class="card-text">
                                <strong>Beneficiary:</strong> ${data[1]}<br>
                                <strong>Item Number:</strong> ${data[2]}<br>
                                <strong>Media Files:</strong> ${data[3]}<br>
                                <strong>AID:</strong> ${data[4]}
                            </p>
                        </div>
                    </div>
                </div>`;
            $cardContainer.append(card);
        },
        "initComplete": function() {
            toggleView();
        }
    });

    // Switch between table and card view based on screen size
    function toggleView() {
        if ($(window).width() < 768) { // Mobile view
            $ourgointcases.hide();
            $cardContainer.show();
        } else { // Desktop view
            $cardContainer.hide();
            $ourgointcases.show();
        }
    }

    // Trigger toggleView on window resize
    $(window).on('resize', function() {
        toggleView();
    });

    // Initial call
    toggleView();
}






</script>