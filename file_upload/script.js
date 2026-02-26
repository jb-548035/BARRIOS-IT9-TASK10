const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('fileInput');
const fileNameDisplay = document.getElementById('file-name');

// Trigger file input when clicking the dashed area
dropZone.addEventListener('click', () => fileInput.click());

// Update text when file is selected
fileInput.addEventListener('change', () => {
    if (fileInput.files.length > 0) {
        fileNameDisplay.innerHTML = `<strong>Selected:</strong> ${fileInput.files[0].name}`;
        dropZone.style.borderColor = "#198754"; // Change to green
    }
});

// Simple Drag & Drop visual feedback
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.style.background = "rgba(13, 110, 253, 0.1)";
});

dropZone.addEventListener('dragleave', () => {
    dropZone.style.background = "transparent";
});