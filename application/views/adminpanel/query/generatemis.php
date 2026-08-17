<?php $this->load->view('adminpanel/layout/sidebar'); ?>
<style>
    #attribute  .panel-item {
        background-color: #fff; 
        border: 1px solid #e1e1e1; 
        border-radius: 4px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        padding: 8px;
        transition: box-shadow 0.3s ease;
    }
    #attribute .panel-item:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
</style>

<main class="main--container">
    <div class="row" style="margin-left: 15px; margin-right: 15px; display: flex; gap: 15px; min-height: 100vh;">
        <div class="panel col-md-12" id="panelDiv">
            <div class="panel-heading">
                <h4 class="panel-title">Filter</h4>
            </div>
            <div class="d-flex">
                <div class="panel-content col-md-12" id="formPanel">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label text-md-left">Nature of Job&nbsp;<span style="color:red">*</span></span>
                        <div class="col-md-9">
                            <select id="survey-select" name="natureofjob" class="form-control" required>
                                <option disabled selected>Select</option>
                                <?php foreach ($surveyors as $survey): ?>
                                    <option value="<?php echo htmlspecialchars($survey['id']); ?>">
                                        <?php echo htmlspecialchars($survey['investigator_type']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label text-md-left">Type of Query</span>
                        <div class="col-md-9">
                            <select name="query-select" class="form-control">
                                <option disabled selected>Select</option>
                                <option value="Generate New Query">Generate New Query</option>
                                <option value="Pre-Existing Query">Pre-Existing Query</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row query-section" style="display: none;">
                        <label class="label-text col-md-3 col-form-label text-md-left">Query</label>
                        <div class="col-md-9">
                            <div id="savedqueriescontainer"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label text-md-left">Attribute</span>
                        <div class="col-md-9">
                            <select id="dynamic-select" name="attribute" class="form-control" onchange="checkFields()">
                                <option disabled selected>Select</option>
                                <?php foreach ($fields as $field): ?>
                                    <option value="<?php echo htmlspecialchars($field['key_name']); ?>">
                                        <?php echo htmlspecialchars($field['fields_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label text-md-left">Date</span>
                        <div class="col-md-9">
                            <select id="date_type" name="date_type" class="form-control">
                                <option disabled selected>Select Date</option>
                                <option value="createdAt">Created Date</option>
                                <option value="ti_datetime">TI Date</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label text-md-left">Date Range </span>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" name="start_date" id="startDate" class="form-control editable-field" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="end_date" id="endDate" class="form-control editable-field" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel col-md-6 " id="attribute" style="display: none;cursor:pointer;flex: 1;min-width: 300px;">
            <div class="panel-heading d-flex pl-0 pr-0">
                <h4 class="panel-title col-md-6 pl-0">Pre Filter</h4>
                <div class="panel-title col-md-6 pr-0" style="text-align:end;position: relative;">
                    <div class="button-line" style="display: none; position: relative;">
                        <input type="text" id="inputText" class="" style="position: absolute;font-size:12px; right: 82px; width: 75%;height:35px; outline: none; background: transparent; z-index: 1;" placeholder="Text..." />
                    </div>
                    <button class="btn btn-rounded btn-success save-button">Save As</button>
                </div>
            </div>
            <div class="panel-content" style="text-align: center;">
            </div>
            <div style="text-align:end; margin-top:5px;margin-bottom:5px;">
                <button type="button" class="btn btn-rounded btn-default" onclick=" ">Reset</button>
                <!-- <button type="submit" id="generate_mis"  class="btn btn-rounded btn-success">Run Query</button> -->
                <a href="#querymodal" data-toggle="modal" ><button type="submit" id="generate_mis"  class="btn btn-rounded btn-success">Run Query</button></a>
            </div>
        </div>
    </div>
     
    <!--Run Query Modal Start -->
    <div id="querymodal" class="modal fade" style="margin-left: 17px;">
        <div class="modal-dialog" style="margin:0px;max-width:100%;height:100vh;width: 100vw;position: fixed;top: 0;left: 0; bottom:0; right:0">
            <div class="modal-content">
                <div class="modal-body" style="height: calc(100vh - 0px); overflow-y: auto;">
                    <div class="col-lg-12" style="margin: 0 auto;">
                        <button type="button" class="close" data-dismiss="modal" style="color:red; font-size:30px">&times;</button>
                        <div id="modal-table-container">
                            <table class="table table-bordered table-hover" style="font-size:12px;" id="mis_table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>S No.</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Run Query Modal End -->

    <?php $this->load->view('adminpanel/layout/footer'); ?>
</main>
<script type="text/javascript">
    var defaultCompany = "<?php echo $defaultcompany; ?>";
    var companyName = "<?php echo $companyName; ?>";

    var selectedAttributes = [];
    var $ourcases = $('#searchattributes');
    if ( $ourcases.length ) {
        $ourcases.DataTable({
            // language: {
            //     searchPlaceholder: "Search here",
            //     "lengthMenu": "View _MENU_ records"
            // },
            // "order": [],
            // Load data from an Ajax source
            // "ajax": {
            //     url: "<?php echo base_url(''); ?>",
            //     type: "POST",
            //     dataType:"JSON",
            // },  
        });
    }

    let tagCounter = 1;
    function addItemToPanel(selectedText, selectedValue) {
        if ($('#attribute span:contains("' + selectedText + '")').length === 0) {
            selectedAttributes.push(selectedValue);
            const newItem = `
                <div class="row panel-item">
                    <div class="col-1 delete-btn" style="text-align: left;">
                        <i class="fas fa-trash delete-icon" style="font-size:13px;" data-value="${selectedValue}"></i>
                    </div>
                    <div class="col-2" style="font-size:12px;">
                        <span class="tag-number">${tagCounter}</span>
                    </div>
                    <div class="col-4" style="text-align: left;font-size:12px;">
                        <span id="${selectedValue}">${selectedText}</span>
                    </div>
                    <div class="col-5" style="text-align:right;position: relative;">
                        <div class="filter-line" style="display: none; position: relative;">
                            <input type="text" id="filter-input" class="filter-input" data-key="${selectedValue}" style="position: absolute;font-size:12px; left: -23px; width: 100%;height:25px; outline: none; background: transparent; z-index: 1;" placeholder="Text..." />
                        </div>
                        <img src="assets/img/media/filter.png" alt="Filter Icon" class="filter-icon" style="cursor: pointer;margin-top: 3px;" />
                    </div>
                </div>
            `;
            $('#attribute .panel-content').append(newItem);
            tagCounter++;
        }  
    }

    function addColumnToTable(selectedText) {
        const newTableHeader = `<th>${selectedText}</th>`;
        $('table.table thead tr').append(newTableHeader);
        $('table.table tbody tr').each(function () {
            $(this).append('<td></td>');
        });
    }
   
    function populatePanelFromAttributes(attributes, fieldsNamesMap) {
        const panelContent = $('#attribute .panel-content');
        panelContent.empty();

        const selectOption = $('#dynamic-select :selected');

        const selectValue = selectOption.val();

        if (attributes && Array.isArray(attributes)) {
            selectedAttributes = attributes;
            attributes.sort();
            attributes.forEach((attribute, index) => {
                const fieldName = fieldsNamesMap[attribute] || attribute; 
                const newItem = `
                    <div class="row panel-item">
                        <div class="col-1" style="text-align: left;">
                            <i class="fas fa-trash delete-icon" style="font-size:13px;" data-value="${attribute}" data-select="${selectValue}"></i>
                        </div>
                        <div class="col-2" style="font-size:12px;">
                            <span class="tag-number">${index + 1}</span>
                        </div>
                        <div class="col-4" style="text-align: left;font-size:12px;">
                            <span data-select-value="${selectValue}">${fieldName}</span> 
                        </div>
                        <div class="col-5" style="text-align:right;position: relative;">
                            <div class="filter-line" style="display: none; position: relative;">
                                <input type="text" id="filter-input" class="filter-input" data-key="${selectValue}" style="position: absolute;font-size:12px; left: -23px; width: 100%;height:25px; outline: none; background: transparent; z-index: 1;" placeholder="Text..." />
                            </div>
                            <img src="assets/img/media/filter.png" alt="Filter Icon" class="filter-icon" style="cursor: pointer;margin-top: 3px;" />
                        </div>
                    </div>
                `;
                panelContent.append(newItem);
            });
            
            generateQueryTable(attributes, fieldsNamesMap);
        
            $('.main--content').show();
            $('.save-button')
                .removeClass('btn-success')
                .addClass('btn-default')
                .text('Edit');
        }
        // updateDatabaseAttributes();
    }
    
   


    $(document).on('click', '.delete-icon', function () {
        var panelItem = $(this).closest('.panel-item');
        var index = panelItem.index();
    
        panelItem.remove();
        const attribute = $(this).data('value');
        const selectedQuery = $('#savedqueriescontainer select').val();
        updateTagNumbers();
        $('table.table thead tr th').eq(index + 1).remove();
        $('table.table tbody tr').each(function() {
            $(this).find('td').eq(index).remove();
        });
        
        $.ajax({
            url: 'mis/deleteSavedQuery',
            type: 'POST',
            data: { attribute: attribute, save_as: selectedQuery },
            success: function (response) {
                const result = JSON.parse(response);
                if (result.status === 'success') {
                    $(`[data-attribute="${attribute}"]`).remove();
                } else {
                    // alert(result.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error deleting attribute:', error);
                
            }
        });
    });

    // function updateDatabaseAttributes() {
    //     console.log("selectedAttributes are",selectedAttributes);
    //     $.ajax({
    //         url: "<?php echo base_url('mis/updatequery'); ?>",
    //         type: 'POST',
    //         data: {
    //             attributes: JSON.stringify(selectedAttributes), 
    //         },
    //         success: function(response) {
    //             console.log("Update success:", response);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error updating query:', error);
    //         }
    //     });
    // }
    function updateDatabaseAttributes() {
        $.ajax({
            url: "<?php echo base_url('mis/getExistingAttributes'); ?>", // New API to fetch current attributes
            type: "GET",
            success: function(existingAttributes) {
                if (existingAttributes) {
                    existingAttributes = JSON.parse(existingAttributes) || [];
                } else {
                    existingAttributes = [];
                }

                // Merge existing attributes with new ones
                let updatedAttributes = [...new Set([...existingAttributes, ...selectedAttributes])];

                // Send the updated attributes to the backend
                $.ajax({
                    url: "<?php echo base_url('mis/updatequery'); ?>",
                    type: "POST",
                    data: {
                        attributes: JSON.stringify(updatedAttributes),
                    },
                    success: function(response) {
                        console.log("Update success:", response);

                        // Populate UI with updated attributes
                        populatePanelFromAttributes(updatedAttributes, fieldsNamesMap);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error updating query:", error);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error fetching existing attributes:", error);
            }
        });
    }


    function generateQueryTable(attributes, fieldsNamesMap) {
        const misTable = $('#mis_table');
        misTable.find('thead tr').empty();

        const headerHtml = `<th>S No.</th>${attributes.map(attr => {
            const fieldName = fieldsNamesMap[attr] || attr; 
            return `<th>${fieldName}</th>`;
        }).join('')}`;

        misTable.find('thead tr').html(headerHtml);
        const selectedInvestigatorId = $('#survey-select').val();
        const filters = {};

        updateHeadersforpre(attributes, fieldsNamesMap);

        $('.filter-input').each(function() {
            const filterKey = $(this).data('key');
            const filterValue = $(this).val();
            if (filterValue) {
                filters[filterKey] = filterValue;
            }
        });


        if ($.fn.dataTable.isDataTable('#mis_table')) {
            misTable.DataTable().clear().destroy();
        }

        if (attributes.length > 0) {
            misTable.DataTable({
                "serverSide": true,
                "paging": true,
                "fixedHeader": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": [],
                language: {
                    searchPlaceholder: "Search Outgoing Case",
                    "lengthMenu": "View _MENU_ records"
                },
                "ajax": {
                    url: "<?php echo base_url('generatemis'); ?>",
                    type: "POST",
                    data: function(d) {
                        d.investigatorId = selectedInvestigatorId;
                        d.selectedAttributes = attributes;
                        d.filters = filters;
                    }
                },
                dom: 'Bfrtip',  
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'btn btn-success',
                        filename: function () {
                            const investigatorName = $('#survey-select option:selected').text().trim();
                            const date = new Date().toISOString().slice(0, 10);
                            return `MIS_Report_${investigatorName}_${date}`;
                        },
                        exportOptions: {
                            format: {
                                body: function(data) {
                                    if (!isNaN(data) && data.length > 10) {
                                        return "" + data;
                                    }
                                    return data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        className: 'btn btn-danger',
                        customize: function (doc) {
                            const columnCount = $('#mis_table').find('thead th').length;
                            if (columnCount > 10) {
                                doc.pageOrientation = 'landscape';
                                doc.pageSize = 'A4';
                            } else {
                                doc.pageOrientation = 'portrait';
                                doc.pageSize = 'A4';
                            }
                            doc.content[0].text = 'MIS Report';
                            doc.defaultStyle.fontSize = 8;
                        }
                    }
                ],
            });
        }
    }


    $('#dynamic-select').on('change', function () {
        const selectedOption = $(this).find(':selected');
        const selectedText = selectedOption.text();
        const selectedValue = selectedOption.val();

        addItemToPanel(selectedText, selectedValue);
        addColumnToTable(selectedText);
        $('.main--content').show();
        updateSerialNumbers();
        
    });


    function checkFields() {
        const natureOfJob = $('#survey-select').val();
        const typeOfQuery = $('select[name="query-select"]').val();
        const selectedQuery = $('#savedqueriescontainer select').val();

        if (!natureOfJob || (typeOfQuery !== "Generate New Query" && !selectedQuery)) {
            return;
        }

        const panelDiv = document.getElementById('panelDiv');
        const attributePanel = document.getElementById('attribute');
        panelDiv.classList.remove('col-md-12');
        panelDiv.classList.add('col-md-6');
        attributePanel.style.display = 'block';

        if (selectedQuery) {
            $.ajax({
                url: 'mis/getSavedQueries',
                type: 'POST',
                data: { save_as: selectedQuery 
                },
                success: function (response) {

                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        const fieldsNamesMap = result.data.reduce((map, item) => {
                            map[item.key_name] = item.fields_name;
                            return map;
                        }, {});
                        const attributes = result.data.map(item => item.key_name);
                        populatePanelFromAttributes(attributes, fieldsNamesMap);
                        
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    }
    
    $(document).on('change', 'select[name="query-select"]', function () {
        var selectedOption = $(this).val();
        if (selectedOption === 'Pre-Existing Query') {
            $('.query-section').slideDown();
          
            $.ajax({
                url: 'mis/getSavedQueries',
                type: 'POST',
                success: function (response) {
                    var result = JSON.parse(response);

                    if (result.status === 'success') {
                        var queriesWithAttributes = result.data;

                        const savedqueriescontainer = document.getElementById('savedqueriescontainer');
                        savedqueriescontainer.innerHTML = '';

                        // Create the dropdown
                        const selectElement = document.createElement('select');
                        selectElement.classList.add('form-control');
                        selectElement.setAttribute('id', 'queryDropdown');
                        
                        // Add default "Select a Query" option
                        const defaultOption = document.createElement('option');
                        defaultOption.textContent = 'Select a Query';
                        defaultOption.disabled = true;
                        defaultOption.selected = true;
                        selectElement.appendChild(defaultOption);

                        // Add options dynamically
                        queriesWithAttributes.forEach(function (query) {
                            const queryOption = document.createElement('option');
                            queryOption.value = query.save_as; 
                            queryOption.textContent = query.save_as;
                            selectElement.appendChild(queryOption);
                        });

                        // Append the select element to its container
                        savedqueriescontainer.appendChild(selectElement);
                    } else {
                        // alert(result.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            $('.query-section').slideUp();
        }
    });
    
    
    $(document).on('click', '.delete-btn', function() {
        var panelItem = $(this).closest('.panel-item');
        var index = panelItem.index(); 
        panelItem.remove();

        // Remove the corresponding column in the table
        $('table.table thead tr th').eq(index + 1).remove();
        $('table.table tbody tr').each(function() {
            $(this).find('td').eq(index).remove();
        });
        
       
        if ($.fn.dataTable.isDataTable('#mis_table')) {
            $('#mis_table').DataTable().clear().destroy();
        }

        updateTableHeaders();
        generateMis();

        if ($('#attribute .panel-item').length === 0) {
            resetPanelDiv(); 
        }
        updateTagNumbers(); 
        updateSerialNumbers(); 
    });

   
    function resetPanelDiv() {
        const panelDiv = document.getElementById('panelDiv');
        const attributePanel = document.getElementById('attribute');
        const tableSection = document.querySelector('.main--content');
        panelDiv.classList.remove('col-md-6');
        panelDiv.classList.add('col-md-12');
        attributePanel.style.display = 'none';
        if (tableSection) {
            tableSection.style.display = 'none';
        }
    }

    function updateSerialNumbers() {
        $('table.table tbody tr').each(function (index) {
            $(this).find('td:first').text(index + 1); 
        });
    }

    function updateTagNumbers() {
        $('#attribute .tag-number').each(function(index) {
            $(this).text(index + 1);
        });
        tagCounter = $('#attribute .tag-number').length + 1;
    }

    // Create a mapping object for key_name to fields_name
    const fieldsMap = {
        <?php foreach ($fields as $field): ?>
            "<?php echo htmlspecialchars($field['key_name']); ?>": "<?php echo htmlspecialchars($field['fields_name']); ?>",
        <?php endforeach; ?>
    };

    function updateHeaders(selectedAttributes) {
        var $thead = $('#mis_table thead');
        var $tbody = $('#mis_table tbody');

        // Clear existing headers
        $thead.empty();
        $tbody.empty();

        var headerRow = '<tr><th>SNo.</th>'; 
        selectedAttributes.forEach(attr => {
            var headerName = fieldsMap[attr] || attr;
            headerRow += `<th>${headerName}</th>`; 
        });
        headerRow += '</tr>';

        $thead.append(headerRow);
    }

    // Function to update table rows with SNo.
    function updateTableRows(data) {
        var $tbody = $('#mis_table tbody');
        $tbody.empty();

        data.forEach((row, index) => {
            var rowHtml = `<tr><td>${index + 1}</td>`;
            selectedAttributes.forEach(attr => {
                rowHtml += `<td>${row[attr] || ''}</td>`; 
            });
            rowHtml += '</tr>';
            $tbody.append(rowHtml);
        });
    }


    function updateHeadersforpre(attributes, fieldsNamesMap) {
        const $headerRow = $('#mis_table thead tr'); 
        const currentHeaders = $headerRow.find('th');
        const allHeaders = ['S No.', ...attributes.map(attr => fieldsNamesMap[attr] || attr)];
        allHeaders.forEach((header, index) => {
            if (currentHeaders.length > index) {
                $(currentHeaders[index]).text(header);
            } else {
                $headerRow.append(`<th>${header}</th>`);
            }
        });

        // Remove extra headers if allHeaders is shorter than currentHeaders
        if (currentHeaders.length > allHeaders.length) {
            for (let i = allHeaders.length; i < currentHeaders.length; i++) {
                $(currentHeaders[i]).remove();
            }
        }
        
    }
    
    function updateTableHeaders() {
        const selectedAttributes = [];
        $('#attribute .panel-item').each(function () {
            const attributeId = $(this).find('span').last().attr('id').trim();
            selectedAttributes.push(attributeId);
        });
      
        // Update headers
        updateHeaders(selectedAttributes);
    }
    function updateTableHeadersforpre() {
        const selectedAttributes = [];
        $('#attribute .panel-item').each(function () {
            const attributeId = $(this).find('span').last().attr('id').trim();
            selectedAttributes.push(attributeId);
        });
      
        // Update headers
        updateHeadersforpre(attributes, fieldsNamesMap);
        generateMis();
    }

    $('#attribute .panel-content').sortable({
        update: function() {
            updateTagNumbers();
            updateTableHeaders();
            generateMis();
        }
    });


    $(document).on('click', '.save-button', function() {
        var $line = $(this).siblings('.button-line');
        $line.toggle(); 

        var inputText = $('#inputText').val();
        if (!inputText || !selectedAttributes || selectedAttributes.length === 0) {
            return;
        }

        if ($(this).hasClass('btn-default')) {
            $(this)
                .removeClass('btn-default')
                .addClass('btn-success')
                .text('Save');
                $.ajax({
                    url: "<?php echo base_url('mis/savequery'); ?>", 
                    type: 'POST',
                    data: {
                        text: inputText,
                        attributes: selectedAttributes,
                    },
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            Swal.fire(
                                'Saved!',
                                'The Query has been saved with the name: ' + inputText, 
                                'success'
                            );
                        } else {
                            // alert(result.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    },
                });   
            updateDatabaseAttributes(); 
        } else {
            $.ajax({
                url: "<?php echo base_url('mis/updatequery'); ?>",
                type: 'POST',
                data: {
                    text: inputText,
                    attributes: selectedAttributes,
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        Swal.fire(
                            'Updated!',
                            'The Query has been updated with the name: ' + inputText,
                            'success'
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                },
            });
        }
        
    });

    $(document).on('click', '.filter-icon', function() {
        var $line = $(this).siblings('.filter-line');
        $line.toggle();  
    });

    $(document).on('change', '#savedqueriescontainer select', function () {
        checkFields();
    });

    document.getElementById('survey-select').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const investigatorId = selectedOption.value;
        const investigatorType = selectedOption.textContent.trim();
    });


    /* ------------------------------------------------------------------------- *
    * GET QUERY LIST
    * ------------------------------------------------------------------------- */

    function generateMis(){
        const selectedAttributes = [];

        $('#attribute .panel-item').each(function () {
            const attributeId = $(this).find('span').last().attr('id').trim();
            selectedAttributes.push(attributeId);
        });

        var selectedInvestigatorId = $('#survey-select').val();
        var $mistable = $('#mis_table');
        var selectedDateType = $('#date_type').val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        if ($.fn.dataTable.isDataTable('#mis_table')) {
            $mistable.DataTable().clear().destroy(); 
        }
        // Update the table headers dynamically
        updateHeaders(selectedAttributes);
        var filters = {};
        $('.filter-input').each(function() {
            var filterKey = $(this).data('key');
            var filterValue = $(this).val();
            if (filterValue) {
                filters[filterKey] = filterValue;
            }
        });

        if ($mistable.length) {
            $mistable.DataTable({
                "serverSide": true,
                "paging": true,
                "fixedHeader": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
              
                language: {
                    searchPlaceholder: "Search Outgoing Case",
                    "lengthMenu": "View _MENU_ records"
                },

                "order": [],
                "ajax": {
                    url: "<?php echo base_url('generatemis'); ?>",
                    type: "POST",
                    data: function(d) {
                        d.investigatorId = selectedInvestigatorId;
                        d.selectedAttributes = selectedAttributes;
                        d.filters = filters;
                        d.date_type = selectedDateType;
                        d.startDate = startDate;
                        d.endDate = endDate;
                    }
                   
                },
            
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'btn btn-success',
                        filename: function () {
                            const investigatorName = $('#survey-select option:selected').text().trim();
                            const date = new Date().toISOString().slice(0, 10); 
                            return `MIS_Report_${investigatorName}_${date}`;
                        },
                        exportOptions: {
                            format: {
                                body: function(data) {
                                    if (!isNaN(data) && data.length > 10) {
                                        return "" + data;
                                    }
                                    return data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        className: 'btn btn-danger',
                        exportOptions: {
                            modifier: {
                                page: 'all'  
                            },
                            columns: ':visible'
                        },
                        customize: function (doc) {
                            const columnCount = $('#mis_table').find('thead th').length;
                            if (columnCount > 10) {
                                doc.pageOrientation = 'landscape';
                                doc.pageSize = 'A4';
                            } else {
                                doc.pageOrientation = 'portrait';
                                doc.pageSize = 'A4';
                            }
                            doc.content[0].text = 'MIS Report';
                            doc.defaultStyle.fontSize = 8;
                        }
                    }

                ]
            });
        }   
    }
   
    $('#querymodal').on('shown.bs.modal', function () {
        generateMis();
        
    });
  
    
</script>
