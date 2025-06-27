<?php
session_start();
session_destroy(); // Destroy the session
header("Location: SignUp.html"); // Redirect to login page
exit();
