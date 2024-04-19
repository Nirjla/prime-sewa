function validateForm(value){
  if(value){
      var fieldValue = document.getElementById(value).value;
      document.getElementById(value+'Error').innerHTML = '';
  }
  if(value === 'event-title"')
  {
      checkFieldExists(fieldValue, 'event_title', value , "Title") 
  }
}

function checkFieldExists(fieldValue,fieldName, value, errorMessage){
      $.ajax({
            type:'POST',
            url: 'check_field.php',
            data:{
                  fieldValue:fieldValue,
                  fieldName:fieldName,
            },
            success: function(response){
                  if(response ===1){
                        document.getElementById(value+'Error').innerHTML = errorMessage+ ' already exists'
                  }
            }
      })
}