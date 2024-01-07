<?php
    require './includes/new_header.php';
    include './sideHeight.php';
    $fetchHist = mysqli_query($conn, "SELECT * FROM acc_history WHERE user_ref='$user_Ref'");
    $table_id = 0;
?>

<style>

    th {
        background-color: white;
    }

    tr:nth-child(odd) {
        background-color: grey;
    }

    th,
    td {
        padding: 0.5rem;
    }

    td:hover {
        background-color: lightsalmon;
    }

    .paginate_button {
        border-radius: 0 !important;
    }
    .history-container{
       position: relative;
    }
    .history-container .table-row{
        position: absolute;
        right: 30px;
        left: 30px;
       width: 90%;
        margin: 2em;
    }
    @media (max-width: 468px) {
        .history-container .table-row{
            left: -10px;
        }
    }
    /* .history-container table#historyTable{
  
        overflow-x: scroll;

       
    }
     */
</style>
<div class="history-container">
    <div class="table-row">
        <table id="historyTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>#REF</th>
                    <th>AMOUNT</th>
                    <th>TYP</th>
                    <th>STATUS</th>
                    <th>DATE</th>
                    <th>ACTION</th>
                 
                </tr>
            </thead>

            <tbody>
              <?php
                while($row = mysqli_fetch_assoc($fetchHist)) :?>
                    <tr>
                        <td><?=$row['tran_Ref']?></td>
                   
                        <td><?=$row['amt']?></td>
                        <td><?=$row['Tran_Typ']?></td>
                        <td><?=$row['tran_status']?></td>
                        <td><?=$row['hist_date']?></td>
                        <td><a href="statement.php?tran_ref=<?=$row['tran_Ref']?>">Print</a></td>
                    </tr>
                <?php endwhile;
              
              ?>
               
            </tbody>
        </table>
    </div>
    
    
</div>


<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.13.4/js/dataTables.jqueryui.min.js'></script>
<!-- <script src='https://cdn.datatables.net/scroller/2.1.1/js/dataTables.scroller.min.js'></script> -->

<script>
    $(document).ready(function() {
        let table = $('#historyTable').DataTable(
            {
                // scrollY:        200,
                scrollX:        true,
                // scrollCollapse: true,
                scroller:       true
            }
        );
        new $.fn.dataTable.FixedColumns( table );
    } );
</script>
<?php require './includes/new_footer.php' ?>