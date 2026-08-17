<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    th, td {
        border: 1px solid black;
        min-width: 32px;
        cursor: pointer;
        position: relative;
    }
    th {
        background-color: #f4f4f4;
    }
    .buttons {
        margin: 10px 0;
    }
    .remove-btn {
        color: red;
        cursor: pointer;
        font-weight: bold;
        margin-left: 5px;
    }
    .editable {
        background: #fff;
        border: none;
        width: 100%;
        text-align: center;
    }
</style>
<div id="assessmentModal" class="modal fade">
    <div class="modal-dialog" style="max-width:100%; margin-left:15px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Motor Assessment</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding-top:0.875rem">
                <div class="buttons">
                    <button id="addRowBefore">➕ Add Row Before</button>
                    <button id="addRowAfter">➕ Add Row After</button>
                    <button id="addColumn">➕ Add Column</button>
                </div>

                <table id="editableTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Particulars</th>
                            <th>Bill SI. / Remarks</th>
                            <th colspan="2">Estimated Amount</th>
                            <th colspan="7">Assessed Amount</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Parts</th>
                            <th>Labour</th>
                            <th>Labour</th>
                            <th>Metal</th>
                            <th>Rubber</th>
                            <th>Rubber</th>
                            <th>Glass</th>
                            <th>IMT 23R</th>
                            <th>IMT 23R Paint</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td contenteditable="true">1</td>
                            <td contenteditable="true">Particulars 1</td>
                            <td contenteditable="true">Bill SI 1</td>
                            <td contenteditable="true">0</td>
                            <td contenteditable="true">0</td>
                            <td contenteditable="true">0</td>
                            <td contenteditable="true">0</td>
                            <td contenteditable="true">0</td>
                            <td contenteditable="true">0</td>
                            <td contenteditable="true">0</td>
                            <td contenteditable="true">0</td>
                            <td contenteditable="true">0</td>
                            <td><button class="removeRow">❌ Remove</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

