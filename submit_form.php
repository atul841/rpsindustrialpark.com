<?php
// SQL Server connection settings
$serverName = "localhost"; // or IP\InstanceName
$connectionOptions = array(
    "Database" => "ContactForm",
    "Uid" => "localhost",
    "PWD" => ""
);

// Create connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Check connection
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Collect form data
$firstName    = $_POST['first_name'];
$lastName     = $_POST['last_name'];
$mobileNumber = $_POST['mobile_number'];
$email        = $_POST['email'];
$projectType  = $_POST['project_type'];
$companyName  = $_POST['company_name'];
$message      = $_POST['message'];

// Prepare SQL Insert
$sql = "INSERT INTO ContactForm (FirstName, LastName, MobileNumber, Email, ProjectType, CompanyName, Message)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$params = array($firstName, $lastName, $mobileNumber, $email, $projectType, $companyName, $message);

// Execute query
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt) {
    echo "Form submitted successfully!";
} else {
    echo "Error: ";
    print_r(sqlsrv_errors());
}

// Close connection
sqlsrv_close($conn);
?>
