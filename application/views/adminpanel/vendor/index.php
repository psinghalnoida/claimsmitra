<style>
    #vendorlist {
        width: 100%;
        border-collapse: collapse;
    }

    #vendorlist tbody td {
        vertical-align: middle;
        padding: 0.40rem;
        border-bottom: 1px solid #dee2e6;
        font-size: 14px;
        color:black
    }

    #vendorlist tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #vendorlist tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    #vendorlist thead th {
        background-color: #fbf4ee;
        text-align: center;
        padding: 0.40rem;
        border-bottom: 1px solid #f8f9fa;
        font-size: 14px;
    }

    /* #vendorlist tbody tr:hover {
        background-color: #a7e0e2; 
    } */
</style>

<table id="vendorlist" class="table table-bordered table-hover mt-4" style="width:100%">
    <thead>
        <tr>
            <th style="width:4%;">Select</th>
            <th>Vendor Name</th>
            <th>Branch Address</th>
            <th>User Name</th>
            <!-- <th>Action</th> -->
        </tr>
    </thead>
</table>

