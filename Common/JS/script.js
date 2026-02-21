let selectedImages = []; // Array to store IDs of selected images

// Function to handle tab switching
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    
    // Hide all tab content
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    
    // Remove the "active" class from all tab links
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    
    // Show the current tab and add "active" class to the clicked tab link
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
    
    // Load images for the selected tab
    loadImages(tabName);
}

// Function to load images from the server for the selected gallery
function loadImages(gallery) {
    console.log('Loading images for:', gallery);
    var xhr = new XMLHttpRequest();
    
    // Fetch images for the selected gallery using AJAX
    xhr.open('GET', '../Common/Config/fetch_images.php?gallery=' + gallery, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var images = JSON.parse(xhr.responseText); // Parse JSON response
            var contentDiv = document.getElementById(gallery.toLowerCase() + 'Content');
            if (!contentDiv) {
                console.error('Content div not found:', gallery.toLowerCase() + 'Content');
                return;
            }
            contentDiv.innerHTML = ''; // Clear existing content
            
            // Create and append image elements
            images.forEach(function(image) {
                var imgContainer = document.createElement('div');
                imgContainer.className = 'imageContainer';

                var imgElement = document.createElement('img');
                imgElement.src = '../Common/images/' + image.Gallery_Name + '/' + image.File_Name;
                imgElement.alt = image.Title;
                imgElement.style.width = '200px'; // Set desired image width
                imgElement.style.marginBottom = '10px'; // Set margin

                // Handle double-click event to toggle checkboxes
                imgElement.ondblclick = function() {
                    console.log('Image double-clicked');
                    toggleCheckboxes();
                };

                // Create and append a checkbox for image selection
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.className = 'imageCheckbox';
                checkbox.style.display = 'none';
                checkbox.dataset.photoId = image.Photo_ID; // Set photoId as a data attribute
                
                // Handle checkbox change event to manage image selection
                checkbox.onchange = function() {
                    toggleImageSelection(image.Photo_ID, checkbox.checked);
                };

                imgContainer.appendChild(imgElement);
                imgContainer.appendChild(checkbox);
                contentDiv.appendChild(imgContainer);
            });
        }
    };
    xhr.send();
}

// Function to show the modal for uploading images
function showModal() {
    var modal = document.getElementById('myModal');
    var span = document.getElementsByClassName('close')[0];
    modal.style.display = 'block';

    // Close the modal when the close button is clicked
    span.onclick = function() {
        modal.style.display = 'none';
    }

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
}

// Handle the form submission for image upload
document.getElementById('uploadForm').onsubmit = function(event) {
    event.preventDefault(); // Prevent the default form submission
    var formData = new FormData(this); // Create a FormData object with form data
    var xhr = new XMLHttpRequest();
    
    // Send the form data via AJAX to upload the image
    xhr.open('POST', '../Common/Config/upload_image.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('uploadStatus').innerText = xhr.responseText;
            // Reset the form and close the modal after upload
            document.getElementById('uploadForm').reset();
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
            window.location.reload(); // Reload the page to update the gallery
        } else {
            document.getElementById('uploadStatus').innerText = 'Error uploading image.';
        }
    };
    xhr.send(formData);
}
    
// Toggle the display of checkboxes when an image is double-clicked
function toggleCheckboxes() {
    var checkboxes = document.querySelectorAll('.imageCheckbox');
    var allHidden = Array.from(checkboxes).every(checkbox => checkbox.style.display === 'none');

    // Show or hide all checkboxes based on their current state
    checkboxes.forEach(checkbox => {
        checkbox.style.display = allHidden ? 'block' : 'none';
    });
}

// Manage image selection by updating the selectedImages array
function toggleImageSelection(photoId, isSelected) {
    if (isSelected) {
        selectedImages.push(photoId); // Add image ID to selectedImages array
    } else {
        // Remove image ID from array
        selectedImages = selectedImages.filter(id => id !== photoId); 
    }
    // Enable/disable delete button
    document.getElementById('deleteSelectedButton').disabled = selectedImages.length === 0; 
}

// Delete selected images from the server
function deleteSelectedImages() {
    if (selectedImages.length === 0) return;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../Common/Config/delete_image.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert(xhr.responseText);
            // Reload the page after deletion
            window.location.reload();
        } else {
            alert('Error deleting the images.');
        }
    };
    xhr.send('photo_ids=' + JSON.stringify(selectedImages)); // Send selected image IDs to the server
}

// Open the first tab by default when the page loads
document.getElementById('openFirst').click();
