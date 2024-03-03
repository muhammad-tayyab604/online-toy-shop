function deleteImage(index) {
    var deletedImagesInput = document.getElementById("deleted_images");
    deletedImagesInput.value += index + ",";

    // Update the index for the next deleted image
    var imageContainers = document.querySelectorAll(".image-container");
    if (imageContainers.length === 0) {
        // Reset the index if there are no images left
        deletedImagesInput.value = "";
    }
}
