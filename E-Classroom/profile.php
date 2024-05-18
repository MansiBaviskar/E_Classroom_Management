<?php 
include("header.php");
$username = "";
$userFullName = " ";
$email = " ";
$firstName = "";
$lastName  = "";
$Teacher_id = "";
$Student_id = "";
$code = "";
$profilePic= "";

if (isset($_GET['profile_username'])) {
    $username = $_GET['profile_username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
    $user_array = mysqli_fetch_array($user_details_query);
    $userFullName = $user_array['first_name'] . " " . $user_array['last_name'];
    $email = $user_array['email'];
    $firstName = $user_array['first_name'];
    $lastName = $user_array['last_name'];
    $Teacher_id = $user_array['Teacher_id'];
    $Student_id= $user_array['Student_id'];
    $profilePic = $user_array['profilePic'];
}
if (isset($_POST['profile-updateBtn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $Teacher_id = $_POST['Teacher_id'];
    $Student_id = $_POST['Student_id'];
    $query = mysqli_query($con, "UPDATE users SET first_name ='$firstName' WHERE username LIKE '$username'");
    $query1 = mysqli_query($con, "UPDATE users SET last_name ='$lastName' WHERE username LIKE '$username'");
    $query2 = mysqli_query($con, "UPDATE users SET Teacher_id ='$Teacher_id' WHERE username LIKE '$username'");
    $query3 = mysqli_query($con, "UPDATE users SET Student_id ='$Student_id' WHERE username LIKE '$username'");
    header("Location: $username");
}

$teaching  = new User($con,$code ,$username);
$query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
$row = mysqli_fetch_array($query);

$editBtn = "";
if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    if($userLoggedIn == $username){
        $editBtn = '<div class="edit-btn" onclick="openEdit()"><i class="fas fa-edit"></i>Edit</div>';
    }
    
};
?>

<main class="profile-body">
    <div class="backdrop"></div>
    <div class="modal">
        <form action=<?php echo $username; ?> method="POST">
            <label for="First Name">First name:</label>
            <input type="text" name="firstName" id="" value=<?php echo $firstName; ?> autocomplete="off">
            <label for="Last Name">Last name:</label>
            <input type="text" name="lastName" id="" value=<?php echo $lastName; ?> autocomplete="off">
            <label for="Email">Email:</label>
            <input type="email" name="Email" id="" disabled value=<?php echo $email; ?>>
            <label for="Teacher_id">Teacher_id:</label>
            <input type="int" name="Teacher_id" id="" value=<?php echo $Teacher_id; ?> autofocus autocomplete="off">
            <label for="Student_id">Student_id:</label>
            <input type="int" name="Student_id"" value=<?php echo $Student_id; ?> autofocus autocomplete="off">
           
            <div>
                <div class="closeBtn" onclick="closeModal()">Cancel</div>
                <input type="submit" value="Update" class="profile-updateBtn" name="profile-updateBtn">
            </div>
        </form>

    </div>
    <section class="side-bar">
        <div class="profile__image">
            <!-- <p>profile image will go here if there is any</p> -->
            <a href="upload.php"> <img src="<?php echo $profilePic; ?>"> </a>
        </div>
        <a href="upload.php">Add a new profile picture </a>
        <p>username:&nbsp;&nbsp; <?php echo  $username; ?></p>
    </section>
    <section class="profile">
        <span class="titles">Name:</span>
        <p>&nbsp;&nbsp; <?php echo $userFullName; ?> </p>
        <span class="titles">Email:</span>
        <p>&nbsp;&nbsp; <?php echo $email; ?> </p>
        <span class="titles">Teacher_id:</span>
        <p>&nbsp;&nbsp; <?php echo $Teacher_id; ?> </p>
        <span class="titles">Student_id: </span>
        <p class="Student_id"><?php echo $Student_id; ?></p>
        <?php echo $editBtn ?>
    </section>
    <div class="clear"></div>
</main>


<script>
    function reloadPage() {
        location.reload(true);
    }

    function openEdit() {
        document.querySelector('.profile-body .modal').style.display = 'block';
        document.querySelector('.backdrop').style.display = 'block';
    }

    function closeModal() {
        document.querySelector('.profile-body .modal').style.display = 'none'
        document.querySelector('.backdrop').style.display = 'none'
    }
</script>
</body>


            