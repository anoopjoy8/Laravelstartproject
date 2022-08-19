$(document).ready(function(){
    $('#clmsg').click(function(){
        if ($('#msg1').css('opacity') == 0) $('#msg1').css('opacity', 1);
        else $('#msg1').css('opacity', 0);
    });
});

$(document).ready(function() {
  $('#summernote').summernote();
});

$("#customFile").on('change', function () {

  if (typeof (FileReader) != "undefined") {

      var image_holder = $("#imgPreview");
      image_holder.empty();

      var reader = new FileReader();
      reader.onload = function (e) {
          $("<img/>", {
              "src": e.target.result,
              "class": "thumb-image"
          }).appendTo(image_holder);

      }
      image_holder.show();
      reader.readAsDataURL($(this)[0].files[0]);
  } else {
      alert("This browser does not support FileReader.");
  }
});

$(document).ready(function() {
      var imgname      = $("#customFile").attr('value');
      if(imgname !="")
      {
        var image_holder = $("#imgPreview");
        image_holder.empty();
        var reader = new FileReader();
          $("<img/>", {
              "src":"/uploads/"+imgname,
              "class": "thumb-image"
          }).appendTo(image_holder);
        image_holder.show();
        reader.readAsDataURL($(this)[0].files[0]);
      }
});

$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\"><i class=\"fa-solid fa-trash-can\"></i> </span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

function DeleteImage(id,page_id) {
  var result = confirm("Do you want to delete this Image?");
  if(result == true){
    $.ajax
    ({
        type     : 'get',
        dataType : "html",
        url      :'http://127.0.0.1:8000/admin/delete-image',
        data     : {id:id,page_id:page_id},
        success  : function(res) 
        {
          $('#image_div').html(res);
        }
     });  
  }
}


