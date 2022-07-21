// it's working don't touch it please 😀
$(document).ready(function () {

  $("body").on("click","#delete",function(e){
  
     if(!confirm("Do you really want to delete this element?")) {
        return false;
      }
  
     e.preventDefault();
     var id = $(this).data("id");
     var token = $("meta[name='csrf-token']").attr("content");
     var url = e.target;
  
     $.ajax(
         {
           url: url.href, 
           type: 'DELETE',
           data: {
             _token: token,
                 id: id
         },
         success: function (response)
         {
             console.log(response); // see the reponse sent
            },
            error: function(xhr) {
              console.log(xhr.responseText); // this line will save you tons of hours while debugging
         // do something here because of error
        }
      });
      
      // refresh not reload 😃
      location.reload(true);
      return false;
    });
    $('#deleteTxt').text('item deleted successfully!');
  });












    // edit in the same page
    $(document).ready(function () {
      $("body").on("click","#edit",function(e){
          var id = $(this).data("id");
          var token = $("meta[name='csrf-token']").attr("content");
          var url = e.target;
      
          $.ajax(
              {
                url: url.href, 
                data: {
                  _token: token,
                      id: id
              },
          });
          
        });
      });