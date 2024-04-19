function getValues() {
      const monthSelect = document.querySelector("select[name='months']");
      const month = monthSelect.options[monthSelect.selectedIndex].value;
  
      const countInput = document.getElementById('count');
      const count = countInput.value;
  
      console.log(month);
      console.log(count);

      $.ajax({
url:'volunteer-request.php',
method:'post',
data:{
month:month,count:count
},
success:function(response){
      console.log("Data sent successfully");
}
      })
  
  }
  