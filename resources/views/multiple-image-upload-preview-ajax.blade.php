<!DOCTYPE html>
<html>
<head>
  <title>Laravel 8 Multiple Image Upload AJAX With Preview - Tutsmake.com</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <style>
    .show-multiple-image-preview img
    {
          padding: 6px;
          max-width: 100px;
    }
  </style>

</head>
<body>

<div class="container mt-5">


    <h2 class="text-center">Laravel 8 Ajax Multiple Image Upload With Preview - Tutsmake.com</h2>

    <div class="text-center">

        <form id="multiple-image-preview-ajax" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">

          @csrf
                  
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="images[]" id="images" placeholder="Choose images" multiple >
                    </div>
                    @error('images')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <div class="mt-1 text-center">
                        <div class="show-multiple-image-preview"> </div>
                    </div>  
                </div>
 
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>     
        </form>

    </div>



</div>  
<script type="text/javascript">
     
$(document).ready(function (e) {
   
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
   });
  
  $(function() {
    // Multiple images preview with JavaScript
    var ShowMultipleImagePreview = function(input, imgPreviewPlaceholder) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#images').on('change', function() {
        ShowMultipleImagePreview(this, 'div.show-multiple-image-preview');
    });
  });    
  
   $('#multiple-image-preview-ajax').submit(function(e) {

     e.preventDefault();
  
      var formData = new FormData(this);

      let TotalImages = $('#images')[0].files.length; //Total Images
      let images = $('#images')[0];
      for (let i = 0; i < TotalImages; i++) {
          formData.append('images' + i, images.files[i]);
      }
      formData.append('TotalImages', TotalImages);
  
     $.ajax({
        type:'POST',
        url: "{{ url('upload-multiple-image-ajax')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
           this.reset();
           alert('Images has been uploaded using jQuery ajax with preview');
        //    $('.show-multiple-image-preview').html("")
        },
        error: function(data){
           console.log(data);
         }
       });
   });
});

</script>
</body>
</html>