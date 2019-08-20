<meta name="csrf-token" content="{{ csrf_token() }}">
<form action="{{url('/product')}}" method="post">
    {{ csrf_field() }}
    Product name:
    <br>
    <input type="text" name="name">
    <br><br>
    Product photos (can add more than one):
    <br>
    <input type="file" id="fileupload" name="photos[]" data-url="{{url('/upload_test')}}" multiple="">
    <br>
    <div id="files_list"></div>
    <div id="progress">
        <div class="bar" style="width: 0%;"></div>
    </div>
    <style>
        .bar {
            height: 18px;
            background: green;
        }
    </style>    
    <p id="loading"></p>
    <input type="hidden" name="file_ids" id="file_ids" value="">
    <input type="submit" value="Upload">
    {{asset('storage/photos/qIKzZaO2Dva5hEbvQiJjeLwEcEtcLj4rNY20pwiD.png')}}
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{asset('/jQuery-File-Upload/js/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{asset('/jQuery-File-Upload/js/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('/jQuery-File-Upload/js/jquery.fileupload.js')}}"></script>
<script>
    $(function () {
        $('#fileupload').fileupload({
            dataType: 'json',
            add: function (e, data) {
                $('#loading').text('Uploading...');
                data.submit();
            },
            done: function (e, data) {
                // console.log(data);
                $.each(data.result.files, function (index, file) {
                    $('<p/>').html(file.name + ' (' + file.size + ' KB)').appendTo($('#files_list'));
                    if ($('#file_ids').val() != '') {
                        $('#file_ids').val($('#file_ids').val() + ',');
                    }
                    $('#file_ids').val($('#file_ids').val() + file.fileID);
                });
                $('#loading').text('');
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .bar').css(
                    'width',
                    progress + '%'
                );
            }
        });
        var overallProgress = $('#fileupload').fileupload('progress');
        console.log(overallProgress);
    });
</script>
