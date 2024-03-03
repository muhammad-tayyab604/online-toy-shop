let profile = document.querySelector(".profile");
let profileModal = document.querySelector(".profileModal");

profile.addEventListener("click", function () {
    // Toggle the modal's visibility
    if (profileModal.style.display === "block") {
        profileModal.style.display = "none";
    } else {
        profileModal.style.display = "block";
    }
});
