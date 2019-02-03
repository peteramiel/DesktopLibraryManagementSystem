<style >
    
#sidebar {
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 999;
    background: #3778a3;
    color: #fff;
    transition: all 0.3s;
}
@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

a, a:hover, a:focus {
    color: #fff;
    text-decoration: none;
    transition: all 0.3s;
}


#sidebar {
    /* don't forget to add all the previously mentioned styles here too */
    background: #3778a3;
    color: #fff;
    transition: all 0.3s;
}

#sidebar .sidebar-header {
    /*padding: 20px;*/
    background: #3778a3;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #fff;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
    font-family: 'Century Gothic';
}
#sidebar ul li a:hover {
    color: #fff;
    background: #08324f;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: #fff;
    background: #08324f;
}
#content{
    margin-left: 250px;
    padding: 20px;
}

h3{
    font-family: 'Poppins', sans-serif;
    font-size: 1.5em;
}

ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #3778a3;
}


</style>

<nav id="sidebar">
        <div class="sidebar-header">
		<img src="images/icons/images_library_book.png" alt="Logo" style="width: 100%;" >
        </div>
 		<h3 style="margin: 10px; font-family: Century Gothic;">ARCHIVES</h3>
        <ul class="list-unstyled components">
            <li id="homeLi">
                <a style="font-family: Century Gothic" href="AdminHome.php">Home</a>
            </li>
            <li id="booksLi">
                <a style="font-family: Century Gothic" href="#bookSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Books</a>
                <ul class="collapse list-unstyled" id="bookSubmenu">
                    <li>
                        <a style="font-family: Century Gothic" href="AdminAddBook.php">Add Book</a>
                    </li>
                    <li>
                        <a style="font-family: Century Gothic" href="AdminSearchBook.php">Search Book</a>
                    </li>
                   
                </ul>
            </li>
            
            <li id="librariansLi">
                <a style="font-family: Century Gothic" href="AdminLibrarianList.php">Librarians</a>
            </li>

            <li id="addStudentsLi">
                <a style="font-family: Century Gothic" href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Student</a>
                <ul class="collapse list-unstyled" id="studentSubmenu">
                    <li>
                        <a  style="font-family: Century Gothic" href="AdminAddStudent.php">Add Student</a>
                    </li>
                    <li>
                        <a  style="font-family: Century Gothic" href="AdminSearchStudent.php">Search Student</a>
                    </li>
                </ul>
            </li>

            <li id="addAdminLi">
                <a style="font-family: Century Gothic" href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Admin</a>
                <ul class="collapse list-unstyled" id="adminSubmenu">
                    <li>
                        <a style="font-family: Century Gothic" href="AdminAddAdmin.php">Add Admin</a>
                    </li>
                    <li>
                        <a style="font-family: Century Gothic" href="AdminSearchAdmin.php">Search Admin</a>
                    </li>
                </ul>
                
            </li>

            <li id="studentVerificationLi">
                <a style="font-family: Century Gothic" href="ApplicationList.php">Application List</a>
            </li>
            <li id="viewRecentActivitiesLi">
                <a style="font-family: Century Gothic" href="AdminRecentActivities.php">View Recent Activities</a>
            </li>
            <li id="logoutLi">
                <a style="cursor: hand; font-family:Century Gothic; ">Logout</a>
            </li>
        </ul>

    </nav>
     <!-- JS dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <!-- bootbox code -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
    $(document).ready(function() {
      $('#logoutLi').click(function() {
        bootbox.confirm("Are you sure want to logout?", function(result) {
          if(result==true){
              window.location.href = "logout.php";
          }else{
              // window.location.href = "AdminSearchBook.php";
          }
        });
      });
    });
</script>