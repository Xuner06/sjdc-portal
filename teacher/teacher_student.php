<?php
include("../database/database.php");
include("../actions/session.php");
sessionTeacher();

$id = $_SESSION['teacher'];
$stmtTeacher = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtTeacher->bind_param("i", $id);
$stmtTeacher->execute();
$stmtResult = $stmtTeacher->get_result();
$row = $stmtResult->fetch_assoc();

$class = $conn->prepare("SELECT * FROM class c LEFT JOIN strand s ON c.strand = s.strand_id LEFT JOIN users u ON c.adviser = u.id LEFT JOIN school_year sy ON c.sy = sy.sy_id WHERE c.adviser = ?");
$class->bind_param("i", $id);
$class->execute();
$resultClass = $class->get_result();
if (mysqli_num_rows($resultClass) > 0) {
  $rowClass = $resultClass->fetch_assoc();
  $finalClass = $rowClass['level'] . '-' . $rowClass['strand'] . '-' . $rowClass['section'];
  $finalAdviser = $rowClass['fname'] . ' ' . (!empty($rowClass['mname']) ? substr($rowClass['mname'], 0, 1) . '.' : '') . ' ' . $rowClass['lname'];
  $finalSy = 'S.Y. ' . $rowClass['start_year'] . '-' . $rowClass['end_year'];
} else {
  $finalClass = '';
  $finalAdviser = '';
  $finalSy = '';
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <link rel="icon" href="../assests/bg1.png" type="image/x-icon">
  <title>SJDC | Student List</title>
</head>

<body>
  <?php include("../components/teacher_navbar.php"); ?>
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Student List</h1>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center">Student List</h1>
                <?php
                $stat = "Active";
                $Sy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                $Sy->bind_param("s", $stat);
                $Sy->execute();
                $ResultSy = $Sy->get_result();

                if (mysqli_num_rows($ResultSy) > 0) {
                  $result = $ResultSy->fetch_assoc();
                  $schoolyear = $result['sy_id'];

                  $class = $conn->prepare("SELECT c.*, s.* FROM class c JOIN strand s ON c.strand = s.strand_id WHERE c.adviser = ? AND c.sy = ?");
                  $class->bind_param("ii", $id, $schoolyear);
                  $class->execute();
                  $stmtResultClass = $class->get_result();
                  if (mysqli_num_rows($stmtResultClass) > 0) {
                    while ($rowClass = $stmtResultClass->fetch_assoc()) {
                      echo '<h1>' . $rowClass['level'] . '-' . $rowClass['strand'] . '-' . $rowClass['section'] . '</h1>';
                    }
                  }
                }
                ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>LRN Number</th>
                      <th>Name</th>
                      <th>Sex</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $status = "Active";
                    $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                    $stmtSy->bind_param("s", $status);
                    $stmtSy->execute();
                    $stmtResultSy = $stmtSy->get_result();

                    if (mysqli_num_rows($stmtResultSy) > 0) {
                      $result = $stmtResultSy->fetch_assoc();
                      $sy = $result['sy_id'];
                      $studentStatus = 0;
                      $stmtEnroll = $conn->prepare("SELECT e.*, c.adviser, u.* FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN users u ON e.student_id = u.id WHERE c.adviser = ? AND e.sy = ? AND u.status = ?");
                      $stmtEnroll->bind_param("iii", $id, $sy, $studentStatus);
                      $stmtEnroll->execute();
                      $stmtResultEnroll = $stmtEnroll->get_result();
                      if (mysqli_num_rows($stmtResultEnroll) > 0) {
                        while ($row = $stmtResultEnroll->fetch_assoc()) {
                    ?>
                          <tr>
                            <td><?php echo $row['lrn_number']; ?></td>
                            <td><?php echo $row['lname'] . ", " . $row['fname'] . " " . (!empty($row['mname']) ? substr($row['mname'], 0, 1) . "." : ""); ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td>
                              <a href="teacher_view_student.php?id=<?php echo $row['student_id']; ?>" class="btn btn-primary btn-sm">View</a>
                            </td>
                          </tr>
                        <?php
                        }
                      } else {
                        ?>
                        <tr>
                          <td colspan="6" class="text-center">No Assign Student</td>
                          <td class="d-none"></td>
                          <td class="d-none"></td>
                          <td class="d-none"></td>
                          <td class="d-none"></td>
                          <td class="d-none"></td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="6" class="text-center">No Active School Year</td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- DataTables  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "order": [
          [1, "asc"]
        ],
        "buttons": [{
            extend: 'copy',
            className: 'mr-2 rounded rounded-2',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          }, {
            extend: 'csv',
            className: 'mr-2 rounded rounded-2',
            exportOptions: {
              columns: [0, 1, 2, 3, 4],
              format: {
                body: function(data, row, column, node) {
                  // Apply single quotation marks for columns 0 and 3
                  if (column === 0 || column === 4) {
                    return "'" + data + "'";
                  } else {
                    return data;
                  }
                }
              }
            },
          },
          {
            extend: 'print',
            className: 'mr-2 rounded rounded-2',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            },
            title: '',
            messageTop: function() {
              return '<img src="../assests/header.png" class="mx-auto d-block">' + '<h1 class="text-center"><?php echo $finalClass; ?></h1>' + '<h1 class="text-center"><?php echo $finalSy; ?></h1>' + '<h1 class="text-center mb-4"><?php echo $finalAdviser; ?></h1>';
            }
          }
        ],
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>