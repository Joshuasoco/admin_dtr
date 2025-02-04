
        // Show logout popup
        function show_logout() {
            console.log("Show logout popup");
            document.getElementById("logout_warning").style.display = "block";
        }

        // Hide logout popup
        function hide_logout() {
            document.getElementById("logout_warning").style.display = "none";
        }

        // Perform logout action
        function logout() {
            document.getElementById("logout_warning").style.display = "none";
            console.log("Logout");
            window.location.href = "#"; // Change this to the actual login page URL
        } 