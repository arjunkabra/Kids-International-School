<div class="dashboardHeader">

<div class="dashboardHeaderTitle">Admin Dashboard | <?php echo $org_name; ?></div>

<div class="adminDetails">
<?php if (isset($_SESSION['admin_id'])) { echo "Welcome " .$_SESSION['admin_name']; } ?><br />
<a href="myAccount">My Account</a> | <a href="logout">Logout</a>
</div>

</div>