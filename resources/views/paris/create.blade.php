@extends('layouts.master')

@section('title') Ecole @endsection

@section('subTitle') Creation @endsection

@section('css')
    <style>

        .choose_file{
            position:relative;
            display:inline-block;
            border-radius:8px;
            border:#ebebeb solid 1px;
            width:250px;
            padding: 4px 6px 4px 8px;
            font: normal 14px Myriad Pro, Verdana, Geneva, sans-serif;
            color: #7f7f7f;
            margin-top: 2px;
            background:white
        }
        .choose_file input[type="file"]{
            -webkit-appearance:none;
            position:absolute;
            top:0; left:0;
            opacity:0;
        }

    </style>
@endsection
@section('content')
    <section class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('paris.store') }}" method="POST">
                    @csrf()
                <fieldset>
                    <legend>Mode</legend>
                    <select class="form-control" name="mode">
                        @foreach($tirages as $item)
                            <option value="{{$item['name']}}">{{ $item['name'] .' '. $item['heure'] }}</option>
                        @endforeach
                    </select>
                </fieldset>
                <fieldset>
                    <legend>
                        TIRAGE WINNER
                    </legend>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="name">N°1</label>
                                <div class="row">
                                    <input type="number" name="tirage_win[0]" class="form-control" id="nometab" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="name">N°2</label>
                                <div class="row">
                                    <input type="number" name="tirage_win[1]" class="form-control" id="nometab" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="name">N°3</label>
                                <div class="row">
                                    <input type="number" name="tirage_win[2]" class="form-control" id="nometab" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="name">N°4</label>
                                <div class="row">
                                    <input type="number" name="tirage_win[3]" class="form-control" id="nometab" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="name">N°5</label>
                                <div class="row">
                                    <input type="number" name="tirage_win[4]" class="form-control" id="nometab" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>
                        TIRAGE MACHINE
                    </legend>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="name">N°1</label>
                                <div class="row">
                                    <input type="number" name="tirage_mac[0]" class="form-control" id="nometab" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="name">N°2</label>
                                <div class="row">
                                    <input type="number" name="tirage_mac[1]" class="form-control" id="nometab" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="name">N°3</label>
                                <div class="row">
                                    <input type="number" name="tirage_mac[2]" class="form-control" id="nometab" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="name">N°4</label>
                                <div class="row">
                                    <input type="number" name="tirage_mac[3]" class="form-control" id="nometab" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="name">N°5</label>
                                <div class="row">
                                    <input type="number" name="tirage_mac[4]" class="form-control" id="nometab" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <button id="save" type="submit" class="btn btn-info btn-icon-split mt-3">
                    <span class="icon text-white-50">
                        <i class="feather icon-save"></i>
                    </span>
                    <span class="text">Valider</span>
                </button>
                </form>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script type="text/javascript" src="{{asset('webcamjs/webcam.min.js')}}"></script>
    <!-- Code to handle taking the snapshot and displaying it locally -->
    <script language="JavaScript">

        // Configure a few settings and attach camera
        function configure(){
            $('#my_camera').attr('style',"");
            // $('#my_camera1').attr('style',"display:none;");
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 300,
            });
            Webcam.attach('#my_camera');
        }
        // A button for taking snaps
        // preload shutter audio clip
        var shutter = new Audio();
        shutter.autoplay = false;
        shutter.src = navigator.userAgent.match(/Firefox/) ? "{{ asset('sounds/shutter.ogg') }}" : "{{ asset('sounds/shutter.mp3') }}";

        function take_snapshot() {
            $('#my_camera').attr('style',"display:none;");
            // play sound effect
            shutter.play();
            // take snapshot and get image data
            Webcam.snap( function(data_uri) {
                //console.log(data_uri);
                // display results in page
                //$('#fileInput').val(data_uri);
                document.getElementById('resultat').innerHTML = `<input name="photo" id="fileInput" value="${data_uri}" type="hidden" style="display: none;"/>`;//'<img id="imageprev" src="'+data_uri+'"/>';
                document.getElementById('my_camera1').innerHTML = `<img id="imageprev" src="${data_uri}"/>`;//;
            } );
            Webcam.reset();
        }

        function saveSnap(){
            // Get base64 value from <img id='imageprev'> source
            var base64image =  document.getElementById("imageprev").src;
            console.log(base64image);
            Webcam.uploadbase64image( base64image, 'upload.php', function(code, text) {
                console.log('Save successfully');
                //console.log(text);
            });
        }
    </script>
    <script>
        function chooseFile() {
            $("#fileInput").click();
        }
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_id').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#fileInput").change(function(){
            readURL(this);
        });
    </script>
@endsection

