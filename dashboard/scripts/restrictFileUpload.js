$(document).ready(function() {
      function restrictFileUpload(inputId) {
          var fileInput = document.getElementById(inputId);
          var fileSize = fileInput.files[0].size;
          var errorId = inputId + 'Error';
          
          $('#' + errorId).text(''); // Clear any previous error message
          
          if (fileSize > 2 * 1024 * 1024) {
              $('#' + errorId).text('File size exceeds the maximum allowed limit of 2MB');
              // Prevent form submission if needed
              // e.preventDefault();
          }
      }
  });
  