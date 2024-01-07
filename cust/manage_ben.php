    <?php
    require_once './config/config.php';
    require_once './includes/new_header.php';

    $brookCount = 1;
    $otherCount = 1;

    $brookSql = mysqli_query($conn, "SELECT * FROM brook_beneficiary WHERE cust_Ref='$user_Ref'");
    $otherSql = mysqli_query($conn, "SELECT * FROM other_beneficiary WHERE cust_Ref='$user_Ref'");

    if (isset($_POST['yes'])) {
        $userBrok = $_POST['userRef'];
        $brookSql = mysqli_query($conn, "DELETE  FROM brook_beneficiary WHERE beneficiary_Ref='$userBrok'");
        if ($brookSql) {
            echo  "<script>alert('Beneficiary Details have been deleted');window.location.href='./manage_ben.php';</script>";
        } else {
            echo "<script>alert('Beneficiary Details failed to be deleted');window.location.href='./manage_ben.php';</script>";
            $otheruUser = $_POST['userRef'];
            $sql = mysqli_query($conn, "DELETE FROM other_beneficiary WHERE beneficiary_Ref='$otheruUser'");
            if ($sql) {
                echo "<script>alert('Beneficiary Details have been deleted');window.location.href='./manage_ben.php';</script>";
            } else {
                echo "<script>alert('Beneficiary Details failed to be deleted');window.location.href='./manage_ben.php';</script>";
            }
        }
    }

    ?>

    <div class="column-large" id="col-large">
        <div class="general-settings-container bene-container">
            <?php
            if (isset($_GET['delete']) || isset($_GET['brdelete'])) { ?>
            <div class="card mx-auto mt-5" style="width: 13rem;">
                <form action="" method="post" class="card-body bg-warning text-center">
                    <input type="hidden" name="userRef" value="<?php if (isset($_GET['delete'])) {
                                echo $otherBen = base64_decode($_GET['delete']);
                            }
                            if (isset($_GET['brdelete'])) {
                                echo  $userBrook = base64_decode($_GET['brdelete']);
                            } ?>">
                    <p class="text-white">Are you Sure?</p>
                    <div class="container">
                        <input type="submit" class="btn btn-danger btn-sm" value="YES" name="yes">
                        <a href="./manage_ben" class="">NO</a>
                    </div>
                </form>
            </div>

            <?php } else { ?>
            <div class="brook-beneficiaries mt-3 ms-3 w-100">
                <table class="table table-striped">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th colspan="3">STARLING BENEFICIARIES</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>ACC-NO</th>
                            <th>NAME</th>
                            <th>ACC-TYPE</th>
                            <th>DATE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (mysqli_num_rows($brookSql) == 0) { ?>
                        <tr>
                            <td colspan="5" class="text-center text-danger fw-bold">NO BENEFICIARY SAVED</td>
                        </tr>
                        <?php } else
                                while ($row1 = mysqli_fetch_array($brookSql)) { ?>
                        <tr>
                            <td><?= $brookCount++ ?></td>
                            <td><?= $row1['acc_Num'] ?></td>
                            <td><?= $row1['name'] ?></td>
                            <td><?= $row1['acc_Type'] ?></td>
                            <td><?= $row1['saved_date'] ?></td>
                            <td><a href="?brdelete=<?= base64_encode($row1['beneficiary_Ref']) ?>"
                                    class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="other-beneficiaries mt-5 ms-3">
                <table class="table table-striped">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th colspan="4">OTHER BENEFICIARIES</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>ACC-NO</th>
                            <th>NAME</th>
                            <th>BANK</th>
                            <th>SWIFT</th>
                            <th>ROUTING</th>
                            <th>DATE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (mysqli_num_rows($otherSql) == 0) { ?>
                        <tr>
                            <td colspan="5" class="text-center text-danger fw-bold">NO BENEFICIARY SAVED</td>
                        </tr>
                        <?php } else
                                while ($row = mysqli_fetch_array($otherSql)) { ?>
                        <tr>
                            <td><?= $brookCount++ ?></td>
                            <td><?= $row['acc_Num'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['bank'] ?></td>
                            <td><?= $row['swift'] ?></td>
                            <td><?= $row['routing'] ?></td>
                            <td><?= $row['saved_Date'] ?></td>
                            <td><a href="?delete=<?= base64_encode($row['beneficiary_Ref']) ?>"
                                    class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php require_once './includes/new_footer.php'; ?>