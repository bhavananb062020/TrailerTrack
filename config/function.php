<?php

session_start();

require 'dbcon.php';

function validate($inputData)
{
    global $conn;

    $validatedData = mysqli_real_escape_string($conn, $inputData);
    return trim($validatedData);
}

function redirect($url, $status)
{
    $_SESSION['status'] = $status;
    header('Location: ' . $url);
    exit(0);
}
function alertMessage()
{

    if (isset($_SESSION['status'])) {

        echo '<div id="alert-3" class="flex items-center gap-2 p-4 mb-4 text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400" role="alert">
  <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>
  <span class="sr-only">Info</span>
  <div class="ms-3 text-sm font-medium">
     ' . $_SESSION['status'] . '
  </div>
  <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
    <span class="sr-only">Close</span>
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
    </svg>
  </button>
</div>';
        unset($_SESSION['status']);
    }
}



function checkParamId($paramType)
{
    if (isset($_GET[$paramType])) {
        if ($_GET[$paramType] != null) {
            return $_GET[$paramType];
        } else {

            return 'No id Given';
        }
    } else {
        return 'No id Given';
    }
}

function getAll($tableName)
{
    global $conn;

    $table = validate($tableName);

    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getById($tableName, $id)
{

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id ='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $response = [
                'status' => 200,
                'message' => 'Feched data',
                'data' => $row
            ];
            return $response;
        } else {
            $response = [
                'status' => 404,
                'message' => 'No Data Found',
            ];
            return $response;
        }
    } else {

        $response = [
            'status' => 500,
            'message' => 'Something went wrong'
        ];
        return $response;
    }
}

function deleteQuery($tableName, $id)
{

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";

    $result = mysqli_query($conn, $query);

    return $result;
}

function logoutSession()
{
    unset($_SESSION['auth']);
    unset($_SESSION['loggedInUserRole']);
    unset($_SESSION['loggedInUser']);
}

function get_last_inserted_id()
{
    global $conn; // Assuming you have a global database connection object

    // For MySQL
    return mysqli_insert_id($conn);

    // Alternatively, for PDO
    // return $conn->lastInsertId();
}
function insert($tableName, $data)
{
    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumns = implode(',', $columns);
    $finalValues = "'" . implode("','", $values) . "'";

    $query = "INSERT INTO $table ($finalColumns) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Get the last inserted ID
        $last_id = mysqli_insert_id($conn);

        // Fetch the newly inserted record
        $selectQuery = "SELECT * FROM $table WHERE id = $last_id";
        $selectResult = mysqli_query($conn, $selectQuery);
        if ($selectResult) {
            return mysqli_fetch_assoc($selectResult);
        }
    }

    return false;
}


function update($tableName, $id, $data)
{
    global $conn;

    $updateColumnValuesData = "";

    $table = validate($tableName);
    $id = validate($id);



    foreach ($data as $columns => $values) {
        $updateColumnValuesData .= $columns . '=' . "'$values',";
    }

    $finalUpdateData = substr(trim($updateColumnValuesData), 0, -1);

    $query = "UPDATE $table SET $finalUpdateData WHERE id = '$id' LIMIT 1";

    $result = mysqli_query($conn, $query);
    return $result;
}


function checkDriverStatus($driverid)
{
    global $conn;

    // Sanitize the input
    $driverid = validate($driverid);

    // SQL query to check if there's any row with the given driverid and status as "pending" (0)
    $query = "
        SELECT 1
        FROM `register`
        WHERE `driverid` = '$driverid' AND `status` = 0
        LIMIT 1";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Check if any rows were returned
    return mysqli_num_rows($result) > 0;
}

function getRegistered()
{
    global $conn;

    $table = validate('register');

    $query = "SELECT * FROM $table  WHERE status = 0";
    $result = mysqli_query($conn, $query);
    return $result;
}



function getRegisteredById($id)
{
    global $conn;

    $table = validate('register');

    $query = "SELECT * FROM $table  WHERE status = 0 AND driverid = $id ";
    $result = mysqli_query($conn, $query);
    return $result;
}
function getHistory()
{
    global $conn;

    $table = validate('register');

    $query = "SELECT * FROM $table  WHERE status = 1 ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    return $result;
}
function getHistoryById($id)
{
    global $conn;

    $table = validate('register');
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE status = 1 AND driverid = $id ORDER BY id DESC";

    $result = mysqli_query($conn, $query);
    return $result;
}

function getLogs($id)
{
    global $conn;


    $id = validate($id);

    $query = "SELECT * FROM trailer_logs where register_id = $id";
    $result = mysqli_query($conn, $query);

    return $result;
}

function getCount($tableName)
{

    global $conn;

    $table = validate($tableName);

    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);

    $totalCount = mysqli_num_rows($result);

    return $totalCount;
}
function getOngoingCount()
{

    global $conn;

    $drivers = getAll('drivers');
    $totalCount = 0;

    if (mysqli_num_rows($drivers) > 0) {
        foreach ($drivers as $Item) {
            if (!checkDriverStatus($Item['id'])) {
                continue;
            } else {
                $totalCount =  $totalCount + 1;
            }
        }
    }



    return $totalCount;
}

function getHistoryCount()
{
    global $conn;

    $table = validate('register');

    $query = "SELECT * FROM $table  WHERE status = 1";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    return $count;
}
