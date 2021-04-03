<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Validating Forms</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>

<?php
$name = $email = $username = $password = $confirmPassword = $dob = "";
$gender = $maritalStatus = $address = $city = $zipcode = $homePhone = "";
$mobilePhone = $ccNumber = $ccExpiry = $salary = $websiteURL = $gpa = "";

$nameValid = $emailValid = $usernameValid = $passwordValid = $confirmPasswordValid = true;
$zipcodeValid = $addressValid = $cityValid = $homePhoneValid = $mobilePhoneValid = true;
$ccNumberValid = $ccExpiryValid = $salaryValid = $websiteURLValid = $dobValid = $gpaValid = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_REQUEST["name"];
    $email = $_REQUEST["email"];
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    $confirmPassword = $_REQUEST["confirmPassword"];
    $dob = $_REQUEST["dob"];
    $gender = $_REQUEST["gender"];
    $address = $_REQUEST["address"];
    $city = $_REQUEST["city"];
    $zipcode = $_REQUEST["zipcode"];
    $homePhone = $_REQUEST["homePhone"];
    $mobilePhone = $_REQUEST["mobilePhone"];
    $ccNumber = $_REQUEST["ccNumber"];
    $ccExpiry = $_REQUEST["ccExpiry"];
    $salary = $_REQUEST["salary"];
    $websiteURL = $_REQUEST["websiteURL"];
    $gpa = $_REQUEST["gpa"];

    $nameValid = strlen($name) >= 2 && preg_match('/^[a-z]{3,}$/i', $name);
    $emailValid = preg_match("/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b/i", $email);
    $usernameValid = strlen($username) >= 5;
    $passwordValid = strlen($password) >= 8;
    $confirmPasswordValid = $password == $confirmPassword;
    $dobValid = true;
    $ccExpiryValid = true;

    $addressValid = !!($address);
    $cityValid = !!($city);

    $zipcodeValid = preg_match('/^\d{6}$/', $zipcode);
    $homePhoneValid = preg_match('/^\d{9}$/', $homePhone);
    $mobilePhoneValid = preg_match('/^\d{9}$/', $mobilePhone);
    $ccNumberValid = preg_match('/^\d{16}$/', $ccNumber);

    $salaryValid = preg_match('/^[0-9\,\.]+$/', $salary);
    $websiteURLValid = preg_match('/^((https?):\/\/(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)$/i', $websiteURL);
    $gpaValid = preg_match("/^([0-3]\.[0-9]|4\.[0-5])$/", $gpa);
}

?>

<body>
<h1>Registration Form</h1>

<p>
    This form validates user input and then displays "Thank You" page.
</p>

<hr />

<h2>Please, fill below fields correctly</h2>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            <form action="index.php" method="post" class="needs-validation">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control <?= $nameValid ? '' : 'is-invalid' ?>" value="<?= $name ?>" name="name" id="name">
                            <div class="invalid-feedback">
                                It has to contain at least 2 chars!
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control <?= $emailValid ? '' : 'is-invalid' ?>" value="<?= $email ?>" name="email" id="email">
                            <div class="invalid-feedback">
                                It should correspond to email format!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control <?= $usernameValid ? '' : 'is-invalid' ?>" value="<?= $username ?>" name="username" id="username">
                            <div class="invalid-feedback">
                                This field is required. It has to contain at least 5 chars.
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control <?= $passwordValid ? '' : 'is-invalid' ?>" value="<?= $password ?>" name="password" id="password">
                            <div class="invalid-feedback">
                                It has to contain at least 8 chars.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control <?= $confirmPasswordValid ? '' : 'is-invalid' ?>" value="<?= $confirmPassword ?>" name="confirmPassword" id="confirmPassword">
                            <div class="invalid-feedback">
                                It has to be equal to Password field.
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" id="dob" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label><br>

                            <div class="form-check form-check-inline" id="gender">
                                <input class="form-check-input" type="radio" name="gender" id="male" checked>
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female">
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="maritalStatus" class="form-label">Marital Status</label><br>
                            <div class="form-check form-check-inline" id="maritalStatus">
                                <input class="form-check-input" type="radio" name="maritalStatus" id="single" checked>
                                <label class="form-check-label" for="single">
                                    Single
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="maritalStatus" id="married">
                                <label class="form-check-label" for="married">
                                    Married
                                </label>
                            </div>
                            <div class="form-check form-check-inline" id="maritalStatus">
                                <input class="form-check-input" type="radio" name="maritalStatus" id="divorced">
                                <label class="form-check-label" for="divorced">
                                    Divorced
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="maritalStatus" id="widowed">
                                <label class="form-check-label" for="widowed">
                                    Widowed
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control <?= $addressValid ? '' : 'is-invalid' ?>" value="<?= $address ?>" name="address" id="address">
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control <?= $cityValid ? '' : 'is-invalid' ?>" value="<?= $city ?>" name="city" id="city">
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="zipcode" class="form-label">Postal Code</label>
                            <input type="text" class="form-control <?= $zipcodeValid ? '' : 'is-invalid' ?>" value="<?= $zipcode ?>" name="zipcode" id="zipcode">
                            <div class="invalid-feedback">
                                It should follow 6 digit format!
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="homePhone" class="form-label">Home Phone</label>
                            <input type="text" class="form-control <?= $homePhoneValid ? '' : 'is-invalid' ?>" value="<?= $homePhone ?>" name="homePhone" id="homePhone">
                            <div class="invalid-feedback">
                                It should follow 9 digit format!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="mobilePhone" class="form-label">Mobile Phone</label>
                            <input type="text" class="form-control <?= $mobilePhoneValid ? '' : 'is-invalid' ?>" value="<?= $mobilePhone ?>" name="mobilePhone" id="mobilePhone">
                            <div class="invalid-feedback">
                                It should follow 9 digit format!
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="ccNumber" class="form-label">Credit Card Number</label>
                            <input type="text" class="form-control <?= $ccNumberValid ? '' : 'is-invalid' ?>" value="<?= $ccNumber ?>" name="ccNumber" id="ccNumber">
                            <div class="invalid-feedback">
                                It should follow 16 digit format!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="ccExpiry" class="form-label">Credit Card Expiry Date</label>
                            <input type="date" class="form-control" name="ccExpiry" id="ccExpiry" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="name" class="form-label">Monthly Salary</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="currency">UZS</span>
                                <input type="text" class="form-control <?= $salaryValid ? '' : 'is-invalid' ?>" value="<?= $salary ?>" name="salary" id="salary" aria-describedby="currency">
                                <span class="input-group-text">.00</span>
                                <div class="invalid-feedback">
                                    It should be written in following format 100,000.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="websiteURL" class="form-label">WebSite URL</label>
                            <input type="text" class="form-control <?= $websiteURLValid ? '' : 'is-invalid' ?>" value="<?= $websiteURL ?>" name="websiteURL" id="websiteURL">
                            <div class="invalid-feedback">
                                It should match URL format. For ex, http://github.com.
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="gpa" class="form-label">Overall GPA</label>
                            <input type="text" class="form-control <?= $gpaValid ? '' : 'is-invalid' ?>" value="<?= $gpa ?>" name="gpa" id="gpa">
                            <div class="invalid-feedback">
                                It should be a floating point number less than or equal to 4.5
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Register</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>