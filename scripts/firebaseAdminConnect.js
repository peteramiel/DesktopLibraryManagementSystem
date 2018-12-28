	var admin = require('firebase-admin');
	var serviceAccount = require('../includes/librarymanagementsystem-7c1ac-c3a7bf53a58f.json');
  // Initialize Firebase
  // TODO: Replace with your project's customized code snippet
	admin.initializeApp({
	  credential: admin.credential.cert(serviceAccount),
	  databaseURL: 'https://LibraryManagementSystem.firebaseio.com'
	});
