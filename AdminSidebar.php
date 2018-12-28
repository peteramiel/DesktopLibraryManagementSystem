<nav id="sidebar">
        <div class="sidebar-header">
		<img src="images/icons/images_library_book.png" alt="Logo" style="width: 100%;" >
        </div>
 		<h3 style="margin: 10px">RBLMS</h3>
        <ul class="list-unstyled components">
            <li id="homeLi">
                <a href="AdminHome.php">Home</a>
            </li>
            <li id="booksLi">
                <a href="#bookSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Books</a>
                <ul class="collapse list-unstyled" id="bookSubmenu">
                    <li>
                        <a href="AdminAddBook.php">Add Book</a>
                    </li>
                    <li>
                        <a href="AdminSearchBook.php">Search Book</a>
                    </li>
                    <li>
                        <a href="AdminEditBook.php">Edit Book</a>
                    </li>
                </ul>
            </li>
            <li id="newsLi">
                <a href="#newsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">News</a>
                <ul class="collapse list-unstyled" id="newsSubmenu">
                    <li>
                        <a href="#">View News</a>
                    </li>
                    <li>
                        <a href="#">Add News</a>
                    </li>
                    <li>
                        <a href="#">Delete News</a>
                    </li>
                </ul>
            </li>
            <li id="librariansLi">
                <a href="#">Librarians</a>
            </li>
            <li id="addStudentsLi">
                <a href="AdminAddStudent.php">Add Students</a>
            </li>
                <li id="studentVerificationLi">
                <a href="ApplicationList.php">Application List</a>
            </li>
            <li id="editSearchPageLi">
                <a href="#">Edit Search Page</a>
            </li>
            <li id="logoutLi">
                <a style="cursor: hand;">Logout</a>
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