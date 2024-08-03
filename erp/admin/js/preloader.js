//for preloader
document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener("load", function() {
        // Wait for 5 seconds after the page has loaded
        setTimeout(function() {
            document.getElementById("preloader").style.display = "none";
        }, 5000); // 5000 milliseconds = 5 seconds
    });
});

//checks for smaller screen and halt it
document.addEventListener("DOMContentLoaded", function() {
    function checkScreenSize() {
        if (window.innerWidth <= 765) {
            // Show the mobile warning dialog
            document.getElementById("mobile-warning-dialog").style.display = "flex";
        } else {
            // Hide the mobile warning dialog
            document.getElementById("mobile-warning-dialog").style.display = "none";
        }
    }

    // Check screen size on load
    checkScreenSize();

    // Check screen size on resize
    window.addEventListener("resize", checkScreenSize);
});

 // Prevent right-click context menu
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // Prevent certain key shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.keyCode === 123 || 
            (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 73)) ||
            (e.ctrlKey && e.keyCode === 85)) {
            e.preventDefault();
        }
    });

// Toggle the sublists
document.querySelectorAll('.sdbrLnks > a').forEach(item => {
    item.addEventListener('click', function() {
        // First, remove the 'active' class from all other items
        document.querySelectorAll('.sdbrLnks.active').forEach(activeItem => {
            if (activeItem !== this.parentNode) {
                activeItem.classList.remove('active');
            }
        });
        
        // Then, toggle the 'active' class on the currently clicked item
        this.parentNode.classList.toggle('active');
    });
});

