 $(document).ready(function(){
//editor code 
   ClassicEditor
        .create( document.querySelector( '#myeditor' ) )
        .catch( error => {
            console.error( error );
        });
//--editor code

//Loader 

    // var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    // $("body").prepend(div_box);
    // $('#load-screen').delay(700).fadeOut(600, function(){
    //     $(this).remove();
    // });
  
//--Loader

//CHECK ALL POSTS CHECKBOX
            $('#CheckAllPosts').click(function(event){
              //checkallposts check box id.      
                 if(this.checked){
                     	$('.CheckMultiplePosts').each(function(){
                     		this.checked=true;//if checked select all
                     	});
                 }
                 else
                 {
                 	$('.CheckMultiplePosts').each(function(){
                 		this.checked=false;//if not checked nothing to do.
                 	});
                 }
            });  
//--CHECK ALL POSTS CHECKBOX              
 
});    

//LOADUSER ONLINE

function loadUsersOnline(){

    $.get("functions.php?onlineusers=result",function(data){
        $(".usersonline").text(data);
    });

}  
setInterval(function(){

   loadUsersOnline();

},500);









 