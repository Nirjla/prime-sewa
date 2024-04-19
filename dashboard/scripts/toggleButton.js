function toggleButton(buttonId, contentId) {
      $(document).ready(function(){
          $('#' + buttonId).click(function(){
              $('#' + contentId).toggle();
          });
      });
  }