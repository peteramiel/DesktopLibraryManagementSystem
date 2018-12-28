<script src="https://www.gstatic.com/firebasejs/5.7.0/firebase.js"></script>
	<script>
  // Initialize Firebase
  var config = {
  	apiKey: "AIzaSyA5WJVnzMdQG6QDzZQshnttG-SuQMx2d-U",
  	authDomain: "librarymanagementsystem-7c1ac.firebaseapp.com",
  	databaseURL: "https://librarymanagementsystem-7c1ac.firebaseio.com",
  	projectId: "librarymanagementsystem-7c1ac",
  	storageBucket: "librarymanagementsystem-7c1ac.appspot.com",
  	messagingSenderId: "549983071560"
  };
  firebase.initializeApp(config);
</script>

<script>
        function loginAdmin(userName, password){

          var adminRef =  firebase.database().ref('Admin/Account');
          adminRef.on("value", function(snapshot) {
            var adminInfo = snapshot.val();
            // console.log("Admin UserName: " + adminInfo.userName);
            // console.log("Title Password: " + adminInfo.password);
            if(userName ==adminInfo.userName && password == adminInfo.password){
              alert('The book is created successfully!' + adminInfo.userName);
            };
            
          }, function (errorObject) {
            // console.log("The read failed: " + errorObject.code);
          });
          // alert('The book is created successfully!' + password);
        }


      </script>